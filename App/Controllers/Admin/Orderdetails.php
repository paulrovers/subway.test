<?php

namespace App\Controllers\Admin;

class Orderdetails extends \Core\Admin
{
    public function indexAction()
    {
        $sandwiches = $this->CreateCompleteOrder($this->route_params['id']);

        $ordersobj = new \App\Models\orders();
        $order = $ordersobj->GetAllById($this->route_params['id']);

        $this->tpl->assign('sandwiches', $sandwiches);
        $this->tpl->assign('order', $order);
		$this->tpl->display('Admin/orderdetails.tpl');
    }

    /**
     * Add name & email to sandwiches array
     */
    private function CreateCompleteOrder(int $order_id):array
    {
        $sandwichobj = new \App\Models\sandwiches();
        $sandwiches = $sandwichobj->GetAllFromOrderId($order_id);
        $clientobj = new \App\Models\clients();

        foreach($sandwiches as $key => $details){
           $sandwiches[$key]['name'] = $clientobj->GetName($sandwiches[$key]['client_id']);
           $sandwiches[$key]['email'] = $clientobj->GetEmail($sandwiches[$key]['client_id']);
        }

        return $sandwiches;
    }

    /**
     * Delete sandwich and return to orderdetails page
     */
    public function deleteAction()
    {
        $ordersobj = new \App\Models\orders();

        if($ordersobj->isOpenOrder($this->route_params['id']))
        {
            $sandwichobj = new \App\Models\sandwiches();
            $sandwichobj->DeleteSandwich($this->route_params['delid']);
        }

        header('Location: /inloggen/orderdetails/'.$this->route_params['id'].'/');
    }

}
