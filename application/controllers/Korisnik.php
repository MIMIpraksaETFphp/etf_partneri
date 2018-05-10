<?php

class Korisnik extends CI_Controller {
public function __construct() {
    parent::__construct();
    $this->load->model("ModelKorisnik");
    
    $this->load->library('session');
    if(($this->session->userdata('korisnik'))==NULL)
        redirect ("Gost");
}

public function index() {
    echo "radi";
}
}
