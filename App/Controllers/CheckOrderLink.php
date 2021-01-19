<?php

namespace App\Controllers;
use App\Config\Smarty\SmartyTemplate;
use App\Models\clients;
use App\Models\orders;
use \App\Auth;

class CheckOrderLink extends \Core\Controller
{

    public $strTitle = '';
    public $strDescription = '';
    public $strPageurl = PREFIX.SYS_SITE_NAME;

    public function __CONSTRUCT($route_params)
    {
        $this->route_params = $route_params;
        $this->tpl = new SmartyTemplate;
        $this->standalone = '1';
    }

    public function indexAction()
    {
        if($this->Checklink($this->route_params['orderkey'],$this->route_params['clientkey']))
        {
            $orderobj = new orders();
            $order = $orderobj->Get($this->route_params['orderkey'],'key');
            $clientobj = new clients();
            $client = $clientobj->Get($this->route_params['clientkey'],'key');

            $sessionvars = array(
                'order_id' => $order['id'],
                'client_id' => $client['id'],
                'client_name' => $client['name']
            );

            /**
             * login and redirect to orderpage
             */
            Auth::loginLink($sessionvars);
            header("Location: /order/".$order['id']."/");
        }else{
            echo 'Link failed';
        }

    }

    /**
     * @param $orderkey
     * @param $clientkey
     * @return bool
     * Check if the orderkey and clientkey are valid and the order is still open
     */
    public function Checklink($orderkey, $clientkey)
    {
        $order = new orders();
        $client = new clients();

        if($order->isValidOrderKey($orderkey) && $order->isOpenOrderKey($orderkey) && $client->isValidClientKey($clientkey))
        {
            return true;
        }else{
            return false;
        }

    }


}
