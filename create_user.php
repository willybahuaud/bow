<?php
include("class/users.class.php");
$log = new logmein();     //Instentiate the class

$log->registerform("loginformname", "loginformid", "validate_user.php");
