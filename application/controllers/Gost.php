<?php
// Korisnik je clan 
class Gost extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("ModelGost");
        $this->load->model("ModelKorisnik");
        $this->load->library('session');

    }

    public function loadView($page, $data = []) {
        $this->load->view("sabloni/header_gost.php");
        $this->load->view($page, $data);
        $this->load->view("sabloni/footer.php");
    }

    public function index() {
       // $this->loadView("partneri.php");

        if (($this->session->userdata('korisnik')) != NULL){
             if ($korisnik->status_korisnika_idtable1 == 2)
                    redirect("Korisnik/index");
                elseif ($korisnik->status_korisnika_idtable1== 3)
                    redirect("ITmenadzer/index");
                elseif ($korisnik->status_korisnika_idtable1== 4)
                    redirect("Admin");
                //else
                    //$this->loadView("partneri.php");  
        }else{
            $kompanija = $this->input->post("kompanija");
        $rezultat = $this->ModelGost->pretraga($kompanija);
        $data['naziv'] = $rezultat;
        
        $paketi= $this->ModelGost->pretragaPaketa();
        $data['paketi']=$paketi;
        
        $this->loadView("partneri.php", $data);
        }    
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
                $this->login("Neispravan password");
            else {
                $korisnik = $this->ModelKorisnik->korisnik;
                $this->load->library('session');
                $this->session->set_userdata('korisnik', $korisnik);
                if ($korisnik->status_korisnika_idtable1 == 2)
                    redirect("Korisnik/index");

                elseif ($korisnik->status_korisnika_idtable1== 3)
                    redirect("ITmenadzer/index");
                elseif ($korisnik->status_korisnika_idtable1== 4)

                    redirect("Admin");
                else
                    redirect("Gost");
            }
        } else
            $this->login();
    }

    public function registracija() {
        $this->loadView("registracija.php");     
    }
    
    
    public function registruj_se() {
        
        $this->form_validation->set_rules("username", "username", "required");
        $this->form_validation->set_rules("password", "password", "required");
      //  $this->form_validation->set_rules("password", "password", "required");     //ponovljeni pass...
        $this->form_validation->set_rules("ime", "ime", "required");
        $this->form_validation->set_rules("prezime", "prezime", "required");
        $this->form_validation->set_rules("datum_rodjenja", "datum_rodjenja", "required");
        $this->form_validation->set_rules("telefon", "telefon", "required");
        $this->form_validation->set_rules("email", "email", "required");
        $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
        if ($this->form_validation->run()==FALSE){
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
//            'status_korisnika_idtable1'=>1
        );
        $this->ModelKorisnik->registrovanKorisnik($korisnik);
        redirect("Korisnik/index");
        }
    }   

    public function prikaziPartnere(){
   $kompanija=$this->input->post("kompanija");
   $rezultat=$this->ModelGost->pretraga($kompanija);
   $data['naziv']=$rezultat;
   $this->loadView("partneri.php", $data);
}
    public function paketi() {
        $paketiIspis= $this->ModelGost->ispisPaketa();
        $data['paketiIspis']=$paketiIspis;
        $this->loadView("paketi.php",$data);
    }
    
    public function oglasi() {
        $this->loadView("oglasi.php");
    }

    public function predavanja() {
        $this->loadView("predavanja.php");
    }

}
