<?php

class home extends controller{
    public function index($para){
        $user = $this->model('user');
        $user->name = $para[0];
        $user->lastName = $para[1];
        
        echo $para;
        
        $this->view('/home/index', ['name' => $user->name]);
        
    }
}

