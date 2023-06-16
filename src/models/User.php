<?php
class User
{
    private $dataFile = __DIR__ . '/../../dataset/users.json';

    public function getAllUsers()
    {
        $data = json_decode(file_get_contents($this->dataFile), true);
        return $data;
    }

    public function removeUser($id)
    {
        $id = (int) $id;
        $users = $this->getAllUsers();
        foreach ($users as $index => $user) {
            if ($user['id'] === $id) {
                array_splice($users, $index, 1);
                break;
            }
        }
        file_put_contents($this->dataFile, json_encode($users, JSON_PRETTY_PRINT));
    }

    public function addUser($newUser)
    {
        $users = $this->getAllUsers();
        $id = end($users)['id'] + 1;

        $completeUser = array(
            "id" => $id,
            "name" => $newUser['name'],
            "username" => $newUser['username'],
            "email" => $newUser['email'],
            "address" => array(
                "street" => $newUser['street'],
                "suite" => "Default Suite",
                "city" => $newUser['city'],
                "zipcode" => $newUser['zipcode'],
                "geo" => array(
                    "lat" => "0.0000",
                    "lng" => "0.0000"
                )
            ),
            "phone" => $newUser['phone'],
            "website" => "defaultwebsite.com",
            "company" => array(
                "name" => $newUser['company'],
                "catchPhrase" => "Default CatchPhrase",
                "bs" => "Default BS"
            )
        );

        $users[] = $completeUser;
        file_put_contents($this->dataFile, json_encode($users, JSON_PRETTY_PRINT));
    }

}