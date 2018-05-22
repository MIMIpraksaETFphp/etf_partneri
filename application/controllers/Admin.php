<?php

require_once APPPATH . 'controllers\Korisnik.php';

class Admin extends Korisnik {

    public function __construct() {
        parent::__construct();
    }

    public function loadView($page, $data = []) {
        $this->load->view("sabloni/header_admin.php");
        $this->load->view($page, $data);
        $this->load->view("sabloni/footer.php");
    }

    public function index() {
        $this->loadView("admin.php");
    }

    public function korisnici() {
        $this->loadView("korisnici.php");
    }

    public function adminPaketi() {
        $paketi = $this->ModelGost->spisakPaketa();
        $paketiStavke = $this->ModelGost->ispisPaketa();
        $data['paketi'] = $paketi;
        $data['paketiStavke'] = $paketiStavke;
        $this->loadView("adminPaketi.php", $data);
    }
    
    public function dodajPaket(){
        $this->loadView("dodajPaket.php");
    }
    
    Public function dodavanjePaketa(){
        // TO DO
    }

    public function predavanja() {
        $predavanja = $this->ModelGost->ispisPredavanja();
        $data['kontroler'] = 'admin';
        $data['predavanja'] = $predavanja;
        $this->loadView("predavanja.php", $data);
    }

}
