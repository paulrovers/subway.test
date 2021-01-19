<?php

namespace App;

// Admin email address
define('SYS_ADMIN', 'john@doe.nl');
// Project url
define('SYS_SITE_NAME', 'subway.test');
define('PREFIX', 'http://');
// Project URI (with trailing slash)
define('SYS_SITE_URI', PREFIX.SYS_SITE_NAME.'/');
//Login part url
define('LOGINURL', 'inloggen');
// Set 1 fo minify code , Set 0 for unminify code
define('SYS_MINIFY', '0');

class Config
{
    const DB_HOST = 'localhost';
    const DB_NAME = 'subway';
    const DB_USER = 'root';
    const DB_PASSWORD = '';
    const SHOW_ERRORS = true;
    const MAIL_ERRORS = false;
    const MAIL_HOST = 'mail.jenda.nl';
    const MAIL_USER = 'paul@sitetesten.nl';
    const MAIL_PASSWORD = 'paul345';
    const SENDADDRESS = 'paul@sitetesten.nl';
    const SENDNAME = 'Paul Rovers';
}

?>