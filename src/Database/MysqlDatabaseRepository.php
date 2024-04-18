<?php

namespace App\Database;

use App\Common\User;
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
  }

  public function insertUser(User $user)
  {
  }
}
