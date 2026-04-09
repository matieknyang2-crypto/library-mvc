<?php
// app/controllers/TransactionController.php
require_once 'app/controllers/BaseController.php';
require_once 'app/models/Transaction.php';
require_once 'app/models/User.php';
require_once 'app/models/Book.php';

class TransactionController extends BaseController {
    public function issue() {
        $this->requireAdmin();
        $userModel = new User();
        $students = $userModel->getAllStudents();
        $bookModel = new Book();
        $books = $bookModel->getAll(); // we'll filter those with available_copies > 0 in view

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_POST['user_id'];
            $book_id = $_POST['book_id'];
            $transactionModel = new Transaction();
            if ($transactionModel->issue($user_id, $book_id)) {
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Book issued successfully.'];
            } else {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Failed to issue book. Check availability.'];
            }
            $this->redirect('/library_mvc/public/index.php?url=transaction/issue');
        }
        $this->view('transactions/issue', ['students' => $students, 'books' => $books]);
    }

    public function return() {
        $this->returnBook();
    }

    public function returnBook() {
        $this->requireAdmin();
        $transactionModel = new Transaction();
        $issued = $transactionModel->getIssuedBooks();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $transaction_id = $_POST['transaction_id'];
            if ($transactionModel->returnBook($transaction_id)) {
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Book returned successfully.'];
            } else {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Failed to return book.'];
            }
            $this->redirect('/library_mvc/public/index.php?url=transaction/return');
        }
        $this->view('transactions/return', ['issued' => $issued]);
    }

    public function overdue() {
        $this->requireAdmin();
        $transactionModel = new Transaction();
        $overdue = $transactionModel->getOverdueBooks();
        $this->view('transactions/overdue', ['overdue' => $overdue]);
    }
}
?>