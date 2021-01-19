<?php

namespace App\Controllers\Admin;
use App\Models\user;
use Flash;

class Account extends \Core\Admin
{
    public function indexAction()
    {

		if(isset($_SESSION['user_id'])){
			$sessionid = $_SESSION['user_id'];
		}else{
			$sessionid = '';
		}
	
		if(isset($_POST['naam']) && isset($_POST['email'])){
			$array = array(	
				'id' => $sessionid,
				'naam' => $_POST['naam'],
				'email' => $_POST['email']
			);
			$user = new user();
			
			if($user->saveUser($array)){
				Flash::addMessage('De instellingen zijn opgeslagen.');
			}else{
				Flash::addMessage('Er is iets fout gegaan bij het opslaan van de instellingen.', Flash::WARNING);
			}
		}
		
		$user = new user();
		$data = $user->getById($sessionid);
		$form = array('naam' => $data['name'],'email' => $data['email']);

		$this->tpl->assign('form',$form);
		$this->tpl->display('Admin/account.tpl');
    }
}
