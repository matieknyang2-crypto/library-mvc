<?php
// app/controllers/BookController.php
require_once 'app/controllers/BaseController.php';
require_once 'app/models/Book.php';
require_once 'app/models/Category.php';

class BookController extends BaseController {
    public function index() {
        // Allow public access to browse books
        $bookModel = new Book();
        $search = $_GET['search'] ?? '';
        $category_id = $_GET['category_id'] ?? '';
        $books = $bookModel->getAll($search, $category_id);
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        $this->view('books/index', ['books' => $books, 'categories' => $categories, 'search' => $search, 'selected_category' => $category_id]);
    }

    public function create() {
        $this->requireAdmin();
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookModel = new Book();
            $data = [
                'title' => $_POST['title'],
                'author' => $_POST['author'],
                'isbn' => $_POST['isbn'],
                'category_id' => $_POST['category_id'] ?: null,
                'total_copies' => $_POST['total_copies']
            ];
            if ($bookModel->create($data)) {
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Book added successfully.'];
                $this->redirect('/library_mvc/public/index.php?url=book/index');
            } else {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Failed to add book.'];
            }
        }
        $this->view('books/create', ['categories' => $categories]);
    }

    public function edit($id) {
        $this->requireAdmin();
        $bookModel = new Book();
        $book = $bookModel->findById($id);
        if (!$book) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Book not found.'];
            $this->redirect('/library_mvc/public/index.php?url=book/index');
        }
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'],
                'author' => $_POST['author'],
                'isbn' => $_POST['isbn'],
                'category_id' => $_POST['category_id'] ?: null,
                'total_copies' => $_POST['total_copies'],
                'available_copies' => $_POST['available_copies']
            ];
            if ($bookModel->update($id, $data)) {
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Book updated successfully.'];
                $this->redirect('/library_mvc/public/index.php?url=book/index');
            } else {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Failed to update book.'];
            }
        }
        $this->view('books/edit', ['book' => $book, 'categories' => $categories]);
    }

    public function delete($id) {
        $this->requireAdmin();
        $bookModel = new Book();
        if ($bookModel->delete($id)) {
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Book deleted.'];
        } else {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Cannot delete book with active issues.'];
        }
        $this->redirect('/library_mvc/public/index.php?url=book/index');
    }

    public function show($id) {
        // Allow public access to view book details
        $bookModel = new Book();
        $book = $bookModel->findById($id);
        if (!$book) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Book not found.'];
            $this->redirect('/library_mvc/public/index.php?url=book/index');
        }
        $this->view('books/show', ['book' => $book]);
    }
}
?>