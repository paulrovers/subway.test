<?php
namespace App\Controllers;

class error404 extends \Core\Controller{

    public $strTitle = '404 error';
    public $strDescription = 'pagina niet gevonden';

    public function indexAction()
    {
        header('HTTP/1.1 404 Not Found');
        $meta_title='404 error';
        $meta_desc='page not found';
        $this->tpl->assign('meta_title',$meta_title);
        $this->tpl->assign('meta_desc',$meta_desc);
        $this->tpl->assign('a','b');
        $this->tpl->display('error404.tpl');
        return;
    }

} 