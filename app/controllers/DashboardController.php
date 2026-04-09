<?php
// app/controllers/DashboardController.php
require_once 'app/controllers/BaseController.php';
require_once 'app/models/User.php';
require_once 'app/models/Book.php';
require_once 'app/models/Category.php';
require_once 'app/models/Transaction.php';

class DashboardController extends BaseController {
    public function index() {
        $this->requireLogin();

        $data = [];
        if ($this->isAdmin()) {
            $userModel = new User();
            $bookModel = new Book();
            $categoryModel = new Category();
            $transactionModel = new Transaction();

            $data['total_books'] = $bookModel->countBooks();
            $data['total_categories'] = count($categoryModel->getAll());
            $data['total_students'] = $userModel->countStudents();
            $data['issued_today'] = $transactionModel->countIssuedToday();
            $data['overdue_count'] = $transactionModel->countOverdue();
            $this->view('dashboard/index', $data);
        } else {
            // Student dashboard: show issued books and available books
            $transactionModel = new Transaction();
            $data['issued_books'] = $transactionModel->getIssuedBooks($_SESSION['user_id']);
            $bookModel = new Book();
            $data['available_books'] = $bookModel->getAll('', null); // limit maybe?
            $this->view('dashboard/student', $data);
        }
    }
}
?>