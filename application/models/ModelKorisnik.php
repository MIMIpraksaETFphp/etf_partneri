<?php

class ModelKorisnik extends CI_Model {
    public $username;
    public $ime;
    public $prezime;
    public $idKorisnik;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function proveraUsername() {
        $this->db->where('username', $this->username);
        $result= $this->db->get('korisnik');
        if($result->result())
            return TRUE;
        else
            return FALSE;
    }
    
    public function proveraPassword($password) {
        $this->db->where('username', $this->username);
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