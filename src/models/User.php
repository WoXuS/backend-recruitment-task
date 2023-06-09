<?php
class User
{
    private $dataFile = __DIR__ . '/../../dataset/users.json';

    public function getAllUsers() {
        $data = json_decode(file_get_contents($this->dataFile), true);
        return $data;
    }

    public function removeUser($id) {
        $users = $this->getAllUsers();
        foreach ($users as $index => $user) {
            if ($user['id'] === $id) {
                array_splice($users, $index, 1);
                break;
            }
        }
        file_put_contents($this->dataFile, json_encode($users));
    }

    public function addUser($newUser) {
        $users = $this->getAllUsers();
        $users[] = $newUser;
        file_put_contents($this->dataFile, json_encode($users));
    }
}
