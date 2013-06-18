<?php
require_once('class/altorouter.class.php');
require_once('class/users.class.php');
require_once('class/flux.class.php');
$router = new AltoRouter();
$router->setBasePath('/bow');

$router->map( 'GET|POST', '/', 'home#index', 'home');
$router->map( 'POST', '/welcome/', 'user#create', 'user_create' );
$router->map( 'POST', '/goodbye/', 'user#delete', 'user_delete' );
$router->map( 'GET|POST', '/flux/subscribe/', 'flux#add', 'flux_add' );
$match = $router->match();

if( 'home' == $match['name'] )
    require('templates/home.php');

if( 'flux_add' == $match['name'] )
    require('templates/add_flux.php');

if( 'user_create' == $match['name'] )
    require('templates/new_user.php');

if( 'user_delete' == $match['name'] )
    require('templates/delete_account.php');

?>

<pre>
    Target: <?php var_dump($match['target']); ?>
    Params: <?php var_dump($match['params']); ?>
    Name:   <?php var_dump($match['name']); ?>
</pre>