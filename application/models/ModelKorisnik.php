<?php

class ModelKorisnik extends CI_Model {
    //public $username;
    //public $ime;
    //public $prezime;
    //public $idKorisnik;
    public $korisnik;


    public function __construct() {
        parent::__construct();
        $this->load->database();
        //$this->korisnik=NULL;
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
    
    public function proveraPassword($password) {  
   
        if ($this->korisnik->password== $password) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    
}