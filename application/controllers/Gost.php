<?php


class Gost extends CI_Controller {
public function __construct() {
    parent::__construct();
}

public function index(){
    $this->load->view("partneri.php");
    
}

public function login(){
    $this->load->view("login.php");
}

public function registracija(){
    $this->load->view("registracija.php");
}

}