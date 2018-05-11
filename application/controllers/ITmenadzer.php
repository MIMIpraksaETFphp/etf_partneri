<?php

class ITmenadzer extends Korisnik{

    public function __construct() {
        parent::__construct();   
        
         $this->load->library('session');
        if(($this->session->userdata('korisnik'))==NULL)
        redirect ("Gost");
    }
    
    /*public function dashboard() {
        echo "Dashboard";
    }*/
    
    public function index() {
    $this->load->view("ITmenadzer.php");
}

public function logout() {
    $this->session->unset_userdata('korisnik');
    $this->session->sess_destroy();
    redirect("Gost");
}
    
    
}