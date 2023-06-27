<?php

namespace App\Models;

class sandwiches extends \Core\Model
{
    public function GetById(int $id):array
    {
        $query = "SELECT * FROM `sandwiches` WHERE `id` = :id";
        $array = [
            'id' => $id
        ];
        $result = $this->dbQuery($query,$array);
        return $result[0];
    }

    public function saveSandwich(int $order_id, int $client_id, string $order):bool
    {
        $query = "INSERT INTO sandwiches (`order_id`,`client_id`,`options`) VALUES (:order_id, :client_id, :options)";
        $array = [
            'order_id' => $order_id,
            'client_id' => $client_id,
            'options' => $order
        ];
        $this->dbQuery($query,$array);
        return true;
    }

    public function updateSandwich(int $id, string $order):bool
    {
        $query = "UPDATE sandwiches SET `options` = :options WHERE id = :id";
        $array = [
            'id' => $id,
            'options' => $order
        ];
        $this->dbQuery($query,$array);
        return true;
    }

    public function GetAllFromOrderId(int $order_id):array
    {
        $query = "SELECT * FROM `sandwiches` WHERE `order_id` = :id";
        $array = [
            'id' => $order_id
        ];
        return $this->dbQuery($query,$array);
    }

    public function GetAllFromClientId(int $client_id):array
    {
        $query = "SELECT * FROM `sandwiches` WHERE `client_id` = :id ORDER BY id DESC LIMIT 10";
        $array = [
            'id' => $client_id
        ];
        return $this->dbQuery($query,$array);
    }

    public function DeleteSandwich(int $sandwich_id):bool
    {
        $query = "DELETE FROM `sandwiches` WHERE `id` = :id";
        $array = [
            'id' => $sandwich_id
        ];
        $this->dbQuery($query,$array);
        return true;
    }

}