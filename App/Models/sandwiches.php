<?php

namespace App\Models;

class sandwiches extends \Core\ModelObject
{
    public $id;
    public $order_id;
    public $client_id;
    public $key;
    public $options;

    function __construct()
    {
        parent::SetTable('sandwiches');
        parent::SetPrimaryKey('id');
        parent::AddField('id');
        parent::AddField('order_id');
        parent::AddField('client_id');
        parent::AddField('key');
        parent::AddField('options');
    }

    public static function saveOptions($sandwich_id, $options)
    {
        $sandwich = new sandwiches();
        $sandwich->id = $sandwich_id;
        $sandwich->options = $options;
        $sandwich->Save();
        return true;
    }

    public static function saveSandwich($order_id, $client_id, $order)
    {
        $sandwich = new sandwiches();
        $sandwich->order_id = $order_id;
        $sandwich->client_id = $client_id;
        $sandwich->options = $order;
        $sandwich->Insert();
        return true;
    }

    public static function updateSandwich($id, $order)
    {
        $sandwich = new sandwiches();
        $sandwich->id = $id;
        $sandwich->options = $order;
        $sandwich->Save();
        return true;
    }

    public static function GetAllFromOrderId($order_id)
    {
        $sql = "SELECT * FROM `sandwiches` Where order_id='".$order_id."';";
        $res = parent::dbQuery($sql);
        $sandwiches = [];
        while($data = mysqli_fetch_assoc($res)){
            $sandwiches[] = $data;
        }
        return $sandwiches;
    }

    public static function GetAllFromClientId($client_id)
    {
        $sql = "SELECT * FROM `sandwiches` Where client_id='".$client_id."' order by `id` DESC LIMIT 10;";
        $res = parent::dbQuery($sql);
        $sandwiches = [];
        while($data = mysqli_fetch_assoc($res)){
            $sandwiches[] = $data;
        }
        return $sandwiches;
    }

    public static function DeleteSandwich($sandwich_id)
    {
        $sandwich = new sandwiches();
        $sandwich->id = $sandwich_id;
        $sandwich->Delete();
        return true;
    }

}