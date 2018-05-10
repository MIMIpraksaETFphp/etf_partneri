<?php


class Gost extends CI_Controller {
public function __construct() {
    parent::__construct();
    $this->load->model("ModelKorisnik");
    $this->load->library('session');
    if(($this->session->userdata('korisnik'))!=NULL)
        redirect ("Korisnik");
}

public function loadView($page){
    $this->load->view("sabloni/header_gost.php");
    $this->load->view($page);    
    $this->load->view("sabloni/footer.php");
}

public function index(){
    $this->loadView("partneri.php");
    
}

public function login($poruka=NULL){
    $podaci=array();
    if($poruka)
        $podaci['poruka']=$poruka;
    $this->load->view("login.php");
}

public function ulogujse(){
    $this->form_validation->set_rules("username", "Username", "required");
    $this->form_validation->set_rules("password", "Password", "required");
    $this->form_validation->set_message("required", "Polje {field} je ostalo prazno");
    if($this->form_validation->run()){
        $this->ModelKorisnik->username= $this->input->post('username');
        if(!$this->ModelKorisnik->proveraUsername())
            $this->login ("Neispravan username");
            elseif (!$this->ModelKorisnik->proveraPassword($this->input->post('password')))
                $this->login ("Neispravan password");
            else {
                $this->load->library('session');
                $this->session->set_userdata('korisnik', $this->ModelKorisnik);
                redirect("Korisnik/index");
            }
            
        
    } else
        $this->login();
}

public function registracija(){
    $this->loadView("registracija.php");
    /*TO DO*/
}

}