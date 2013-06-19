<?php
class controller {
    var $vars = array();

    function set($d) {
        $this->vars = array_merge( $this->vars, $d );
    }

    function render( $filename ) {
        require( 'templates/header.php' );
        extract( $this->vars );
        require( 'templates/' .get_class ($this) .'/'. $filename .'.php');
    }
}