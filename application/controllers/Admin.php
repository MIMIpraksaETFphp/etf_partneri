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

    public function index($poruka=null) {
        $status = $this->ModelKorisnik->iscitajKorisnikUsername();
        $status2 = $this->ModelKorisnik->iscitajStatusTabelu();
        $trenutniStat = $this->ModelKorisnik->iscitajTrenutniStatus();
        $data['poruka'] = $poruka;
        $data['status'] = $status;
        $data['status2'] = $status2;
        $data['trenutniStat'] = $trenutniStat;
        $data['kontroler'] = $this->kontroler;
        $this->loadView("promenaStatusaKorisnika.php", $data);    

    }

    public function dashboard() {
        $data['kontroler'] = $this->kontroler;
        $partnerIsticeUgovor = $this->ModelKorisnik->iscitajPartnera();
        $iscitajPredavanje = $this->ModelKorisnik->iscitajPredavanje();
        $iscitajOglase = $this->ModelKorisnik->iscitajOglase();
        $data['iscitajOglase'] = $iscitajOglase;
        $data['iscitajPredavanje'] = $iscitajPredavanje;
        $data['partnerIsticeUgovor'] = $partnerIsticeUgovor;
        $this->loadView('ITindex.php', $data);
    }

    public function adminPaketi($message = NULL) {
        $paketi = $this->ModelGost->spisakPaketa();
        $paketiStavke = $this->ModelGost->ispisPaketa();
        $data['paketi'] = $paketi;
        $data['paketiStavke'] = $paketiStavke;
        $data['poruka'] = $message;
        $this->loadView("adminPaketi.php", $data);
    }

    public function dodajPaket() {
        $stavkeUbazi = $this->ModelKorisnik->stavkeuBazi();
        $data['stavkeUbazi'] = $stavkeUbazi;
        $this->loadView("dodajPaket.php", $data);
    }

    public function dodavanjePaketa() {
        $this->form_validation->set_rules("naziv", "Naziv Paketa", "required");
        $this->form_validation->set_rules("vrednost", "Vrednost Paketa", "required");
        $this->form_validation->set_rules("trajanje", "Trajanje ugovora", "required");
        $this->form_validation->set_rules("maxbroj", "Maksimalni broj kompanija", "required|max_length[3]");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
        $this->form_validation->set_message("max_length", "Polje {field} može imati najviše 3 karaktera");
        if ($this->form_validation->run() == FALSE) {
            $this->dodajPaket();
        } else {
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
            redirect("$this->kontroler/adminPaketi");
        }
    }

    public function dodavanjeStavke() {
        $this->form_validation->set_rules("novaStavka", "Nova stavka", "required");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
        if ($this->form_validation->run() == FALSE) {
            $this->dodajPaket();
        } else {
        $novaStavka = $this->input->post('novaStavka');
        $this->ModelKorisnik->dodajStavku($novaStavka);
        $this->dodajPaket();
        }
    }

    public function registruj_se() {
        $this->form_validation->set_rules("username", "Korisničko ime", "required|callback_proveraIdenticanUsername");
        $this->form_validation->set_rules("password", "Lozinka", "required|min_length[8]|max_length[12]");
        $this->form_validation->set_rules("confirm_password", "Potvrdi Lozinku", "required|trim|matches[password]");                                               // | regex_match[/^(?=[a-zA-z])(?=\S*[a-z]{4,})(?=\S*[A-Z])(?=\S*[\d]{2,})(?!.*(.)\1{1})[0-9A-Za-z]{8,12}$/] Mentorov regex sa svim stvarima...npr da je prvo veliko idt...ne mora tako
        $this->form_validation->set_rules("ime", "Ime", "required");
        $this->form_validation->set_rules("prezime", "Prezime", "required");
        $this->form_validation->set_rules("datum_rodjenja", "Datum rodjenja", "required");
        $this->form_validation->set_rules("telefon", "Telefon", "required");
        $this->form_validation->set_rules("email", "Email", "required|valid_email");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
        $this->form_validation->set_message("matches", "Morate uneti istu lozinku");
        $this->form_validation->set_message("proveraIdenticanUsername", "To korisničko ime već postoji");
        $this->form_validation->set_message("min_length", "Polje {field} mora imati najmanje 8 karaktera");
        $this->form_validation->set_message("max_length", "Polje {field} može imati najviše 12 karaktera");
        if ($this->form_validation->run() == FALSE) {
            $this->registracija();
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
            redirect("$this->kontroler/clanovi");
        }
    }

    public function proveraIdenticanUsername() {
        $username = $this->input->post('username');
        $status = $this->ModelKorisnik->proveraIdenticanUsername($username);
        return $status;
    }    

    public function dodavanjeStatusaClanu() {
        $KorisnikStatus = array(
            'idKorisnik' => $this->input->post('idKorisnik'),
            'status_korisnika_idtable1' => $this->input->post('statusKorisnika'),
        );
        if($KorisnikStatus['status_korisnika_idtable1'] == 1 || $KorisnikStatus['status_korisnika_idtable1'] == 5){
            $KorisnikNemaPartnere = $this->ModelKorisnik->proveraKorisnikPartner($KorisnikStatus['idKorisnik']);
            if($KorisnikNemaPartnere == false){
                $poruka = 'Ne možete banovati korisnika koji ima partnere';
                $this->index($poruka);
            } else {
                $this->ModelKorisnik->promenaStatusa($KorisnikStatus);
                redirect("$this->kontroler/index");
            }
        } else {
            $this->ModelKorisnik->promenaStatusa($KorisnikStatus);
            redirect("$this->kontroler/index");
        }
    }

    public function brisanjePaketa($idPaket) {
        $var = $this->ModelKorisnik->paketNemaUgovor($idPaket);
        if (empty($var)) {
            $this->ModelKorisnik->brisanjePaketa($idPaket);
            $message = "Uspešno ste izbrisali paket";
        } else {
            $message = "Ne možete brisati paket koji ima vezan ugovor!";
        }
        $this->adminPaketi($message);
    }

    public function registracija() {
        $data['kontroler'] = $this->kontroler;
        $this->loadView("registracija.php", $data);
    }
}
