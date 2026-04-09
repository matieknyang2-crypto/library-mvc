<?php
require_once 'BaseController.php';

class UserController extends BaseController {
    public function index() {
        $this->requireLogin();
        $this->requireAdmin();

        $userModel = new User();
        $users = $userModel->getAll();

        $this->view('users/index', ['users' => $users]);
    }
}
?>