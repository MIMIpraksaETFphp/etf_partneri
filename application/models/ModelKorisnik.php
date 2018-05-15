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
        $result = $this->db->where('username', $username)->get('korisnik');
        $korisnik = $result->row();
        if ($korisnik != NULL) {
            $this->korisnik = $korisnik;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function proveraPassword($password) {

        if ($this->korisnik->password == $password) {
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
        $this->db->set("partner_idPartner", $oglas['naziv_partnera']);
        $this->db->insert('oglas');
    }

    public function pretragaPartnera($limit = 1000, $pocetak = 0, $vazeciUgovor, $kompanija = NULL, $paket = NULL) {
//        if ($vazeciUgovor == 1) {
//            $this->db->where('status_ugovora_idstatus_ugovora=5');
//            $this->db->from('ugovor');
//        }
        if (!empty($kompanija)) {
            $this->db->from('ugovor');
            $this->db->like('naziv', $kompanija);
            $this->db->where('partner_idPartner=idPartner');
            if ($vazeciUgovor == 1) {
                $this->db->where('status_ugovora_idstatus_ugovora=5');
            }
        } elseif (!empty($paket)) {
            $this->db->from('ugovor, paketi');
            $this->db->where('partner_idPartner=idPartner and paketi_idPaketi=idPaketi');
            $this->db->like('naziv_paketa', $paket);
            if ($vazeciUgovor == 1) {
                $this->db->where('status_ugovora_idstatus_ugovora=5');
            }
        }
        $query = $this->db->get('partner', $limit, $pocetak);
        $result = $query->result_array();
        return $result;
    }

    public function brojPartnera() {
        $this->db->select('*');
        $this->db->from("partner");
        return $this->db->count_all_results();
    }
    public function partnerIdNaziv(){
        $this->db->select('idPartner,naziv');
        $this->db->from('partner');
        $query=$this->db->get();
        $result= $query->result_array();
        return $result;
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
//}

//    function pretragaPoNazivu($kompanija, $vazeciUgovor) {
//        $this->db->select('naziv');
//        $this->db->from('partner, ugovor');
//        $this->db->like('naziv', $kompanija);
//        $this->db->where('partner_idPartner=idPartner');
//        if ($vazeciUgovor == 1) {
//            $this->db->where('status_ugovora_idstatus_ugovora=5');
//        }
//        $query = $this->db->get();
//        $result = $query->result_array();
//        return $result;
//    }
//
//    function pretragaPoPaketu($paket, $vazeciUgovor) {
//        $this->db->select('naziv');
//        $this->db->from('partner, ugovor, paketi');
//        $this->db->where('partner_idPartner=idPartner and paketi_idPaketi=idPaketi');
//        $this->db->like('naziv_paketa', $paket);
//        if ($vazeciUgovor == 1) {
//            $this->db->where('status_ugovora_idstatus_ugovora=5');
//        }
//        $query = $this->db->get();
//        $result = $query->result_array();
//        return $result;
//    }
