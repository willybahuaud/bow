<?php
$log = new logmein();

// message de confirmation d'inscription de l'utilisateur
if( isset( $_POST['useremail'], $_POST['passwd'] ) ) {
    $email = $_POST['useremail'];
    $passwd = $_POST['passwd'];

    $state = $log->createuser($email, $passwd);

    if( $state == 'success' ) {
        echo 'insertion reussie';
        $log->login($email, $passwd);
    }
    if( $state == 'exist' )
        echo 'l\'utiliseur existe déjà';
}