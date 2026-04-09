<?php
// app/controllers/AuthController.php
require_once 'app/controllers/BaseController.php';
require_once 'app/models/User.php';

class AuthController extends BaseController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Welcome! Login successful.'];
                $this->redirect('/library_mvc/public/index.php?url=dashboard/index');
            } else {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Invalid email or password. Please try again.'];
                $this->redirect('/library_mvc/public/index.php?url=auth/login');
            }
        } else {
            $this->view('auth/login');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            // Validation
            if (empty($name) || empty($email) || empty($password)) {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'All fields are required.'];
                $this->redirect('/library_mvc/public/index.php?url=auth/register');
                return;
            }

            if ($password !== $password_confirm) {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Passwords do not match.'];
                $this->redirect('/library_mvc/public/index.php?url=auth/register');
                return;
            }

            if (strlen($password) < 6) {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Password must be at least 6 characters.'];
                $this->redirect('/library_mvc/public/index.php?url=auth/register');
                return;
            }

            $userModel = new User();
            
            // Check if email already exists
            if ($userModel->findByEmail($email)) {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Email already registered. Please login or use a different email.'];
                $this->redirect('/library_mvc/public/index.php?url=auth/register');
                return;
            }

            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Create user
            if ($userModel->create($name, $email, $hashedPassword)) {
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Account created successfully! Please login.'];
                $this->redirect('/library_mvc/public/index.php?url=auth/login');
            } else {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Failed to create account. Please try again.'];
                $this->redirect('/library_mvc/public/index.php?url=auth/register');
            }
        } else {
            $this->view('auth/register');
        }
    }

    public function logout() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Logout successful. See you soon!'];
        unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_role']);
        $this->redirect('/library_mvc/public/index.php?url=home/index');
    }

    public function forgot() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');

            if (empty($email)) {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Please enter your email address.'];
                $this->redirect('/library_mvc/public/index.php?url=auth/forgot');
                return;
            }

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user) {
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'If this email exists in our system, a reset link has been sent.'];
            } else {
                $_SESSION['flash'] = ['type' => 'info', 'message' => 'If this email exists in our system, a reset link has been sent.'];
            }

            $this->redirect('/library_mvc/public/index.php?url=auth/login');
        } else {
            $this->view('auth/forgot');
        }
    }
}
?>