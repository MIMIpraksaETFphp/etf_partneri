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
//            else
//            redirect("Gost/index");
            
        }  
    }

       
    
    
    public function loadView($page, $data = []) {
        $this->load->view("sabloni/header_gost.php");
        $this->load->view($page, $data);
        $this->load->view("sabloni/footer.php");
    }

    public function index() {
        // $this->loadView("partneri.php");

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
        $this->loadView("registracija.php");
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
        $this->form_validation->set_rules("password", "password", "required");    //ovde se unosi pass match itd
        //  $this->form_validation->set_rules("password", "password", "required");     //ponovljeni pass...
        $this->form_validation->set_rules("ime", "ime", "required");
        $this->form_validation->set_rules("prezime", "prezime", "required");
        $this->form_validation->set_rules("datum_rodjenja", "datum_rodjenja", "required");
        $this->form_validation->set_rules("telefon", "telefon", "required");
        $this->form_validation->set_rules("email", "email", "required");
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
//                'status_korisnika_idtable1'=>$this->input->post('status_korisnika_idtable1')
            );
//            
//            if ($this->session->userdata('korisnik') != null) {
//            if ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 4) {
//            }
//        }
            
            $this->ModelKorisnik->registrovanKorisnik($korisnik);
            redirect("$this->kontroler/index");
        }
    }

//    public function prikaziPartnere(){
//   $kompanija=$this->input->post("kompanija");
//   $rezultat=$this->ModelGost->pretraga($kompanija);
//   $data['naziv']=$rezultat;
//   $this->loadView("partneri.php", $data);
//}
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
        $data['oglas'] = $oglas;
        $this->loadView("oglasDetaljnije.php", $data);
    }
    public function predavanjeDetaljnije($idpredavanje){
        $predavanje=$this->ModelGost->iscitajPredavanje($idpredavanje);
        $data['predavanje'] = $predavanje;
        $this->loadView("predavanjeDetaljnije.php", $data);
    }
    
}
