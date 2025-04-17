<?php

declare(strict_types=1);

namespace FasLatam\Database;

use PDO;
use FasLatam\Common\User;
use FasLatam\Exceptions\UserCantRegisterException;
use FasLatam\Exceptions\UserNotExistsException;

class MysqlDatabaseRepository implements DatabaseRepository
{
    private readonly PDO $pdo;

    public function __construct()
    {
        $host = "localhost";
        $db_name = "test";
        $username = "root";
        $password = null;

        $this->pdo = new PDO(sprintf('mysql:host=%s;dbname=%s', $host, $db_name), $username, $password);
    }


    public function getUser(User $user): User
    {
        $query = "SELECT email, password FROM users WHERE email = ? LIMIT 1";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindValue(1, $user->getEmail());
        $stmt->execute();

        if (!$this->existUser($stmt->rowCount())) {
            throw new UserNotExistsException;
        }

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user->setPassword($row['password']);
        return $user;
    }

    public function insertUser(User $user): string
    {
        // insert command
        $query = "INSERT INTO users SET email = ?, password = ?";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindValue(1, $user->getEmail());
        $stmt->bindValue(2, $user->getPassword());

        // execute the query
        if ($stmt->execute()) {
            return "Successful registration.";
        }

        throw new UserCantRegisterException;
    }

    private function existUser($num): bool
    {
        return $num == 1;
    }
}
