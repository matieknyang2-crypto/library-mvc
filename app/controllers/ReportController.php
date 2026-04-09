<?php
// app/controllers/ReportController.php
require_once 'app/controllers/BaseController.php';
require_once 'app/models/Transaction.php';

class ReportController extends BaseController {
    public function export() {
        $this->requireAdmin();
        $this->view('reports/export');
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