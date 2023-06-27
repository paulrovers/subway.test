<?php

namespace App\Controllers;

use App\Models\pages;

class Webpages extends \Core\Controller
{
    public $strTitle = '';
    public $strDescription = '';
	public $strPageurl = '';

    public function indexAction()
    {

        if(!isset($this->route_params['name'])){
            $this->route_params['name'] = '';
        }

        $pagesobj = new pages();
        $pages_data = $pagesobj->GetPageByUrl($this->route_params['name']);

        if($pages_data === false){
            $this->tpl->display('error404.tpl');
            exit;
        }

		$this->strPageurl = $_ENV['APP_URL'].$pages_data['url'].'/';
			
		$this->strTitle = $pages_data['meta_title'];
		$this->strDescription = $pages_data['meta_description'];
		$meta_desc=$pages_data['meta_description'];

		$this->tpl->assign('meta_desc',$meta_desc);

		$this->tpl->assign('pages_data',$pages_data);
		$this->tpl->display('pages.tpl');

     }

}
