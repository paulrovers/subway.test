<?php

namespace App\Models;

class orders extends \Core\Model
{
    public function GetAllById(int $id):array
    {
        $query = "SELECT * FROM orders WHERE id = :id";
        $array = [
            'id' => $id
        ];
        $result = $this->dbQuery($query,$array);

        if(count($result) > 0){
            return $result[0];
        }else{
            return [];
        }
    }

    public function GetByKey(string $key):array
    {
        $query = "SELECT * FROM orders WHERE `key` = :key LIMIT 1";
        $array = ['key' => $key];
        $result = $this->dbQuery($query,$array);
        return $result[0];
    }

    public function GetLastOpenStatus():mixed
    {
        $query = "SELECT * FROM orders ORDER BY id DESC LIMIT 1";
        $array = [];
        $result = $this->dbQuery($query,$array);
        if(count($result) > 0){
            return $result[0]['status'];
        }else{
            return 'closed';
        }
    }

    public function GetAllDesc():array
    {
        $query = "SELECT * FROM orders ORDER BY id DESC";
        $array = [];
        $result = $this->dbQuery($query,$array);
        return $result;
    }

    public function isOpenOrder(int $order_id):bool
    {
        $query = "SELECT * FROM orders WHERE `id` = :id LIMIT 1";
        $array = ['id' => $order_id];
        $result = $this->dbQuery($query,$array);
        $data = $result[0];

        if($data['status'] === 'open'){
            return true;
        }else{
            return false;
        }
    }

    public function isOpenOrderKey(string $key)
    {
        $query = "SELECT * FROM orders WHERE `key` = :key LIMIT 1";
        $array = ['key' => $key];
        $result = $this->dbQuery($query,$array);
        $data = $result[0];
        if($data['status'] === 'open'){
            return true;
        }else{
            return false;
        }
    }

    public function isValidOrderKey(string $key)
    {
        $query = "SELECT * FROM orders WHERE `key` = :key LIMIT 1";
        $array = ['key' => $key];
        $result = $this->dbQuery($query,$array);

        if(count($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    public function closeOrder(int $id):bool
    {
        $query = "UPDATE orders SET `status` = 'closed' WHERE id = :id";
        $array = [
            'id' => $id
        ];
        $this->dbQuery($query,$array);
        return true;
    }

    public function newOrder(string $key):bool
    {
        $query = "INSERT INTO orders (`key`, `status`) VALUES (:key, 'open')";
        $array = [
            'key' => $key
        ];
        $this->dbQuery($query,$array);
        return true;
    }

    public function GetLastOrderKey()
    {
        $query = "SELECT * FROM `orders` ORDER BY `id` DESC LIMIT 1;";
        $array = [];
        $result = $this->dbQuery($query,$array);
        return $result[0]['key'];
    }

    public function noOpenOrders()
    {
        $query = "SELECT * FROM `orders` Where `status` = 'open'";
        $array = [];
        $result = $this->dbQuery($query,$array);

        if(count($result) > 0){
            return false;
        }else{
            return true;
        }
    }
}