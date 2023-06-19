<?php
require_once __DIR__ . '/src/controllers/UsersController.php';

session_start();
$controller = new UsersController();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'remove') {
        $ids = $_POST['id'] ?? '';
        $controller->removeUsers($ids);
    } else if ($action === 'add') {
        $newUser = [];
        if (isset($_POST['newUser'])) {
            parse_str($_POST['newUser'], $newUser);
        }
        $controller->addUser($newUser);
    }
} else {
    if ('/' === $uri) {
        header('Location: /users');
        exit;
    } elseif ('/users' === $uri) {
        $content = $controller->index();
    } elseif ('/add-user' === $uri) {
        $content = $controller->showAddUserForm();
    } else {
        header('HTTP/1.1 404 Not Found');
        exit;
    }
    require __DIR__ . '/partials/main.php';
}

$_SESSION['errors'] = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
