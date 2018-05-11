<?php

class Korisnik extends CI_Controller {
public function __construct() {
    parent::__construct();
    $this->load->model("ModelKorisnik");
    
   
}

public function index() {
    $this->load->view("partneriClanovi.php");
}

public function logout() {
    $this->session->unset_userdata('korisnik');
    $this->session->sess_destroy();
    redirect("Gost");
}
}
