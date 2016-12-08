<?php

class registration extends controller{
    public function index($name = ''){
        $user = $this->model('user');
        $user->name = $name;
        
        $this->view('/regis/index', ['name' => $user->name]);
    }
}

