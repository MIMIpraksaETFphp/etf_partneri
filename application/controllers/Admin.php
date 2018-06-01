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
        $data['kontroler'] = $this->kontroler;
        $this->loadView("registracija.php", $data);
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

//     public function korisnici() {
//         $data['kontroler'] = $this->kontroler;
//         $data['metoda'] = 'korisnici';
//         $limit = 2;
//         $pocetni_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

//         if ($this->input->get('pronadji') == 'Pronadji') {
//             $this->session->unset_userdata('kompanija');
//             $this->session->unset_userdata('paket');
//             $this->session->unset_userdata('vazeciUgovor');
//         }
//         $kompanija = '';
//         if ($this->input->get('kompanija')) {
//             $this->session->unset_userdata('paket');
//             $kompanija = $this->input->get('kompanija');
//             $this->session->set_userdata('kompanija', $kompanija);
//         } elseif ($this->session->userdata('kompanija')) {
//             $kompanija = $this->session->userdata('kompanija');
//         }
//         $paket = '';
//         if ($this->input->get('paket')) {
//             $this->session->unset_userdata('kompanija');
//             $paket = $this->input->get('paket');
//             $this->session->set_userdata('paket', $paket);
//         } elseif ($this->session->userdata('paket')) {
//             $paket = $this->session->userdata('paket');
//         }
//         $vazeciUgovor = '';
//         if ($this->input->get('vazeciUgovor')) {
// //            $this->session->unset_userdata('kompanija');
// //            $this->session->unset_userdata('paket');
//             $vazeciUgovor = $this->input->get('vazeciUgovor');
//             $this->session->set_userdata('vazeciUgovor', $vazeciUgovor);
//         } elseif ($this->session->userdata('vazeciUgovor')) {
//             $vazeciUgovor = $this->session->userdata('vazeciUgovor');
//         }

//         $rezultat = $this->ModelKorisnik->pretragaPartnera($limit, $pocetni_index, $vazeciUgovor, $kompanija, $paket);
//         $data['rezultat'] = $rezultat;
//         $ukupanBrPartnera = $this->ModelKorisnik->brojPartnera($kompanija, $paket, $vazeciUgovor);

//         $data['ukupanBroj'] = $ukupanBrPartnera;

//         $this->config->load('bootstrap_pagination');
//         $config_pagination = $this->config->item('pagination');
//         $config_pagination['base_url'] = site_url("Admin/korisnici");
//         $config_pagination['total_rows'] = $ukupanBrPartnera;
//         $config_pagination['per_page'] = $limit;
//         $config_pagination['next_link'] = 'Next';
//         $config_pagination['prev_link'] = 'Prev';

//         $this->pagination->initialize($config_pagination);
//         $data['links'] = $this->pagination->create_links();

//         $this->loadView("partneriClanovi.php", $data);
//     }

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
        $this->form_validation->set_rules("naziv", "naziv", "required");
        $this->form_validation->set_rules("vrednost", "vrednost", "required");
        $this->form_validation->set_rules("trajanje", "trajanje", "required");
        $this->form_validation->set_rules("maxbroj", "maxbroj", "required");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
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
        $this->form_validation->set_rules("username", "username", "required|callback_proveraIdenticanUsername");
        $this->form_validation->set_rules("password", "password", "required|min_length[8]|max_length[12]");
        $this->form_validation->set_rules("confirm_password", "password", "required|trim|matches[password]");                                               // | regex_match[/^(?=[a-zA-z])(?=\S*[a-z]{4,})(?=\S*[A-Z])(?=\S*[\d]{2,})(?!.*(.)\1{1})[0-9A-Za-z]{8,12}$/] Milanov regex sa svim stvarima...npr da je prvo veliko idt...ne mora tako
        $this->form_validation->set_rules("ime", "ime", "required");
        $this->form_validation->set_rules("prezime", "prezime", "required");
        $this->form_validation->set_rules("datum_rodjenja", "datum_rodjenja", "required");
        $this->form_validation->set_rules("telefon", "telefon", "required");
        $this->form_validation->set_rules("email", "email", "required|valid_email");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
        $this->form_validation->set_message("matches", "Morate uneti isti password");
        $this->form_validation->set_message("proveraIdenticanUsername", "Taj username vec postoji");
        if ($this->form_validation->run() == FALSE) {
            $this->index();
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

    public function proveraIdenticanUsername()
    {
        $username = $this->input->post('username');
        $status = $this->ModelKorisnik->proveraIdenticanUsername($username);
        return $status;
    }

    public function promenaStatusa() {
        $status = $this->ModelKorisnik->iscitajKorisnikUsername();
        $status2 = $this->ModelKorisnik->iscitajStatusTabelu();
        $trenutniStat = $this->ModelKorisnik->iscitajTrenutniStatus();
        $data['status'] = $status;
        $data['status2'] = $status2;
        $data['trenutniStat'] = $trenutniStat;
        $data['kontroler'] = $this->kontroler;
        $this->loadView("promenaStatusaKorisnika.php", $data);
    }

    public function dodavanjeStatusaClanu() {
        $KorisnikStatus = array(
            'idKorisnik' => $this->input->post('idKorisnik'),
            'status_korisnika_idtable1' => $this->input->post('statusKorisnika'),
        );
        $this->ModelKorisnik->promenaStatusa($KorisnikStatus);
        redirect("$this->kontroler/promenaStatusa");
    }

    public function brisanjePaketa($idPaket) {
        $var = $this->ModelKorisnik->paketNemaUgovor($idPaket);
        if (empty($var)) {
            $this->ModelKorisnik->brisanjePaketa($idPaket);
            $message = "Uspesno ste izbrisali paket";
        } else {
            $message = "Ne mozete brisati paket koji ima vezan ugovor!";
        }
        $this->adminPaketi($message);
    }

}
