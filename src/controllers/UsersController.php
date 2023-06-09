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
        $this->userModel->addUser($newUser);
        $this->index();
    }
}