<?php

namespace App\Controllers\Admin;

class Sandwichoptions extends \Core\Admin
{
    public function indexAction()
    {
		$this->tpl->display('Admin/sandwichoptions.tpl');
    }
	
}
