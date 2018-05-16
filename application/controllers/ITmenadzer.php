<?php

require_once APPPATH . 'controllers\Korisnik.php';

class ITmenadzer extends Korisnik{
    public function __construct() {
        parent::__construct();
       
    }
    
    public function loadView($page, $data = []) {
        $this->load->view("sabloni/header_ITmenadzer.php");
        $this->load->view($page, $data);
        $this->load->view("sabloni/footer.php");
        
    }
    
    public function korisnici() {
        $this->loadView("partneriClanovi.php");
    }
}
