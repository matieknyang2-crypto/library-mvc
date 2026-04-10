<?php
// app/controllers/ReportController.php
require_once 'app/controllers/BaseController.php';
require_once 'app/models/Transaction.php';
require_once 'app/models/Book.php';

class ReportController extends BaseController {
    public function export() {
        $this->requireAdmin();
        $this->view('reports/export');
    }

    public function exportBooks() {
        $this->requireAdmin();
        $bookModel = new Book();
        $books = $bookModel->getAll('', null);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="all_books_' . date('Ymd') . '.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Title', 'Author', 'ISBN', 'Category', 'Total Copies', 'Available Copies']);

        foreach ($books as $book) {
            fputcsv($output, [
                $book['id'],
                $book['title'],
                $book['author'],
                $book['isbn'],
                $book['category_name'] ?? 'N/A',
                $book['total_copies'],
                $book['available_copies']
            ]);
        }

        fclose($output);
        exit;
    }

    public function exportOverdue() {
        $this->requireAdmin();
        $transactionModel = new Transaction();
        $overdue = $transactionModel->getOverdueBooks();

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="overdue_books_' . date('Ymd') . '.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['User Name', 'Email', 'Book Title', 'Author', 'Issue Date', 'Due Date']);

        foreach ($overdue as $row) {
            fputcsv($output, [
                $row['user_name'],
                $row['email'],
                $row['book_title'],
                $row['author'],
                $row['issue_date'],
                $row['due_date']
            ]);
        }
        fclose($output);
        exit;
    }
}
?>