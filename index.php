<?php
require_once __DIR__ . '/src/controllers/UsersController.php';

$controller = new UsersController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    $action = $_POST['action'] ?? '';
    if ($action === 'remove') {
        $id = $_POST['id'] ?? '';
        $controller->removeUser($id);
    } else if ($action === 'add') {
        $newUser = [];
        if (isset($_POST['newUser'])) {
            parse_str($_POST['newUser'], $newUser);
        }
        $controller->addUser($newUser);
    }
} else {
    session_start();
    $controller->index();
}

$_SESSION['errors'] = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

require_once __DIR__ . '/partials/main.php';
