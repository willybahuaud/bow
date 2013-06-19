<?php

// ici on met les fichiers require
class users extends controller{

    function indexAction(){

        $truc = array('pouet'=>'pouet');
        $this->set($truc);
        $this->render('index');
    }

    function createAction(){

        $this->render('create');
    }


    function readAction(){

        $this->render('read');
    }


    function deleteAction(){

        $this->render('delete');
    }

}

?>