<?php

namespace App\Config\Smarty;

class SmartyTemplate extends \Smarty {

    function __construct(){
         parent::__construct();
        $smarty_path = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'smarty' . DIRECTORY_SEPARATOR . 'smarty' . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR;
        $smarty_template_path = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR;
         $this->setTemplateDir($smarty_template_path);
         $this->setCompileDir($smarty_path . 'templates_c');
         $this->setCacheDir($smarty_path . 'cache');
         $this->setConfigDir($smarty_path . 'configs');

    }

}
