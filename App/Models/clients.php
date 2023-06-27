<?php

namespace App\Models;

class clients extends \Core\Model
{
    public function GetAll():array
    {
        $query = "SELECT * FROM clients";
        $array = [];
        $result = $this->dbQuery($query,$array);

        if(count($result) > 0){
            return $result;
        }else{
            return [];
        }
    }

    public function GetByKey(string $key):array
    {
        $query = "SELECT * FROM clients WHERE `key` = :key LIMIT 1";
        $array = ['key' => $key];
        $result = $this->dbQuery($query,$array);
        return $result[0];
    }

    public function saveClient($form):bool
    {
        $query = "INSERT INTO clients (`name`,`email`,`key`) VALUES (:name, :email, :key)";
        $array = [
            'name' => $form['name'],
            'email' => $form['email'],
            'key' => $form['key']
        ];
        $this->dbQuery($query,$array);
        return true;
    }

    public function isValidClientKey(string $key):bool
    {
        $query = "SELECT * FROM clients WHERE `key` = :key";
        $array = ['key' => $key];
        $result = $this->dbQuery($query,$array);

        if(count($result) == 1){
            return true;
        }else{
            return false;
        }
    }

    public function deleteClient(int $id):bool
    {
        $query = "DELETE FROM clients WHERE `id` = :id";
        $array = ['id' => $id];
        $this->dbQuery($query,$array);
        return true;
    }

    public function getName(int $id):string
    {
        $query = "SELECT * FROM clients WHERE `id` = :id";
        $array = ['id' => $id];
        $result = $this->dbQuery($query,$array);
        return $result[0]['name'];
    }

    public function getEmail(int $id):string
    {
        $query = "SELECT * FROM clients WHERE `id` = :id";
        $array = ['id' => $id];
        $result = $this->dbQuery($query,$array);
        return $result[0]['email'];
    }

}