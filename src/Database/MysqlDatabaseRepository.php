<?php

namespace FasLatam\Database;

use FasLatam\Common\User;
use FasLatam\Exceptions\UserCantRegisterException;
use FasLatam\Exceptions\UserNotExistsException;

class MysqlDatabaseRepository implements DatabaseRepository
{
    private $con;

    public function __construct()
    {
        $host = "localhost";
        $db_name = "test";
        $username = "root";
        $password = null;

        try {
            $this->con = new \PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
        } catch (\PDOException $exception) {
            throw $exception;
        }
    }


    public function getUser(User $user)
    {
        $query = "SELECT email, password FROM users WHERE email = ? LIMIT 1";
        $stmt = $this->con->prepare($query);

        $stmt->bindValue(1, $user->getEmail());
        $stmt->execute();

        if (!$this->existUser($stmt->rowCount())) {
            throw new UserNotExistsException;
        } else {
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            $user->setPassword($row['password']);

            return $user;
        }
    }

    public function insertUser(User $user)
    {
        // insert command
        $query = "INSERT INTO users SET email = ?, password = ?";

        $stmt = $this->con->prepare($query);

        $stmt->bindValue(1, $user->getEmail());
        $stmt->bindValue(2, $user->getPassword());

        // execute the query
        if ($stmt->execute()) {
            return "Successful registration.";
        } else {
            throw new UserCantRegisterException;
        }
    }

    private function existUser($num)
    {
        return $num == 1;
    }
}
