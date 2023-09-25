<?php

namespace TeldsShop\models;

class UsersClass extends A_Model
{
    const DB_TABLE_NAME = "users";
    const DB_FIELD_EMAIL = "email";
    const DB_FIELD_PASSWORD = "password";
    const DB_FIELD_ADDRESS = "address";
    public int $id;
    public string $password;
    public string $email;
    public string $address;

    public function findById(int $id): array
    {
        $pdo = require  __DIR__ . "/../../conn/DatabaseConnection.php";
        $stm = $pdo->prepare("SELECT * FROM" . self::DB_TABLE_NAME . "WHERE $this->id=:id");
        $stm->bindparam(":id", $id);
        $result = [];
        $stm->execute();
        foreach($stm as $row)
        {
            $result[] = $row;
        }
        return $result;
    }

    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }

    public function insert(array $values): bool
    {
        $pdo = require  __DIR__ . "/../../conn/DatabaseConnection.php";
        $stm = $pdo->prepare("INSERT INTO" . self::DB_TABLE_NAME . "(email, password, address), VALUES(:email, :password, :address)");
        $stm->bindParam(":email", $values[self::DB_FIELD_EMAIL]);
        $stm->bindParam(":password", $values[self::DB_FIELD_PASSWORD]);
        $stm->bindParam(":address", $values[self::DB_FIELD_ADDRESS]);
        $result = $stm->execute();

        return $result;
    }

    public function findByEmail(string $email): array
    {
        $pdo = require  __DIR__ . "/../../conn/DatabaseConnection.php";
        $stm = $pdo->prepare("SELECT * FROM" . self::DB_TABLE_NAME . "WHERE $this->email=:email");
        $stm->bindParam(":email", $email);
        $stm->execute();
        $result = $stm->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }
}