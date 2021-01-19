<?php

namespace Core;

class Admin extends Controller{
	
	public $strTitle = 'Control Panel';
    public $strDescription = 'Control panel';
	public $strPageurl = 'admin';
	
	protected function before()
    {
		$this->requireLogin();
    }

}