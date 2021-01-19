<?php


namespace Core;


class LinkLogin extends Controller
{

    public $strTitle = 'Order sandwiches';
    public $strDescription = 'Order sandwiches';
    public $strPageurl = 'order';

    protected function before()
    {
        $this->requireLoginLink();
    }

}