<?php
include("class/users.class.php");
$log = new logmein();     //Instentiate the class
$log->dbconnect();        //Connect to the database
$log->encrypt = true;  

$log->loginform("loginformname", "loginformid", "");