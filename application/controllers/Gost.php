<?php


class Gost extends CI_Controller {
public function __construct() {
    parent::__construct();
}

public function loadView($page){
    $this->load->view("sabloni/header_gost.php");
    $this->load->view($page);    
    $this->load->view("sabloni/footer.php");
}

public function index(){
    $this->loadView("partneri.php");
    
}

public function login($porika=NULL){
    $podaci=array();
    if($poruka)
        $podaci['poruka']=$poruka;
    $this->load->view($podaci, "login.php");
}

public function registracija(){
    $this->loadView("registracija.php");
    /*TO DO*/
}

}