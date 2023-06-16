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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>
<?php
require_once __DIR__ . '/src/controllers/UsersController.php';

$controller = new UsersController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $controller->index();
}