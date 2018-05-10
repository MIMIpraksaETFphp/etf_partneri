<?php

class ModelKorisnik extends CI_Model {
    public $username;
    public $ime;
    public $prezime;
    public $idKorisnik;
    public $korisnik;


    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
       
    
    
    
    public function proveraUsername($username) {
        $result=$this->db->where('username', $username)->get('korisnik');
        $korisnik=$result->row();
         if ($korisnik!=NULL) {
            $this->korisnik=$korisnik;
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function proveraPassword($username,$password) {  //ovde je neka greska
        $this->db->where('username', $username);    //ili ovde
        $this->db->where('password', $password);
        $result= $this->db->get('korisnik');
        $korisnik=$result->row_array();
        
        if($korisnik!=NULL){
            $this->ime=$korisnik['ime'];
            $this->prezime=$korisnik['prezime'];
            $this->idKorisnik=$korisnik['idKorisnik'];
            return TRUE;
        }else{
            return FALSE;
        }
    }
}