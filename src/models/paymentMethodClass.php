<?php

namespace TeldsShop\models;

use TeldsShop\models\A_Model;

class paymentMethodClass extends A_Model
{
    public int $id;
    public bool $is_active;
    public string $name;

    public function findById(int $id): array
    {
        // TODO: Implement findById() method.
    }

    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }

    public function insert(array $values): bool
    {
        // TODO: Implement insert() method.
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getIs_active(): bool
    {
        return $this->is_active;
    }
    public function setIs_active(bool $is_active): void
    {
        $this->is_active = $is_active;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
