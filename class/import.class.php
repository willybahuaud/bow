<?php
class import {
    function __construct(){
        require_once( realpath( dirname( dirname( __FILE__ ) ) ) . '/connect.php' );
        $sql = new sql();
        $this->dbh = new PDO( "mysql:host={$sql->hostname};dbname={$sql->database}", $sql->username, $sql->password );
    }

    function get_from_google( $xml ){
        // $xml = file_get_contents( $xml[ 'tmp_name' ] );
        die(var_dump($xml));
    }
    function upload_xml_file() {
        if(isset($_FILES['xml']))
            $this->get_from_google($_FILES);
        echo '<form id="import" enctype="multipart/form-data" method="POST">';
        echo '<input type="file" name="xml" id="xml"><br>';
        echo '<input type="radio" name="provider" value="googlereader" id="pgooglereader"> <label for="pgooglereader">Google Reader</label><br>';
        echo '<input type="submit" value="Importer" name="submitimport">';
        echo '</form>';
    }
}