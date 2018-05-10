<?php

class Admin extends Korisnik{

    public function __construct() {
        parent::__construct();
    }
    
    public function korisnici() {
        echo "korisnici";
    }
}