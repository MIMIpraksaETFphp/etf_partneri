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
    

    public function dodatOglas($oglas) {
        $this->db->set("naziv", $oglas['oglasnaslov']);
        $this->db->set("opis", $oglas['oglastext']);
        $this->db->set("praksa", $oglas['praksa']);
        $this->db->set("zaposlenje", $oglas['zaposlenje']);
        $this->db->set("datum_unosenja", $oglas['datum_unosenja']);
        $this->db->set("partner_idPartner", 1);
        
        $this->db->insert('oglas');
    }
    public function pretragaPartnera($limit=1000, $pocetak=0){
        $query=$this->db->get('partner', $limit, $pocetak);
        $result = $query->result_array();
        return $result;
    }
      
    public function brojPartnera(){
        $this->db->from("partner");
        return $this->db->count_all_results();

    }
    
}