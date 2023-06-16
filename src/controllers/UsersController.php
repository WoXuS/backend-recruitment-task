<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../views/users_view.php';

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
        echo displayTable($users);

    }

    public function removeUser($id)
    {
        $this->userModel->removeUser($id);
        $this->index();
    }

    public function addUser($newUser)
    {
        if (!preg_match("/^\s*[a-zA-Z][a-zA-Z\s]*$/", $newUser['first_name'])) {
            // Only letters and white space allowed for first name, and it should contain at least one letter
            die("Invalid first name");
        }

        if (!preg_match("/^\s*[a-zA-Z][a-zA-Z\s]*$/", $newUser['last_name'])) {
            // Only letters and white space allowed for last name, and it should contain at least one letter
            die("Invalid last name");
        }

        if (!preg_match("/^[ -~]*$/", $newUser['username'])) {
            // All printable characters are allowed for username
            die("Only letters and numbers allowed for username");
        }

        if (!filter_var($newUser['email'], FILTER_VALIDATE_EMAIL)) {
            // Validate email
            die("Invalid email format");
        }

        if (!preg_match("/^[a-zA-Z0-9\.]*$/", $newUser['street'])) {
            // Only letters and numbers are allowed for street
            die("Invalid street name");
        }

        if (!preg_match("/^[a-zA-Z ]*$/", $newUser['city'])) {
            // Only letters and white space allowed
            die("Invalid city name");
        }
        
        if (!preg_match("/^\d{5}(-\d{4})?$/", $newUser['zipcode'])) {
            // 12345-1234
            die("Invalid zip code");
        }
        
        if (!preg_match("/^\d*$/", $newUser['phone'])) {
            die("Invalid phone number");
        }
        if (!preg_match("/^\d*$/", $newUser['extension'])) {
            die("Invalid extension number");
        }
        if (!preg_match("/^\d*$/", $newUser['country_code'])) {
            die("Invalid country code");
        }
        
        if (!preg_match("/^[ -~]*$/", $newUser['company'])) {
            //any printable
            die("Invalid characters in company name");
        }
        

        $newUser = array(
            'name' => filter_var($newUser['name'], FILTER_SANITIZE_STRING),
            'username' => filter_var($newUser['username'], FILTER_SANITIZE_STRING),
            'email' => filter_var($newUser['email'], FILTER_SANITIZE_EMAIL),
            'street' => filter_var($newUser['street'], FILTER_SANITIZE_STRING),
            'city' => filter_var($newUser['city'], FILTER_SANITIZE_STRING),
            'zipcode' => filter_var($newUser['zipcode'], FILTER_SANITIZE_STRING),
            'phone' => filter_var($newUser['phone'], FILTER_SANITIZE_STRING),
            'company' => filter_var($newUser['company'], FILTER_SANITIZE_STRING),
        );

        $this->userModel->addUser($newUser);
        $this->index();
    }

}