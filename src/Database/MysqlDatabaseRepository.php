<?php

namespace App\Database;

use App\Common\User;
use App\Exceptions\UserCantRegisterException;
use App\Exceptions\UserNotExistsException;
use PDO;
use PDOException;

class MysqlDatabaseRepository implements DatabaseRepository
{
  private $conn;

  public function __construct()
  {
    $host = 'localhost';
    $db_name = 'test';
    $username = 'vagrant';
    $password = '';

    try {
      $this->conn = new PDO(
        "mysql:host=$host;dbname=$db_name",
        $username,
        $password
      );
    } catch (PDOException $exception) {
      throw $exception;
    }
  }

  public function getUser(User $user)
  {
    $query = 'SELECT email, password FROM users WHERE email = ? LIMIT 1';
    $stmt = $this->conn->prepare($query);
    $stmt->bindValue(1, $user->getEmail());
    $stmt->execute();

    if ($this->existUser($stmt->rowCount())) {
      throw new UserNotExistsException;
    } else {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $user->setPassword($row['password']);

      return $user;
    }
  }

  public function insertUser(User $user)
  {
    $query = 'INSERT INTO users (email, password) VALUES (?, ?)';
    $stmt = $this->conn->prepare($query);
    $stmt->bindValue(1, $user->getEmail());
    $stmt->bindValue(2, $user->getPassword());

    if ($stmt->execute()) {
      return 'Successful registration.';
    } else {
      throw new UserCantRegisterException;
    }
  }

  private function existUser($num) {
    return $num === 0;
  }
}
