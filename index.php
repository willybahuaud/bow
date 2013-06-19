<?php
require_once('class/altorouter.class.php');
require_once('class/users.class.php');
require_once('class/flux.class.php');
require_once('controller/controller.php');
$log = new logmein();

$router = new AltoRouter();
$router->setBasePath('/bow');

$router->map( 'GET|POST', '/', ( ( $log->is_user_connected() ) ? 'flux#read' : 'user#subscribe' ), 'home');
$router->map( 'POST', '/welcome/', 'user#create', 'user_create' );
$router->map( 'POST', '/goodbye/', 'user#delete', 'user_delete' );
$router->map( 'GET|POST', '/flux/subscribe/', 'flux#add', 'flux_add' );
$router->map( 'GET|POST', '/flux/import/', 'flux#import', 'flux_import' );
$match = $router->match();


$target     = explode( '#', $match[ 'target' ] );
$controller = $target[0];
$action     = $target[1];
$params     = $match[ 'params' ];

require_once('controller/controller.' . $controller. '.php');
$controller = new $controller();
$controller->$action( $params );

?>

<pre>
    Target: <?php var_dump($match['target']); ?>
    Params: <?php var_dump($match['params']); ?>
    Name:   <?php var_dump($match['name']); ?>
</pre>