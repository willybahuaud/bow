<?php
require('templates/header.php');
include_once("class/import.class.php");
$import = new import();

$import->upload_xml_file();