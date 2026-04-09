<?php
// app/models/Transaction.php
require_once 'app/config/database.php';

class Transaction {
    private $conn;
    private $table = 'transactions';

    public $id;
    public $user_id;
    public $book_id;
    public $issue_date;
    public $due_date;
    public $return_date;
    public $status;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function issue($user_id, $book_id) {
        // Check book availability
        $bookModel = new Book();
        $book = $bookModel->findById($book_id);
        if (!$book || $book['available_copies'] <= 0) {
            return false;
        }
        // Begin transaction
        $this->conn->beginTransaction();
        try {
            // Decrement available copies
            $updateBook = "UPDATE books SET available_copies = available_copies - 1 WHERE id = :id";
            $stmt = $this->conn->prepare($updateBook);
            $stmt->bindParam(':id', $book_id);
            $stmt->execute();

            // Insert transaction
            $issue_date = date('Y-m-d');
            $due_date = date('Y-m-d', strtotime('+14 days'));
            $insert = "INSERT INTO transactions (user_id, book_id, issue_date, due_date, status) 
                       VALUES (:user_id, :book_id, :issue_date, :due_date, 'issued')";
            $stmt = $this->conn->prepare($insert);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':book_id', $book_id);
            $stmt->bindParam(':issue_date', $issue_date);
            $stmt->bindParam(':due_date', $due_date);
            $stmt->execute();

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function returnBook($transaction_id) {
        $this->conn->beginTransaction();
        try {
            // Get transaction details
            $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $transaction_id);
            $stmt->execute();
            $transaction = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$transaction || $transaction['status'] == 'returned') {
                return false;
            }
            // Update transaction
            $return_date = date('Y-m-d');
            $updateTrans = "UPDATE transactions SET return_date = :return_date, status = 'returned' WHERE id = :id";
            $stmt = $this->conn->prepare($updateTrans);
            $stmt->bindParam(':return_date', $return_date);
            $stmt->bindParam(':id', $transaction_id);
            $stmt->execute();

            // Increment available copies
            $updateBook = "UPDATE books SET available_copies = available_copies + 1 WHERE id = :id";
            $stmt = $this->conn->prepare($updateBook);
            $stmt->bindParam(':id', $transaction['book_id']);
            $stmt->execute();

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function getIssuedBooks($user_id = null) {
        $query = "SELECT t.*, u.name as user_name, b.title as book_title, b.author 
                  FROM transactions t 
                  JOIN users u ON t.user_id = u.id 
                  JOIN books b ON t.book_id = b.id 
                  WHERE t.status IN ('issued', 'overdue')";
        $params = [];
        if ($user_id) {
            $query .= " AND t.user_id = :user_id";
            $params[':user_id'] = $user_id;
        }
        $query .= " ORDER BY t.due_date ASC";
        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOverdueBooks() {
        $today = date('Y-m-d');
        $query = "SELECT t.*, u.name as user_name, u.email, b.title as book_title, b.author 
                  FROM transactions t 
                  JOIN users u ON t.user_id = u.id 
                  JOIN books b ON t.book_id = b.id 
                  WHERE t.status IN ('issued', 'overdue') AND t.due_date < :today";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':today', $today);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countIssuedToday() {
        $today = date('Y-m-d');
        $query = "SELECT COUNT(*) as total FROM transactions WHERE DATE(issue_date) = :today";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':today', $today);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    public function countOverdue() {
        $today = date('Y-m-d');
        $query = "SELECT COUNT(*) as total FROM transactions WHERE status IN ('issued', 'overdue') AND due_date < :today";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':today', $today);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}
?>