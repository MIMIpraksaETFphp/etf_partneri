<?php

class ITmenadzer extends Korisnik{

    public function __construct() {
        parent::__construct();    
    }
    
    public function dashboard() {
        echo "Dashboard";
    }
}