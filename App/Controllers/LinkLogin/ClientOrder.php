<?php

namespace App\Controllers\LinkLogin;

use App\Models\orders;
use App\Models\sandwiches;
use App\Models\sandwichoptions;
use Smarty;

class ClientOrder extends \Core\LinkLogin
{

    private $extras='';
    private $vegetables='';
    private $sauce='';
    public Smarty $tpl;

    public function __CONSTRUCT($route_params)
    {
        $this->route_params = $route_params;
        $this->tpl = new Smarty;
        $this->tpl->setTemplateDir('../App/Views');
        $this->tpl->setCompileDir('../App/Views/Compile');
        $this->tpl->setCacheDir('../App/Views/Cache');
        $this->tpl->caching = 0;
        $this->tpl->cache_lifetime = 300;

        $this->standalone = '1';
    }

    public function indexAction()
    {
        if(isset($_POST['submit'])){
            $order = $this->CreateOrder($_POST);
            $sandwichobj = new sandwiches();
            $sandwichobj->saveSandwich($_SESSION['order_id'],$_SESSION['client_id'],$order);
            $options = array();
            $_SESSION['order'] = true;
        }else{
            $optionsobj = new sandwichoptions();
            $options = $optionsobj->getSandwichOptions();
        }

        $previousOrders = $this->GetOrderList();

        $this->tpl->assign('sandwiches', $previousOrders);
        $this->tpl->assign('session', $_SESSION);
        $this->tpl->assign('options', $options);
        $this->tpl->display('LinkLogin/clientorder.tpl');
    }

    public function edit()
    {
        $sandwichid = $this->route_params['sandwichid'];

        if(isset($_POST['submit'])){
            $order = $this->CreateOrder($_POST);
            $sandwichobj = new sandwiches();
            $sandwichobj->updateSandwich($sandwichid,$order);
            $_SESSION['order'] = true;
            header('Location: /order/'.$_SESSION['order_id'].'/');
        }

        $sandwichobj = new sandwiches();
        $sandwich = $sandwichobj->GetById($sandwichid);

        $options = $this->AddSelectedMarkers($sandwichid);

        $this->tpl->assign('sandwich', $sandwich);
        $this->tpl->assign('session', $_SESSION);
        $this->tpl->assign('options', $options);
        $this->tpl->display('LinkLogin/editclientorder.tpl');
    }

    private function AddSelectedMarkers($sandwichid)
    {
        $optionsobj = new sandwichoptions();
        $options = $optionsobj->getSandwichOptions();
        $sandwichobj = new sandwiches();
        $sandwich = $sandwichobj->GetById($sandwichid);

        //make sandwich array searchable
        $array = unserialize($sandwich['options']);
        $subarray = array_merge(explode(', ',$array['extras']), explode(', ',$array['vegetables']));
        $subarray = array_merge($subarray, explode(', ',$array['sauce']));
        $array = array_merge($array, $subarray);

        //unserialize options field
        foreach($options as $key => $optionvalue){
            $options[$key]['options'] = unserialize($optionvalue['options']);
        }
        //add field checked status
        foreach($options as $key => $optionvalue){
            foreach($options[$key]['options'] as $key2 => $optionvalue2) {
                if(in_array($optionvalue2, $array)){
                    $active = 1;
                }else{
                    $active = 0;
                }
                $options[$key]['options'][$key2] = array($optionvalue2,$active);
            }
        }

        return $options;
    }


    public function new()
    {
        $_SESSION['order'] = false;
        header('Location: /order/'.$_SESSION['order_id'].'/');
    }

    /**
     * @return array
     * Get last 10 sandwiches and add status to the array to see if you allowed to edit the sandwich in the order panel
     */
    private function GetOrderList()
    {
        $sandwichobj = new sandwiches();
        $previousOrders = $sandwichobj->GetAllFromClientId($_SESSION['client_id']);

        $orderobj = new orders();

        foreach($previousOrders as $key => $sandwich){
            $order = $orderobj->GetAllById($sandwich['order_id']);
            $previousOrders[$key]['date'] = $order['date'];
            $previousOrders[$key]['status'] = $order['status'];
        }

        return $previousOrders;
    }

    /**
     * Set extras, vegetables & sauce details for current sandwich
     * and return the serialized details for saving in database.
     */
    private function CreateOrder(array $formContent):string
    {
        if(isset($formContent['extras'])){
            foreach($formContent['extras'] as $key => $value){
                $this->extras .= $key.', ';
            }
        }
        if(isset($formContent['vegetables'])) {
            foreach ($formContent['vegetables'] as $key => $value) {
                $this->vegetables .= $key . ', ';
            }
        }
        if(isset($formContent['sauce'])) {
            foreach ($formContent['sauce'] as $key => $value) {
                $this->sauce .= $key . ', ';
            }
        }

        $sandwichDetails = array(
            'breadtype' => $formContent['breadtype'],
            'size' => $formContent['size'],
            'ovenbaked' => $formContent['ovenbaked'],
            'taste' => $formContent['taste'],
            'extras' => $this->extras,
            'vegetables' => $this->vegetables,
            'sauce' => $this->sauce
        );

        return serialize($sandwichDetails);
    }

}

