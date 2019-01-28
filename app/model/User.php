<?php

class Model_User extends Framework_Model
{
    public function getUser(string $username, string $password): array
    {
        $statement = $this->prepare("SELECT id, username, admin
                                     FROM users
                                     WHERE username = :username
                                     AND password = :password
                                     LIMIT 1");

        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', md5($password));

        $statement->execute();
        $data = $statement->fetch();

        if ($data) {
            UserStorage::getInstance()->setCookie($data);
        }

        return $data;
    }
}