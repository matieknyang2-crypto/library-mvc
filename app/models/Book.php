<?php
// app/models/Book.php
require_once 'app/config/database.php';

class Book {
    private $conn;
    private $table = 'books';

    public $id;
    public $title;
    public $author;
    public $isbn;
    public $category_id;
    public $total_copies;
    public $available_copies;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll($search = '', $category_id = null) {
        $query = "SELECT b.*, c.name as category_name 
                  FROM " . $this->table . " b 
                  LEFT JOIN categories c ON b.category_id = c.id 
                  WHERE 1=1";
        $params = [];
        if (!empty($search)) {
            $query .= " AND (b.title LIKE :search OR b.author LIKE :search OR b.isbn LIKE :search)";
            $params[':search'] = "%$search%";
        }
        if (!empty($category_id)) {
            $query .= " AND b.category_id = :category_id";
            $params[':category_id'] = $category_id;
        }
        $query .= " ORDER BY b.title";
        $stmt = $this->conn->prepare($query);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $query = "SELECT b.*, c.name as category_name 
                  FROM " . $this->table . " b 
                  LEFT JOIN categories c ON b.category_id = c.id 
                  WHERE b.id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (title, author, isbn, category_id, total_copies, available_copies) 
                  VALUES (:title, :author, :isbn, :category_id, :total_copies, :available_copies)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':author', $data['author']);
        $stmt->bindParam(':isbn', $data['isbn']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':total_copies', $data['total_copies']);
        $stmt->bindParam(':available_copies', $data['total_copies']); // initially same as total
        return $stmt->execute();
    }

    public function update($id, $data) {
        // available_copies can be adjusted if total_copies changes? We'll just update total_copies and keep available_copies as is unless specified.
        // For simplicity, we allow updating total_copies and available_copies separately.
        $query = "UPDATE " . $this->table . " 
                  SET title = :title, author = :author, isbn = :isbn, 
                      category_id = :category_id, total_copies = :total_copies, 
                      available_copies = :available_copies 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':author', $data['author']);
        $stmt->bindParam(':isbn', $data['isbn']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':total_copies', $data['total_copies']);
        $stmt->bindParam(':available_copies', $data['available_copies']);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id) {
        // Check if any active transactions exist for this book
        $check = "SELECT COUNT(*) as total FROM transactions WHERE book_id = :id AND status IN ('issued', 'overdue')";
        $stmt = $this->conn->prepare($check);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row['total'] > 0) {
            return false; // Cannot delete if issued
        }
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function countBooks() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}
?>