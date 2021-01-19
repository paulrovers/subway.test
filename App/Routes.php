<?php
#examples
//$router->add('zwangerschapscalculator/' , ['controller' => 'zwangerschapscalculator' , 'action' => 'index']);
//$router->add('{category:[a-z0-9-]+}/{name:[a-z0-9-]+}/' , ['controller' => 'Pages' , 'action' => 'index']);

#login pages
$router->add('inloggen/pagesettings/{page:[0-9]+}/' , ['controller' => 'Admin\Pagesettings' , 'action' => 'index']);
$router->add('inloggen/pages/{page:[0-9]+}/' , ['controller' => 'Admin\Page' , 'action' => 'edit']);
$router->add('inloggen/pages/delete/{site:[0-9]+}/{page:[0-9]+}/' , ['controller' => 'Admin\Page' , 'action' => 'delete']);

$router->add('inloggen/home/', ['controller' => 'Admin\Home', 'action' => 'index']);
$router->add('inloggen/home/new/', ['controller' => 'Admin\Home', 'action' => 'new']);
$router->add('inloggen/home/close/{id:[0-9]+}/', ['controller' => 'Admin\Home', 'action' => 'close']);
$router->add('inloggen/admin/', ['controller' => 'Admin\Admin', 'action' => 'index']);
$router->add('inloggen/account/', ['controller' => 'Admin\Account', 'action' => 'index']);
$router->add('inloggen/clients/', ['controller' => 'Admin\Clients', 'action' => 'index']);
$router->add('inloggen/clients/delete/{id:[0-9]+}/', ['controller' => 'Admin\Clients', 'action' => 'delete']);
$router->add('inloggen/password/', ['controller' => 'Admin\Password', 'action' => 'index']);
$router->add('inloggen/orderdetails/{id:[0-9]+}/delete/{delid:[0-9]+}/', ['controller' => 'Admin\Orderdetails', 'action' => 'delete']);
$router->add('inloggen/orderdetails/{id:[0-9]+}/', ['controller' => 'Admin\Orderdetails', 'action' => 'index']);
$router->add('inloggen/sandwichoptions/', ['controller' => 'Admin\Sandwichoptions', 'action' => 'index']);
$router->add('inloggen/', ['controller' => 'Login', 'action' => 'index']);
$router->add('inloggen/logout/', ['controller' => 'Home', 'action' => 'logout']);

#homepage
$router->add('', ['controller' => 'Webpages', 'action' => 'index']);

#orderpage
$router->add('order/{orderid:[0-9]+}/new/', ['controller' => 'LinkLogin\ClientOrder', 'action' => 'new']);
$router->add('order/{orderid:[0-9]+}/', ['controller' => 'LinkLogin\ClientOrder', 'action' => 'index']);
$router->add('order/{orderid:[0-9]+}/edit/{sandwichid:[0-9]+}/', ['controller' => 'LinkLogin\ClientOrder', 'action' => 'edit']);
$router->add('order/{orderkey:[a-zA-Z0-9]+}/{clientkey:[a-zA-Z0-9]+}/', ['controller' => 'CheckOrderLink', 'action' => 'index']);

#route all pages to pages controller
$router->add('{name:[a-z0-9-]+}/' , ['controller' => 'Webpages' , 'action' => 'index']);

#none standard path route to error page
$router->add('{name:[a-zA-Z0-9-]+}[a-zA-Z0-9/_-]+' , ['controller' => 'Webpages' , 'action' => 'index']);
//so all paths that do not exist go to the error page

