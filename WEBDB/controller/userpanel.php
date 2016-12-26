<?php
    require_once 'nav.php';
    class userpanel extends controller{
        private $nav;
        public function __construct() {
            session_start();
            $this->nav = new nav();
        }
    //<editor-fold defaultstate="visibile" desc="Navigation">
        public function index(){
            $this->nav->questions();
        }
// </editor-fold>
    }
