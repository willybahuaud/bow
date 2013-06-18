<?php
// require_once("class/users.class.php");
// $log = new logmein();

//try to log if form not empty
// if(isset($_POST['action']) && $_POST['action']== 'login')
//     $log->login( $_POST['username'], $_POST['passwd']);

// if( ! $log->is_user_connected() ) {
    
    // show login form
    // $log->loginform('truc','register-form','');

//     require('templates/home.php');
// }else{
    // $infos = $log->get_user_infos();
    // echo sprintf( 'Welcome her %s', $infos['useremail']);

    // var_dump($log->is_user_connected(),$_SESSION,$_COOKIE);
    require('templates/home.php');
// }
?>