<?php
// app/controllers/BaseController.php
abstract class BaseController {
    protected function view($view, $data = []) {
        extract($data);
        require_once "app/views/layouts/header.php";
        require_once "app/views/$view.php";
        require_once "app/views/layouts/footer.php";
    }

    protected function redirect($url) {
        header("Location: $url");
        exit;
    }

    protected function isAdmin() {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
    }

    protected function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    protected function requireLogin() {
        if (!$this->isLoggedIn()) {
            $this->redirect('/library_mvc/public/index.php?url=auth/login');
        }
    }

    protected function requireAdmin() {
        $this->requireLogin();
        if (!$this->isAdmin()) {
            $this->redirect('/library_mvc/public/index.php?url=dashboard/index');
        }
    }
}
?>