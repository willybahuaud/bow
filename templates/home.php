<?php
include("../class/users.class.php");
$log = new logmein();

//try to log if form not empty
if(isset($_POST['username']))
    $log->login('users', $_POST['username'], $_POST['passwd']);

if( ! $log->is_user_connected() ) {
    
    // show login form
    $log->loginform('truc','trux','');
}else{
    $infos = $log->get_user_infos();
    echo sprintf( 'Welcome her %s', $infos['useremail']);
}