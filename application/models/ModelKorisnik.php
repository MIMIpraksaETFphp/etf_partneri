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
    
    public function registrovanKorisnik($korisnik) {
        $this->db->set("username", $korisnik['username']);
        $this->db->set("password", $korisnik['password']);
        $this->db->set("ime", $korisnik['ime']);
        $this->db->set("prezime", $korisnik['prezime']);
        $this->db->set("datum_rodjenja", $korisnik['datum_rodjenja']);
        $this->db->set("telefon", $korisnik['telefon']);
        $this->db->set("email", $korisnik['email']);
        $this->db->set("status_korisnika_idtable1", 1);
        $this->db->insert('korisnik');
    }
    
    
    
}