<?php

namespace FasLatam\Database;

use FasLatam\Common\User;
use FasLatam\Exceptions\UserCantRegisterException;
use FasLatam\Exceptions\UserNotExistsException;

class MysqlDatabaseRepository implements DatabaseRepository
{
    private readonly \PDO $con;

    public function __construct()
    {
        $host = "localhost";
        $db_name = "test";
        $username = "root";
        $password = null;

        $this->con = new \PDO(sprintf('mysql:host=%s;dbname=%s', $host, $db_name), $username, $password);
    }


    public function getUser(User $user): User
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

    public function insertUser(User $user): string
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

    private function existUser($num): bool
    {
        return $num == 1;
    }
}
