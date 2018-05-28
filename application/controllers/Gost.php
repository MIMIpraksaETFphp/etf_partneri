<?php

// Korisnik je clan 
class Gost extends CI_Controller {
    
    public $kontroler='Gost';
    
    public function __construct() {
        parent::__construct();
        $this->load->model("ModelGost");
        $this->load->model("ModelKorisnik");
        
        if (($this->session->userdata('korisnik')) != NULL) {
            if ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 2)
                redirect("Korisnik/index");    
            elseif($this->session->userdata('korisnik')->status_korisnika_idtable1 == 3)
                redirect("ITmenadzer/index");
            elseif($this->session->userdata('korisnik')->status_korisnika_idtable1 == 4)
                redirect("Admin/index");

        }  
    }

    public function loadView($page, $data = []) {
        $this->load->view("sabloni/header_gost.php");
        $this->load->view($page, $data);
        $this->load->view("sabloni/footer.php");
    }

    public function index() {

//        if (($this->session->userdata('korisnik')) != NULL) {
//            if ($korisnik->status_korisnika_idtable1 == 2)
//                redirect("Korisnik/index");
//            elseif ($korisnik->status_korisnika_idtable1 == 3)
//                redirect("ITmenadzer/index");
//            elseif ($korisnik->status_korisnika_idtable1 == 4)
//                redirect("Admin/index");
//            //else
//            //$this->loadView("partneri.php");  
//        } else {
            $kompanija = $this->input->post("kompanija");

            $partneri = $this->ModelGost->pretraga($kompanija);
//            $data['partneri'] = $partneri;

            $paketi = $this->ModelGost->spisakPaketa();
            $data['paketi'] = $paketi;

            foreach ($paketi as $paket){
                $naziv_paketa=$paket['naziv_paketa'];
                $data['partneri'][$naziv_paketa]=$this->filtrirajPartnere($paket,$partneri);
            }
            $data['kontroler']='gost';
            $data['metoda']='index';
            $this->loadView("partneri.php", $data);
//        }
    }

    public function login($poruka = NULL) {
        $podaci = array();
        if ($poruka)
            $podaci['poruka'] = $poruka;
        $this->loadView("login.php", $podaci);
    }

    public function ulogujse() {
        $this->form_validation->set_rules("username", "Username", "required");
        $this->form_validation->set_rules("password", "Password", "required");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
        if ($this->form_validation->run()) {
            //$this->ModelKorisnik->proveraUsername($this->input->post('username'));
            if (!$this->ModelKorisnik->proveraUsername($this->input->post('username')))
                $this->login("Neispravan username");
            elseif (!$this->ModelKorisnik->proveraPassword($this->input->post('password')))
                //elseif (!$this->ModelKorisnik->proveraPassword(md5($this->input->post('password'))))  OVAKO TREBA!!!!!!!!!
                $this->login("Neispravan password");
            else {
                $korisnik = $this->ModelKorisnik->korisnik;
                $this->load->library('session');
                $this->session->set_userdata('korisnik', $korisnik);
                if ($korisnik->status_korisnika_idtable1 == 2)
                    redirect("Korisnik/index");

                elseif ($korisnik->status_korisnika_idtable1 == 3)
                    redirect("ITmenadzer/index");
                elseif ($korisnik->status_korisnika_idtable1 == 4)
                    redirect("Admin/index");
                else
                    redirect("korisnik/logout");
            }
        } else
            $this->login();
    }

    public function registracija() {
        $data['kontroler'] = $this->kontroler;
        $this->loadView("registracija.php", $data);
    }

    private function filtrirajPartnere($paket,$partneri){
        $filter = array($paket['naziv_paketa']);
        $filtriraniPartneri = array_filter($partneri, function ($s) use ($filter) {
            return in_array($s['naziv_paketa'], $filter);
        });
        return $filtriraniPartneri;
    }
    
    public function registruj_se() {

        $this->form_validation->set_rules("username", "username", "required");
        $this->form_validation->set_rules("password", "password", "required|min_length[8]|max_length[12]|trim|matches[confirm_password]");  // | regex_match[/^[A-Z]{1,}a-z{5,}0-9{2,}$/] za mala i velika-ne radi...treba nesto drugacije moj regex
        $this->form_validation->set_rules("confirm_password", "password", "required|trim");                                               // | regex_match[/^(?=[a-zA-z])(?=\S*[a-z]{4,})(?=\S*[A-Z])(?=\S*[\d]{2,})(?!.*(.)\1{1})[0-9A-Za-z]{8,12}$/] Milanov regex sa svim stvarima...npr da je prvo veliko idt...ne mora tako
        $this->form_validation->set_rules("ime", "ime", "required");
        $this->form_validation->set_rules("prezime", "prezime", "required");
        $this->form_validation->set_rules("datum_rodjenja", "datum_rodjenja", "required");
        $this->form_validation->set_rules("telefon", "telefon", "required|min_length[9]");
        $this->form_validation->set_rules("email", "email", "required|valid_email");   
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
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
            );
            $this->ModelKorisnik->registrovanKorisnik($korisnik);
            redirect("$this->kontroler/index");
        }
    }

    public function paketi() {
        $paketi = $this->ModelGost->spisakPaketa();
        $paketiStavke = $this->ModelGost->ispisPaketa();
        $data['paketi'] = $paketi;
        $data['paketiStavke'] = $paketiStavke;
        $this->loadView("paketi.php", $data);
    }

    public function oglasi() {
        $data['kontroler']='gost';
        $data['oglasi']= $this->ModelGost->pretragaOglasa();
        $this->loadView("oglasi.php", $data);
    }

    public function predavanja() {
        $data['kontroler']='gost';
        $predavanja = $this->ModelGost->ispisPredavanja();
        $data['predavanja']=$predavanja;
        $this->loadView("predavanja.php", $data);
    }
    
    public function arhiva() {
        $predavanja = $this->ModelGost->ispisPredavanjaArhiva();
        $data['predavanja']=$predavanja;
        $this->loadView("arhivaPredavanja.php", $data);
    }
    
    public function oglasDetaljnije($idOglas){
        $oglas=$this->ModelGost->iscitajOglas($idOglas);
        $fajl=$this->ModelGost->iscitajOglasFajl($idOglas);
        $data['oglas'] = $oglas;
        $data['fajl'] = $fajl;
        $this->loadView("oglasDetaljnije.php", $data);
    }
    
    public function predavanjeDetaljnije($idpredavanje){
        $predavanje=$this->ModelGost->iscitajPredavanje($idpredavanje);
        $data['predavanje'] = $predavanje;
        $this->loadView("predavanjeDetaljnije.php", $data);
    }
    
}
