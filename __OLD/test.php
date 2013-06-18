<?php
include("class/users.class.php");
$log = new logmein();

if( ! isset( $_SESSION['loggedin'] ) || $log->logincheck($_SESSION['loggedin'], "users", "passwd", "useremail") == false){
    die ('U R no connected U no ?');
}