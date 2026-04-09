<?php
// app/controllers/CategoryController.php
require_once 'app/controllers/BaseController.php';
require_once 'app/models/Category.php';

class CategoryController extends BaseController {
    public function index() {
        $this->requireAdmin();
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        $this->view('categories/index', ['categories' => $categories]);
    }

    public function create() {
        $this->requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categoryModel = new Category();
            if ($categoryModel->create($_POST['name'])) {
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Category added.'];
            } else {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Failed to add category.'];
            }
            $this->redirect('/library_mvc/public/index.php?url=category/index');
        }
        $this->view('categories/create');
    }

    public function edit($id) {
        $this->requireAdmin();
        $categoryModel = new Category();
        $category = $categoryModel->findById($id);
        if (!$category) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Category not found.'];
            $this->redirect('/library_mvc/public/index.php?url=category/index');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($categoryModel->update($id, $_POST['name'])) {
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Category updated.'];
            } else {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Failed to update category.'];
            }
            $this->redirect('/library_mvc/public/index.php?url=category/index');
        }
        $this->view('categories/edit', ['category' => $category]);
    }

    public function delete($id) {
        $this->requireAdmin();
        $categoryModel = new Category();
        if ($categoryModel->delete($id)) {
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Category deleted.'];
        } else {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Cannot delete category with books.'];
        }
        $this->redirect('/library_mvc/public/index.php?url=category/index');
    }
}
?>