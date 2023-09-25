<?php

namespace TeldsShop\models;


use TeldsShop\models\I_Model;

abstract class A_Model implements I_Model
{
    public function findAllById(int $id): array
    {

    }

    public function findAll(): array
    {
        // TODO: Implement findAll() method.
    }

    public function deleteById(int $id): bool
    {

    }

    public function updateByIid()
    {

    }
}
