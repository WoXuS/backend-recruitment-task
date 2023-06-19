<?php
require_once __DIR__ . '/../models/User.php';

class UsersController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        $users = $this->userModel->getAllUsers();
        ob_start();
        require __DIR__ . '/../views/users_view.php';
        echo displayTable($users);
        $content = ob_get_clean();
        return $content;
    }


    public function showAddUserForm()
    {
        ob_start();
        require __DIR__ . '/../views/add_users_form.php';
        echo displayForm();
        $content = ob_get_clean();
        return $content;
    }

    public function removeUsers($ids)
    {
        $this->userModel->removeUsers($ids);
        $this->index();
    }


    public function addUser($newUser)
    {
        $_SESSION['errors'] = array();
        if (!preg_match("/^\s*[a-zA-Z][a-zA-Z\s]*$/", $newUser['first_name'])) {
            $_SESSION['errors']['first_name'] = "Invalid first name";
        }

        if (!preg_match("/^\s*[a-zA-Z][a-zA-Z\s]*$/", $newUser['last_name'])) {
            $_SESSION['errors']['last_name'] = "Invalid last name";
        }

        if (!preg_match("/^[a-zA-Z ]*$/", $newUser['username'])) {
            $_SESSION['errors']['username'] = "Invalid username";
        }

        if (!htmlspecialchars($newUser['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors']['email'] = "Invalid email";
        }

        if ($this->userModel->emailExists($newUser['email'])) {
            $_SESSION['errors']['email'] = "Email is already taken";
        }

        if (!preg_match("/^[a-zA-Z0-9\. ]*$/", $newUser['street'])) {
            $_SESSION['errors']['street'] = "Invalid street";
        }

        if (!preg_match("/^[a-zA-Z ]*$/", $newUser['city'])) {
            $_SESSION['errors']['city'] = "Invalid city";
        }

        if (!preg_match("/^\d{5}(-\d{4})?$/", $newUser['zipcode'])) {
            $_SESSION['errors']['zipcode'] = "Invalid zip code";
        }

        if (!preg_match("/^\+1 \(\d{3}\) \d{3}-\d{4}$/", $newUser['phone'])) {
            $_SESSION['errors']['phone'] = "Invalid phone";
        }
        if (!preg_match("/^(x\d{0,6})?$/", $newUser['extension'])) {
            $_SESSION['errors']['extension'] = "Invalid phone extension";
        }
        if (!preg_match("/^[ -~]*$/", $newUser['company'])) {
            $_SESSION['errors']['company'] = "Invalid company";
        }

        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            header('Content-Type: application/json');
            echo json_encode(['errors' => $_SESSION['errors']]);
            exit;
        }

        $newUser = array(
            "name" => htmlspecialchars($newUser['first_name'] . " " . $newUser['last_name']),
            'username' => htmlspecialchars($newUser['username']),
            'email' => filter_var($newUser['email'], FILTER_SANITIZE_EMAIL),
            'street' => htmlspecialchars($newUser['street']),
            'city' => htmlspecialchars($newUser['city']),
            'zipcode' => htmlspecialchars($newUser['zipcode']),
            'phone' => htmlspecialchars($newUser['phone'] . (!empty($newUser['extension']) ? " " . $newUser['extension'] : '')),
            'company' => htmlspecialchars($newUser['company']),
        );

        $this->userModel->addUser($newUser);
        $_SESSION['user_added'] = $newUser['name'];
        $this->index();
    }
}
