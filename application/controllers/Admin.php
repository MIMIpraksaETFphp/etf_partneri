<?php
require_once APPPATH . 'controllers\Korisnik.php';

class Admin extends Korisnik{
    public $i;
    public function __construct() {
        parent::__construct();
       
    }
    
    public function loadView($page, $data = []) {
        $this->load->view("sabloni/header_admin.php");
        $this->load->view($page, $data);
        $this->load->view("sabloni/footer.php");
        
    }
    
    public function korisnici() {
        $this->loadView("partneriClanovi.php");
    }
}