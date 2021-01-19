<?php

namespace App\Controllers\Admin;
use \App\Models\user;
use Flash;

class Password extends \Core\Admin
{
    public function indexAction()
    {
		if(isset($_POST['password1']) && isset($_POST['password2'])){
			if($_POST['password1'] === $_POST['password2']){
				$array = array(	
					'id' => $_SESSION['user_id'],
					'password_hash' => $_POST['password1']
				);
				$user = new user();
				
				if($user->savePass($array)){
					Flash::addMessage('Het nieuwe wachtwoord is opgeslagen en direct actief.');
				}
			}else{
				Flash::addMessage('De ingevulde wachtwoorden zijn niet gelijk aan elkaar.', Flash::WARNING);
			}
		}

		$this->tpl->display('Admin/password.tpl');
    }
}
