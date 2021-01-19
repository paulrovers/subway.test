<?php

namespace Core;

use App\Config\Smarty\SmartyTemplate;
use App\Auth;

abstract class Controller
{

    protected $route_params = [];


    public function __construct($route_params)
    {
        $this->route_params = $route_params;
        $this->tpl = new SmartyTemplate;

    }

    public function __destruct()
    {
		if(isset($_SESSION['flash_notifications'])){
			$_SESSION['flash_notifications'] = '';
		}
    }

    /**
     * @param $name
     * @param $args
     * @throws \Exception
     */
    public function __call($name, $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            if ($this->before() !== false) {
                call_user_func_array([$this, $method], $args);
                $this->after();
            }
        } else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    /**
     * filter incoming data
     */
    protected function before()
    {
		//sanitize data
		$_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
		$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$_SERVER  = filter_input_array(INPUT_SERVER, FILTER_SANITIZE_STRING);
		$_ENV  = filter_input_array(INPUT_ENV, FILTER_SANITIZE_STRING);
		$_COOKIE  = filter_input_array(INPUT_COOKIE, FILTER_SANITIZE_STRING);	

		foreach($_SESSION as $name => $value){
			$_SESSION[$name] = filter_var($_SESSION[$name]);
		}
		
    }

    protected function after()
    {		

    }

    /**
     * If you're not logged in, you get redirected to the frontpage
     * this method is called on all pages where login is mandatory
     */
	public function requireLogin()
    {
		if(!isset($_SESSION['user_id'])){
			Auth::logout();
            header("Location: /");
            exit;
		}
    }

    /**
     * If you're not logged in, you get redirected to the frontpage
     * this method is called on all pages where login is mandatory
     */
    public function requireLoginLink()
    {
        if(!isset($_SESSION['order_id'])){
            Auth::logout();
            header("Location: /order/1/1/");
            exit;
        }
    }

}
