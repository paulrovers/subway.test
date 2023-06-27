<?php

namespace App\Controllers;

use App\Models\user;
use Core\Authenticate;
use Classes\Flash;

class Login extends \Core\Controller
{
    public $strTitle = 'Login';
    public $strDescription = 'Login';
	public $strPageurl = '';

    public function indexAction()
    {
		$this->strPageurl = $_ENV['APP_URL'].'inloggen/';
        $userObj = new user();

		if (isset($_POST['email']) && isset($_POST['password']) &&  $user = $userObj->checkUser($_POST['email'], $_POST['password'])) {
            Authenticate::login($user);
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
        Authenticate::logout();
        header("Location: /");
		exit;
    }

}
