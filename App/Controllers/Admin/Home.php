<?php

namespace App\Controllers\Admin;

use App\Models\orders;
use Core\Mailer;
use Smarty;
use Classes\Password;

class Home extends \Core\Admin
{
    public function indexAction()
    {
        $ordersobj = new \App\Models\orders();
        $openorder = $ordersobj->GetLastOpenStatus();

        /**
         * Get all orders for displaying client list
         */
        $orders = $ordersobj->GetAllDesc();

        $this->tpl->assign('openorder', $openorder);
        $this->tpl->assign('orders', $orders);
 		$this->tpl->display('Admin/home.tpl');
    }

    /**
     * open new order
     */
    public function newAction()
    {
        $ordersobj = new orders();

        if($ordersobj->noOpenOrders()) {
            $passwordobj = new Password();
            $ordersobj->newOrder($passwordobj->generate(12));
            $order_key = $ordersobj->GetLastOrderKey();
            /**
             * Get all clients from database
             */
            $clientobj = new \App\Models\clients();
            $clients = $clientobj->GetAll();

            $mail = new Mailer();
            $smarty = new Smarty();
            $smarty_template_path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR;

            /**
             * mail all clients, telling them that it's possible to add a meal to the order
             */
            foreach ($clients as $key => $client) {
                $smarty->assign('order_key', $order_key);
                $smarty->assign('client_id', $client['key']);
                $smarty->assign('main_url', $_ENV['APP_URL']);
                $mail->sethtml($smarty->fetch($smarty_template_path . 'Email/neworder.tpl'));
                $mail->setaddress($client['email']);
                $mail->setname($client['name']);
                $mail->setsubject('Hungy? Order your sandwich directly');
                $mail->send();
            }
        }

        header('Location: /inloggen/home/');
    }

    /**
     * close openstanding order when url /inloggen/home/close/{number} is used
     */
    public function closeAction()
    {
        $ordersobj = new \App\Models\orders();
        $ordersobj->closeOrder($this->route_params['id']);
        header('Location: /inloggen/home/');
    }


}

