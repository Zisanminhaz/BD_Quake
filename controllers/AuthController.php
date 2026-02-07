<?php

require_once APP_ROOT . '/models/User.php';

class AuthController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function register()
    {
        $errors = [];
        $old = ['name' => '', 'email' => ''];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            // Basic validation
            if ($name === '') {
                $errors[] = 'Name is required.';
            }

            if ($email === '') {
                $errors[] = 'Email is required.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Email is not valid.';
            }

            if ($password === '') {
                $errors[] = 'Password is required.';
            } elseif (strlen($password) < 6) {
                $errors[] = 'Password should be at least 6 characters.';
            }

            if ($password !== $password_confirm) {
                $errors[] = 'Passwords do not match.';
            }

            // Check if email already exists
            if (empty($errors)) {
                $existing = $this->userModel->findByEmail($email);
                if ($existing) {
                    $errors[] = 'This email is already registered.';
                } else {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $this->userModel->create($name, $email, $hash, 'user');

                    // Redirect to login page
                    header('Location: ' . BASE_URL . '/index.php?controller=auth&action=login&registered=1');
                    exit;
                }
            }

            $old['name'] = $name;
            $old['email'] = $email;
        }

        $this->view('auth/register', [
            'page_title' => 'Create Account',
            'errors' => $errors,
            'old' => $old
        ]);
    }

    public function login()
    {
        $errors = [];
        $old = ['email' => ''];
        $justRegistered = isset($_GET['registered']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || $password === '') {
                $errors[] = 'Email and password are required.';
            } else {
                $user = $this->userModel->findByEmail($email);
                if (!$user || !password_verify($password, $user['password'])) {
                    $errors[] = 'Invalid email or password.';
                } else {
                    // Login success
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_role'] = $user['role'];

                    header('Location: ' . BASE_URL);
                    exit;
                }
            }

            $old['email'] = $email;
        }

        $this->view('auth/login', [
            'page_title' => 'Login',
            'errors' => $errors,
            'old' => $old,
            'justRegistered' => $justRegistered
        ]);
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        header('Location: ' . BASE_URL);
        exit;
    }
}
