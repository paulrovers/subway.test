<?php

namespace Core;

use Smarty;

abstract class Controller
{

    protected $route_params = [];
    public Smarty $tpl;

    public function __construct($route_params)
    {
        $this->route_params = $route_params;
        $this->tpl = new Smarty;
        $this->tpl->setTemplateDir('../App/Views');
        $this->tpl->setCompileDir('../App/Views/Compile');
        $this->tpl->setCacheDir('../App/Views/Cache');
        $this->tpl->caching = 0;
        $this->tpl->cache_lifetime = 300;
    }

    public function LoadTemplate(string $strBufferedContent,Controller $controllerobject):void
    {
        $this->tpl->assign('site_url', $_ENV['APP_URL']);
        $this->tpl->assign('admin_url', $_ENV['APP_URL'].'inloggen/');
        $this->tpl->assign('buffered_content', $strBufferedContent);
        $this->tpl->assign('title',$controllerobject->strTitle);
        $this->tpl->assign('description',$controllerobject->strDescription);
        $this->tpl->assign('pageurl',$controllerobject->strPageurl);

        if(isset($_SESSION)){
            if(isset($_SESSION['flash_notifications'])){
                $flash_notifications = $_SESSION['flash_notifications'];
            }else{
                $flash_notifications = '';
            }
            $this->tpl->assign('flash_notifications', $flash_notifications);
        }

        if(isset($_SESSION['user_id'])){
            $wrapper = "Admin/wrapper.tpl";
        }else{
            $wrapper = "wrapper.tpl";
        }

        if(isset($controllerobject->standalone) && $controllerobject->standalone == 1){
            $wrapper = "empty.tpl";
        }

        $this->tpl->display($wrapper);
        exit;
    }

    public function __destruct()
    {
		if(isset($_SESSION['flash_notifications'])){
			$_SESSION['flash_notifications'] = '';
		}
    }

    public function __call(string $name, array $args)
    {
        $method = $name . 'Action';

        if (method_exists($this, $method)) {
            call_user_func_array([$this, $method], $args);
        } else {
            throw new \Exception("Method $method not found in controller " . get_class($this));
        }
    }

    /**
     * If you're not logged in, you get redirected to the frontpage
     * this method is called on all pages where login is mandatory
     */
	public function requireLogin()
    {
		if(!isset($_SESSION['user_id'])){
			Authenticate::logout();
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
            Authenticate::logout();
            header("Location: /order/1/1/");
            exit;
        }
    }

}
