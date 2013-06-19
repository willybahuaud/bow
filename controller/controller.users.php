<?php

// on met les fichiers require dans index
class users extends controller{

    function indexAction(){
        // en gros la on fait notre tambouille, on choppe des variables
        $truc = array('pouet'=>'pouet');
        //on les set pour les rendre dans la vue
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

    function subscribe(){
        $this->render('subscribe');
    }

}

?>