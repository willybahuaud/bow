<?php
class controller {
    var $vars = array();

    function set($d) {
        $this->vars = array_merge( $this->vars, $d );
    }

    function render( $filename ) {
        extract( $this->vars );
        require( '../templates/' . $filename .'.php');
    }
}