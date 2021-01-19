<?php

namespace App\Models;

class orders extends \Core\ModelObject
{
    public $id;
    public $status;
    public $date;

    function __construct()
    {
        parent::SetTable('orders');
        parent::SetPrimaryKey('id');
        parent::AddField('id');
        parent::AddField('status');
        parent::AddField('date');
        parent::AddField('key');
    }

    public static function GetLastOpenStatus()
    {
        $sql = "SELECT * FROM `orders` Where 1 Order by id desc LIMIT 1;";
        $res = parent::dbQuery($sql);
        if($data = mysqli_fetch_assoc($res)){
            return $data['status'];
        }else{
            return 'closed';
        }
    }

    public static function GetAllDesc()
    {
        $sql = "SELECT * FROM `orders` Where 1 Order by id desc;";
        $res = parent::dbQuery($sql);
        $orders = [];
        while($data = mysqli_fetch_assoc($res)){
            $orders[] = $data;
        }
        return $orders;
    }

    public static function isOpenOrder($order_id)
    {
        $sql = "SELECT * FROM `orders` Where id = '".$order_id."';";
        $res = parent::dbQuery($sql);
        $data = mysqli_fetch_assoc($res);
        if($data['status'] === 'open'){
            return true;
        }else{
            return false;
        }
    }

    public static function isOpenOrderKey($key)
    {
        $sql = "SELECT * FROM `orders` Where `key` = '".$key."';";
        $res = parent::dbQuery($sql);
        $data = mysqli_fetch_assoc($res);
        if($data['status'] === 'open'){
            return true;
        }else{
            return false;
        }
    }

    public static function isValidOrderKey($key)
    {
        $sql = "SELECT * FROM `orders` Where `key` = '".$key."';";
        $res = parent::dbQuery($sql);
        if(mysqli_num_rows($res) === 1){
            return true;
        }else{
            return false;
        }
    }

    public static function closeOrder($id)
    {
        $order = new orders();
        $order->id = $id;
        $order->status = 'closed';
        $order->Save();
        return true;
    }

    public static function newOrder($key)
    {
        $order = new orders();
        $order->status = 'open';
        $order->key = $key;
        $order->Insert();
        return true;
    }

    public static function GetLastOrderKey()
    {
        $sql = "SELECT * FROM `orders` Where 1 order by `id` DESC LIMIT 1;";
        $res = parent::dbQuery($sql);
        $order = mysqli_fetch_assoc($res);
        return $order['key'];
    }

    public function noOpenOrders()
    {
        $sql = "SELECT * FROM `orders` Where `status` = 'open';";
        $res = parent::dbQuery($sql);
        if(mysqli_num_rows($res) > 0){
            return false;
        }else{
            return true;
        }
    }




}