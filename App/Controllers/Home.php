<?php

namespace App\Controllers;
use \App\Models\user;
use \App\Auth;
use Flash;


class Home extends \Core\Controller
{

    public $strTitle = '';
    public $strDescription = '';
	public $strPageurl = PREFIX.SYS_SITE_NAME;

    public function indexAction()
        
    {
		if (isset($_POST['email']) && isset($_POST['password']) &&  $user = user::checkUser($_POST['email'], $_POST['password'])) {
			Auth::login($user);
			header("Location: /inloggen/home/");
		}elseif(isset($_SESSION['user_id'])){
			header("Location: /inloggen/home/");
		}elseif (isset($_POST['email']) && isset($_POST['password'])) {
			Flash::addMessage('Combinatie van email en wachtwoord zijn onjuist', Flash::WARNING);
			$this->tpl->assign('email',$_POST['email']);
			$this->tpl->display('frontpage.tpl');
		}else{
			$this->tpl->assign('email','');
			$this->tpl->display('frontpage.tpl');
		}
    }


   public function logoutAction()
    {
            Auth::logout();
            header("Location: /");
    }

}
