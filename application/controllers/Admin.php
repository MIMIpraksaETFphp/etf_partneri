<?php

require_once APPPATH . 'controllers\ITmenadzer.php';

class Admin extends ITmenadzer {

    public $kontroler = 'Admin';

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
        $data['kontroler'] = $this->kontroler;
        $this->loadView("registracija.php", $data);
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
        if ($message != NULL) {
            $data['message'] = $message;
        }
        $data['stavkeUbazi'] = $stavkeUbazi;
        $this->loadView("dodajPaket.php", $data);
    }

    public function dodavanjePaketa() {
        $naziv = $this->input->post('naziv');
        $vrednost = $this->input->post('vrednost');
        $trajanje = $this->input->post('trajanje');
        $maxbroj = $this->input->post('maxbroj');
        $stavke = array($this->input->post('stavkeUbazi'));
        $insertId = $this->ModelKorisnik->dodavanjePaketa($naziv, $vrednost, $trajanje, $maxbroj);
        foreach ($stavke as $stavka) {
            foreach ($stavka as $idStavke) {
                $this->ModelKorisnik->dodajStavkePaketu($insertId, $idStavke);
            }
        }
          redirect("Admin/dodajPaket");
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

    public function oglasi() {
        $data['kontroler'] = 'admin';
        $data['oglasi'] = $this->ModelGost->pretragaOglasa();
        $this->loadView("oglasi.php", $data);
    }

    public function registruj_se() {

        $this->form_validation->set_rules("username", "username", "required");
        $this->form_validation->set_rules("password", "password", "required");
        //  $this->form_validation->set_rules("password", "password", "required");     //ponovljeni pass...ne traba jer ga admin dodaje licno
        $this->form_validation->set_rules("ime", "ime", "required");
        $this->form_validation->set_rules("prezime", "prezime", "required");
        $this->form_validation->set_rules("datum_rodjenja", "datum_rodjenja", "required");
        $this->form_validation->set_rules("telefon", "telefon", "required");
        $this->form_validation->set_rules("email", "email", "required|valid_email");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
        if ($this->form_validation->run() == FALSE) {
            $this->korisnici();
        } else {
            $korisnik = array(
                'username' => $this->input->post('username', 'field is NOT NULL'),
                'password' => md5($this->input->post('password')),
                'ime' => $this->input->post('ime'),
                'prezime' => $this->input->post('prezime'),
                'datum_rodjenja' => $this->input->post('datum_rodjenja'),
                'telefon' => $this->input->post('telefon'),
                'email' => $this->input->post('email'),
                'status_korisnika_idtable1' => $this->input->post('status_korisnika_idtable1')
            );

            $this->ModelKorisnik->registrovanKorisnik($korisnik);
            redirect("$this->kontroler/korisnici");
        }
    }

    public function promenaStatusa() {

        $status= $this->ModelKorisnik->iscitajKorisnikUsername();
        $status2= $this->ModelKorisnik->iscitajStatusTabelu();
        $trenutniStat=$this->ModelKorisnik->iscitajTrenutniStatus();
        $data['status']=$status;
        $data['status2']=$status2;
        $data['trenutniStat']=$trenutniStat;
        $this->loadView("promenaStatusaKorisnika.php", $data);
    }

    public function dodavanjeStatusaClanu() {
        $KorisnikStatus = array(
            'idKorisnik' => $this->input->post('idKorisnik'),
            'status_korisnika_idtable1' => $this->input->post('statusKorisnika'),
        );
        $this->ModelKorisnik->promenaStatusa($KorisnikStatus);
        redirect("$this->kontroler/korisnici");
    }
    
    public function brisanjePaketa($idPaket){
        $this->ModelKorisnik->brisanjePaketa($idPaket);
    }

}
