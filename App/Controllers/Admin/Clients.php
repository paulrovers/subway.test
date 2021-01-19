<?php

namespace App\Controllers\Admin;

use flash;
use password;

class Clients extends \Core\Admin
{
    public function indexAction()
    {
        $clientsobj = new \App\Models\clients();

        /**
         * check if form fields are used and save values
         */
        if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['name'])){
            $passwordobj = new password();
            $newclient = array(
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'key' => $passwordobj->generate(12)
            );

            if($clientsobj->saveClient($newclient)){
                Flash::addMessage('The new client has been added.');
            }
        }elseif(isset($_POST['submit'])){
            Flash::addMessage('Please fill in all fields to continue.', Flash::WARNING);
        }

        /**
         * Get all clients for displaying client list
         */
        $clients = $clientsobj->GetAll();
        $this->tpl->assign('clients', $clients);

		$this->tpl->display('Admin/clients.tpl');
    }

    public function deleteAction()
    {
        $clientsobj = new \App\Models\clients();
        $clientsobj->deleteClient($this->route_params['id']);

        header('Location: /inloggen/clients/');
    }

}
