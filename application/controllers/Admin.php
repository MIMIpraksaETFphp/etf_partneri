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

    public function dodajPaket($message = NULL) {
        $stavkeUbazi = $this->ModelKorisnik->stavkeuBazi();
        $data['message'] = $message;
        $data['stavkeUbazi'] = $stavkeUbazi;
        $this->loadView("dodajPaket.php", $data);
    }

    public function dodavanjePaketa() {
        $naziv = $this->input->post('naziv');
        $vrednost = $this->input->post('vrednost');
        $trajanje = $this->input->post('trajanje');
        $maxbroj = $this->input->post('maxbroj');
        $stavkeUbazi = array($this->input->post('stavkeUbazi'));
        $idstavke = array($this->input->post('idstavke'));
        $stavka = array();
        $id = array();
//        foreach ($stavkeUbazi as $stavkeB){
//            foreach ($stavke as $st){
//                if($st == 1){
//                    
//                }
//            }
//        }
        for ($i = 0; $i < count($stavkeUbazi[0]); $i++) {
            for($j = 0; $j<count($stavkeUbazi); $j++) {
                if ($stavkeUbazi[$i][$j] == 1) {
                    $stavka[] = $stavkeUbazi[$i][$j];
                    $id[] = $idstavke[$i][$j];
                }
            }
        }
//        $this->ModelKorisnik->dodavanjePaketa($naziv, $vrednost, $trajanje, $maxbroj);
//        $this->ModelKorisnik->dodajStavke($stavka);
        $data['naziv'] = $naziv;
        $data['vrednost'] = $vrednost;
        $data['trajanje'] = $trajanje;
        $data['maxbroj'] = $maxbroj;
        $data['stavka'] = $stavka;
        $data['id'] = $id;
        $this->loadView("moze.php", $data);
    }

    public function dodavanjeStavke() {
        $novaStavka = $this->input->post('novaStavka');
        if (!empty($novaStavka) || $novaStavka != NULL) {
            $this->ModelKorisnik->dodajStavku($novaStavka);
            $this->dodajPaket();
        } else {
            $message = "Polje stavke ne moze biti prazno";
            $this->dodajPaket($message);
        }
    }

    public function predavanja() {
        $predavanja = $this->ModelGost->ispisPredavanja();
        $data['kontroler'] = 'admin';
        $data['predavanja'] = $predavanja;
        $this->loadView("predavanja.php", $data);
    }

}
