<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Backend/Full-stack recruitment task</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

<main>
    <?php require_once './partials/main.php'; ?>
</main>

<script src="assets/js/script.js"></script>
</body>
</html>
<?php
require_once __DIR__ . '/src/controllers/UsersController.php';

$controller = new UsersController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUser = [
    ];
    $controller->addUser($newUser);
} elseif (isset($_GET['remove_id'])) {
    $controller->removeUser($_GET['remove_id']);
} else {
    $controller->index();
}
