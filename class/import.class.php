<?php
class import {
    function __construct(){
        require_once( realpath( dirname( dirname( __FILE__ ) ) ) . '/connect.php' );
        $sql = new sql();
        $this->dbh = new PDO( "mysql:host={$sql->hostname};dbname={$sql->database}", $sql->username, $sql->password );
    }

    function get_from_google( $xml ){
        //
    }
}