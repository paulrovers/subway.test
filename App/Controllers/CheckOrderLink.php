<?php

namespace App\Controllers;
use Core\Authenticate;
use App\Models\clients;
use App\Models\orders;

class CheckOrderLink extends \Core\Controller
{
    public $strTitle = '';
    public $strDescription = '';
    public $strPageurl = '';

    public function __CONSTRUCT($route_params)
    {
        $this->route_params = $route_params;
        $this->standalone = '1';
        $this->tpl = new \Smarty();
        $this->tpl->setTemplateDir('../App/Views');
        $this->tpl->setCompileDir('../App/Views/Compile');
        $this->tpl->setCacheDir('../App/Views/Cache');
        $this->tpl->caching = 0;
        $this->tpl->cache_lifetime = 300;
    }

    public function indexAction()
    {
        if($this->Checklink($this->route_params['orderkey'],$this->route_params['clientkey']))
        {
            $orderobj = new orders();
            $order = $orderobj->GetByKey($this->route_params['orderkey']);
            $clientobj = new clients();
            $client = $clientobj->GetByKey($this->route_params['clientkey']);

            $sessionvars = array(
                'order_id' => $order['id'],
                'client_id' => $client['id'],
                'client_name' => $client['name']
            );

            /**
             * login and redirect to orderpage
             */
            Authenticate::loginLink($sessionvars);
            header("Location: /order/".$order['id']."/");
        }else{
            echo 'Link failed';
        }
    }

    /**
     * Check if the orderkey and clientkey are valid and the order is still open
     */
    public function Checklink(string $orderkey, string $clientkey):bool
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
