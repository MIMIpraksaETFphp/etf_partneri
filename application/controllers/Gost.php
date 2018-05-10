<?php


class Gost extends CI_Controller {
public function __construct() {
    parent::__construct();
}

public function index(){
    $this->load->view("partneri.php");
    
}

public function login($porika=NULL){
    $podaci=array();
    if($poruka)
        $podaci['poruka']=$poruka;
    $this->load->view($podaci, "login.php");
}

public function registracija(){
    $this->load->view("registracija.php");
}

}