<?php


class flux extends controller{
    // on met les fichiers dans index
    function indexAction(){

        $this->render('index');
    }

    function createAction(){

        // en gros la tu balmances ton $f->new flux();
        // et tu pousse un tableau de données a afficher à la vue
    	$this->render('create');
    }


    function readAction(){

        // en gros la tu balmances ton $f->flux();
        // en variable vers la vue
    	$this->render('read');
    }


    function deleteAction(){


        $this->render('delete');
    }

}
?>