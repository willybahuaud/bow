<?php
include("class/users.class.php");
$log = new logmein();

// message de confirmation d'inscription de l'utilisateur
if( isset( $_POST['useremail'], $_POST['passwd'] ) ) {
    $email = $_POST['useremail'];
    $passwd = $_POST['passwd'];

    $state = $log->createuser($email, $passwd);

    var_dump($state);
    if( $state == 'success' )
        echo 'insertion reussie';
    if( $state == 'exist' )
        echo 'l\'utiliseur existe déjà';
}