<?php
/**
* Adding redirects with regular expressions
* Examples:
* $redirect->add('page1', 'page2/'); //redirects domain/page1 to domain.com/page2/
* $redirect->add('page1[/]*', 'page2/'); //redirects (domain/page1 or domain/page1/) to domain.com/page2/
* $redirect->add('{name:[a-z]+}/harry/', 'namepages/{name}/harry/'); 
* //redirects domain/(a lowercase string with capturegroup name)/harry/ to domain/namepages/(capturegroup name)/harry/
*/

#### add / ad the end of each path ####

$router->addRedirect('{path:[a-zA-Z0-9-]+}(?!/)', '{path}/');
$router->addRedirect('{path:[a-zA-Z0-9-]+}/{path2:[a-zA-Z0-9-]+}(?!/)', '{path}/{path2}/');
$router->addRedirect('{path:[a-zA-Z0-9-]+}/{path2:[a-zA-Z0-9-]+}/{path3:[a-zA-Z0-9-]+}(?!/)', '{path}/{path2}/{path3}/');


