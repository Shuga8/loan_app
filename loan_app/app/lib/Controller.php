<?php

//load model and view
class Controller {
    public function model($model) {
        //require model file
        require_once '../app/models/' . $model . '.php';

        //instantiate model
        return new $model();
    }

    //load views and check for the view files
    public function view($view, $data = []){
        if(file_exists('../app/view/' . $view . '.php')){
            require_once '../app/view/' . $view . '.php';
        }else{
            die('view does not exists');
        }
    }
}