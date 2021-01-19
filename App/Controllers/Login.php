<?php

namespace App\Controllers;
use \App\Models\user;
use \App\Auth;
use Flash;

class login extends \Core\Controller
{
    public $strTitle = 'Login';
    public $strDescription = 'Login';
	public $strPageurl = PREFIX.SYS_SITE_NAME.'/inloggen/';

    public function indexAction()
    {
		
		if (isset($_POST['email']) && isset($_POST['password']) &&  $user = user::checkUser($_POST['email'], $_POST['password'])) {
			Auth::login($user);
			header("Location: /inloggen/home/");
		}elseif(isset($_SESSION['user_id'])){
			header("Location: /inloggen/home/");
		}elseif (isset($_POST['email']) && isset($_POST['password'])) {
			Flash::addMessage('Login details are incorrect, please try again', Flash::WARNING);
			$this->tpl->assign('email',$_POST['email']);
			$this->tpl->display('login.tpl');
		}else{
			$this->tpl->assign('email','');
			$this->tpl->display('login.tpl');
		}
    }

    public function logoutAction()
    {
            Auth::logout();
            header("Location: /");
			exit;
    }

}
