<?php
require_once('class/altorouter.class.php');
require_once('class/users.class.php');
require_once('class/flux.class.php');
require_once('controller/controller.php');
$router = new AltoRouter();
$router->setBasePath('/bow');

$router->map( 'GET|POST', '/', 'home#index', 'home');
$router->map( 'POST', '/welcome/', 'user#create', 'user_create' );
$router->map( 'POST', '/goodbye/', 'user#delete', 'user_delete' );
$router->map( 'GET|POST', '/flux/subscribe/', 'flux#add', 'flux_add' );
$router->map( 'GET|POST', '/flux/import/', 'flux#import', 'flux_import' );
$match = $router->match();


$target     = explode( '#', $match[ 'target' ] );
$controller = $target[0];
$action     = $target[1];
$params     = $match[ 'params' ];

require_once('controller/' . $controller. '.php');
$controller = new $controller();
$controller->$action( $params );
// if( 'home' == $match['name'] )
//     require('templates/home.php');

// if( 'flux_add' == $match['name'] )
//     require('templates/add_flux.php');

// if( 'user_create' == $match['name'] )
//     require('templates/new_user.php');

// if( 'user_delete' == $match['name'] )
//     require('templates/delete_account.php');

// if( 'flux_import' == $match['name'] )
//     require('templates/import_flux.php');

?>

<pre>
    Target: <?php var_dump($match['target']); ?>
    Params: <?php var_dump($match['params']); ?>
    Name:   <?php var_dump($match['name']); ?>
</pre>