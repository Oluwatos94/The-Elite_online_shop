<?php

namespace TeldsShop\src\models;


interface I_Model
{
    public function findById(int $id): array;

    public function findAllById(int $id): array;

    public function findAll(): array;

    public function insert(array $values): bool;

    public function deleteById(int $id): bool;
}