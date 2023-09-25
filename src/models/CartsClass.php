<?php

namespace TeldsShop\src\models;

use TeldsShop\models\A_Model;

class CartsClass extends A_Model
{
    CONST DB_TABLE_NAME = "carts";
    CONST DB_FILED_ID = "id";
    CONST DB_FILED_QUANTITY = "quantity";
    CONST DB_FILED_USER_ID = "user_id";
    CONST DB_FILED_PRODUCT_ID = "product_id";
    CONST DB_FILED_PAYMENT_METHODS = "payment_method_id";
    CONST DB_FILED_IS_PAYED = "is_payed";

    public int $id;
    public int $quantity;
    public int $user_id;
    public bool $is_payed;
    public string $payment_method_id;
    public int $product_id;


    public function findById(int $id): array
    {
        // TODO: Implement findById() method.
    }

    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getProduct_id(): int
    {
        return $this->product_id;
    }
    public function setProduct_id(int $product_id): void
    {
        $this->product_id = $product_id;
    }
    public function getUser_id(): int
    {
        return $this->user_id;
    }
    public function setUser_id(int $user_id): void
    {
        $this->user_id = $user_id;
    }
    public function getQuantity(): int
    {
        return $this->quantity;
    }
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
    public function getIs_payed(): bool
    {
        return $this->is_payed;
    }
    public function setIs_payed(bool $is_payed): void
    {
        $this->is_payed = $is_payed;
    }
    public function getPayment_method_id(): int
    {
        return $this->payment_method_id;
    }
    public function setPayment_method_id(int $payment_method_id): void
    {
        $this->payment_method_id = $payment_method_id;
    }

    public function addToCart()
    {

    }

    public function insertIntoCart(array $values): bool
    {
        $pdo = require  __DIR__ . "/../../conn/DatabaseConnection.php";
        $stm = $pdo->prepare("INSERT INTO" . self::DB_TABLE_NAME . "($this->quantity, $this->user_id, $this->product_id, $this->payment_method_id), VALUES(:quantity, :user_id, :product_id, :payment_method_id)");
        $stm->bindParam(":quantity", $values[self::DB_FILED_QUANTITY]);
        $stm->bindParam(":user_id", $values[self::DB_FILED_USER_ID]);
        $stm->bindParam(":product_id", $values[self::DB_FILED_PRODUCT_ID]);
        $stm->bindParam(":payment_method_id", $values[self::DB_FILED_PAYMENT_METHODS]);
        $result = $stm->execute();

        return $result;
    }

    public function updateToCartCheckout(int $id)
    {
        $pdo = require  __DIR__ . "/../../conn/DatabaseConnection.php";
        $stm = $pdo->prepare("UPDATE" . self::DB_TABLE_NAME . "SET $this->is_payed='1' WHERE id=:id");
        $stm->bindParam(":id", $id);
        $result = $stm->execute();

        return $result;
    }

    public function deleteCartByProductId(int $id): bool
    {
        $pdo = require  __DIR__ . "/../../conn/DatabaseConnection.php";
        $stm = $pdo->prepare("DELETE FROM" . self::DB_TABLE_NAME . "WHERE product_id=:product_id AND user_id=:user_id");
        $stm->bindParam(":product_id", $id);
        $stm->bindParam(":user_id", $_SESSION['user']['id']);
        $result = $stm->exectute();

        return $result;
    }

    public function findCartByUserIdJoinWithProducts(int $userId): array
    {
        $pdo = require  __DIR__ . "/../../conn/DatabaseConnection.php";
        $stm = $pdo->prepare("SELECT * FROM" . self::DB_TABLE_NAME. "JOIN products ON cart.product_id=products.id WHERE $this->is_payed=0 AND $this->user_id=" . $userId);
        $result = [];
        $stm->execute();

        foreach ($stm as $row){
            $result[] = $row;
        }
        return $result;
    }

    public function findCartByUserId(int $userId): array
    {
        $pdo = require  __DIR__ . "/../../conn/DatabaseConnection.php";
        $stm = $pdo->prepare("SELECT * FROM" . self::DB_TABLE_NAME . "WHERE $this->is_payed=0 AND $this->user_id=" . $userId);
        $result = [];
        $stm->execute();
        foreach($stm as $row){
            $result[] = $row;
        }
        return $result;
    }
}