<?php

namespace App\Models;

class clients extends \Core\ModelObject
{
    public $id;
    public $email;
    public $name;
    public $key;

    function __construct()
    {
        parent::SetTable('clients');
        parent::SetPrimaryKey('id');
        parent::AddField('id');
        parent::AddField('email');
        parent::AddField('name');
        parent::AddField('key');
    }

    public static function saveClient($form)
    {
        $client = new clients();
        $client->name = $form['name'];
        $client->email = $form['email'];
        $client->key = $form['key'];
        $client->Insert();
        return true;
    }

    public static function isValidClientKey($key)
    {
        $sql = "SELECT * FROM `clients` Where `key` = '".$key."';";
        $res = parent::dbQuery($sql);
        if(mysqli_num_rows($res) === 1){
            return true;
        }else{
            return false;
        }
    }

    public static function deleteClient($id)
    {
        $client = new clients();
        $client->id = $id;
        $client->Delete();
        return true;
    }

    public static function getName($id)
    {
        $client = new clients();
        $data = $client->Get($id);
        return $data['name'];
    }

    public static function getEmail($id)
    {
        $client = new clients();
        $data = $client->Get($id);
        return $data['email'];
    }

}