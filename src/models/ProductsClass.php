<?php

namespace TeldsShop\src\models;

use TeldsShop\models\A_Model;

class ProductsClass extends A_Model
{
    const DB_TABLE_NAME = "products";

    const DB_FILED_ID = "id";
    const DB_FILED_PRICE = "price";
    const DB_FILED_DESCRIPTION = "description";
    const DB_FILED_IMAGE = "image";
    const DB_FILED_NAME = "name";

    public int $id;
    public float $price;
    public string $description;
    public string $image;
    public string $name;

    /**
     * @param int $id
     * @return array
     */
    public function findById(int $id): array
    {
        $pdo = require __DIR__ . "/../../conn/DatabaseConnection.php";
        $stm = $pdo->prepare("SELECT * FROM" . self::DB_TABLE_NAME . "WHERE id=:id");
        $stm->bindParam(":id", $id);
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

    public function getPrice(): float
    {
        return $this->price;
    }
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }
    public function insert(array $values): bool
    {
        // TODO: Implement insert() method.
    }

    /**
     * @return int
     */
    public function maximumId(): int
    {
        $pdo = require __DIR__ . "/../../conn/DatabaseConnection.php";
        $stm = $pdo->prepare("SELECT max($this->id) as id FROM" . self::DB_TABLE_NAME);
        $stm->execute();
        $result = $stm->fetch(\PDO::FETCH_ASSOC);

        return $result['id'];
    }

}