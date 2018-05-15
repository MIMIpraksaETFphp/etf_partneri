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
    
    public function dodatPartner($partner) {
        $this->db->set("naziv", $partner['naziv']);
        $this->db->set("adresa", $partner['adresa']);
        $this->db->set("grad", $partner['grad']);
        $this->db->set("postanski_broj", $partner['postanski_broj']);
        $this->db->set("drzava", $partner['drzava']);
        $this->db->set("ziro_racun", $partner['ziro_racun']);
        $this->db->set("valuta_racuna", $partner['valuta_racuna']);
        $this->db->set("PIB", $partner['PIB']);
        $this->db->set("ime_kontakt_osobe", $partner['ime_kontakt_osobe']);
        $this->db->set("opis", $partner['opis']);
        $this->db->set("veb_adresa", $partner['veb_adresa']);
        $this->db->set("prezime_kontakt_osobe", $partner['prezime_kontakt_osobe']);
        $this->db->set("telefon_kontakt_osobe", $partner['telefon_kontakt_osobe']);
        $this->db->set("email_kontakt_osobe", $partner['email_kontakt_osobe']);
        $this->db->insert('partner');
        $insertovanidPartnera=$this->db->insert_id();
        return $insertovanidPartnera;
    }
    
    public function dodatTelefonPartnera($telefon, $insertovanidPartnera) {
        $this->db->set("telefon", $telefon);
        $this->db->set("partner_idPartner", $insertovanidPartnera);
        $this->db->insert('telefon_partnera');
    }
    
    public function dodatEmailPartnera($email, $insertovanidPartnera) {
        $this->db->set("email", $email);
        $this->db->set("partner_idPartner", $insertovanidPartnera);
        $this->db->insert('email_partnera');
    }
}