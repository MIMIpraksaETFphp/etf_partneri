<?php

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
            $this->loadView("partneri.php");
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
                if ($korisnik->status_korisnika_idtable1== 2)
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
        /* TO DO */
    }


public function prikaziPartnere(){
   $kompanija=$this->input->post("kompanija");
   $rezultat=$this->ModelGost->pretraga($kompanija);
   $data['naziv']=$rezultat;
   $this->loadView("partneri.php", $data);
}

public function paketi(){
    $this->loadView("paketi.php");
}

}

