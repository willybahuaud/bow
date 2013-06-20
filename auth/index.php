<?php
define('CONF_FILE', dirname(dirname(__FILE__)).'/lib/'.'opauth.conf.php');
define('OPAUTH_LIB_DIR', dirname(dirname(__FILE__)).'/lib/Opauth/');

require CONF_FILE;
require OPAUTH_LIB_DIR.'Opauth.php';
$Opauth = new Opauth( $config );