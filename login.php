<?php

include("class/users.class.php");
$log = new logmein();

$log->loginform('truc','trux','');
if(isset($_POST['username'])){
    $log->login('users', $_POST['username'], $_POST['passwd']);
}