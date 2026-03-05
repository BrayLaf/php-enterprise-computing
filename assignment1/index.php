<?php 
session_start();

require_once __DIR__ . "/config/Database.php";
require_once __DIR__ . "/controller/userController.php";
require_once __DIR__ . "/controller/studentController.php";

$database = new Database();
$userController = new userController($database);
$studentController = new studentController($database);

$action = $_GET['action'] ?? 'dashboard';
$message = '';
$error = '';

if (!isset($_SESSION['user_id']) && !in_array($action, ['login', 'register'])) {
    header("Location: index.php?action=login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'register') {
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($username === '' || $email === '' || $password === '') {
            $error = 'All fields are required.';
        } else {
            $ok = $userController->Register($username, $email, $password);
            if ($ok) {
                $message = 'Registration successful. You can now log in.';
                $action = 'login';
            } else {
                $error = 'Registration failed. Please try a different email or username.';
            }
        }
    }

    if ($action === 'login') {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            $error = 'Email and password are required.';
        } else {
            $ok = $userController->Login($email, $password);
            if ($ok) {
                $_SESSION['user_id'] = $email;
                header("Location: index.php?action=dashboard");
                exit;
            } else {
                $error = 'Invalid email or password.';
            }
        }
    }

    if ($action === 'create-student' && isset($_SESSION['user_id'])) {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $studentId = trim($_POST['studentId'] ?? '');

        if ($name === '' || $email === '' || $studentId === '') {
            $_SESSION['flash_error'] = 'All student fields are required.';
        } else {
            $ok = $studentController->createStudentFromForm($name, $email, $studentId);
            $_SESSION['flash_message'] = $ok ? 'Student created successfully.' : 'Failed to create student.';
        }
        header("Location: index.php?action=dashboard");
        exit;
    }

    if ($action === 'delete-student' && isset($_SESSION['user_id'])) {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $ok = $studentController->removeStudent($id);
            $_SESSION['flash_message'] = $ok ? 'Student deleted successfully.' : 'Failed to delete student.';
        } else {
            $_SESSION['flash_error'] = 'Invalid student selected.';
        }
        header("Location: index.php?action=dashboard");
        exit;
    }
}

if ($action === 'logout') {
    session_destroy();
    header("Location: index.php?action=login");
    exit;
}

$flashMessage = $_SESSION['flash_message'] ?? '';
$flashError = $_SESSION['flash_error'] ?? '';
unset($_SESSION['flash_message'], $_SESSION['flash_error']);

if ($action === 'register') {
    include __DIR__ . "/view/auth/register.php";
    exit;
}

if ($action === 'login') {
    include __DIR__ . "/view/auth/login.php";
    exit;
}

$students = $studentController->listStudents();
include __DIR__ . "/view/student/dashboard.php";
?>