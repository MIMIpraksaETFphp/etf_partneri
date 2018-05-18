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
        $this->db->set("partner_idPartner", $oglas['id_partnera']);
        $this->db->insert('oglas');
        $insertovanidOglas = $this->db->insert_id();
        return $insertovanidOglas;
    }

    public function pretragaPartnera($limit = 1000, $pocetak = 0, $vazeciUgovor, $kompanija = NULL, $paket = NULL) {
        $this->db->select('naziv');
        if (!empty($kompanija)) {
            $this->db->from('ugovor');
            $this->db->like('naziv', $kompanija);
            $this->db->where('partner_idPartner=idPartner');
            $this->db->group_by('naziv');
            if ($vazeciUgovor == 1) {
                $this->db->where('status_ugovora_idstatus_ugovora=5');
            }
        } elseif (!empty($paket)) {
            $this->db->from('ugovor, paketi');
            $this->db->where('partner_idPartner=idPartner and paketi_idPaketi=idPaketi');
            $this->db->like('naziv_paketa', $paket);
            $this->db->group_by('naziv');
            if ($vazeciUgovor == 1) {
                $this->db->where('status_ugovora_idstatus_ugovora=5');
            }
        } elseif ($vazeciUgovor == 1) {
            $this->db->where('partner_idPartner=idPartner and status_ugovora_idstatus_ugovora=5');
            $this->db->from('ugovor');
            $this->db->group_by('naziv');
        }
        $query = $this->db->get('partner', $limit, $pocetak);
        $result = $query->result_array();
        return $result;
    }

    public function brojPartnera($kompanija = NULL, $paket = NULL, $vazeciUgovor = 0) {
        $this->db->select('*');
        if (!empty($kompanija)) {
            $this->db->from('ugovor');
            $this->db->like('naziv', $kompanija);
            $this->db->where('partner_idPartner=idPartner');
            $this->db->group_by('naziv');
            if ($vazeciUgovor == 1) {
                $this->db->where('status_ugovora_idstatus_ugovora=5');
            }
        } elseif (!empty($paket)) {
            $this->db->from('ugovor, paketi');
            $this->db->where('partner_idPartner=idPartner and paketi_idPaketi=idPaketi');
            $this->db->like('naziv_paketa', $paket);
            $this->db->group_by('naziv');
            if ($vazeciUgovor == 1) {
                $this->db->where('status_ugovora_idstatus_ugovora=5');
            }
        } elseif ($vazeciUgovor == 1) {
            $this->db->from('ugovor');
            $this->db->where('partner_idPartner=idPartner and status_ugovora_idstatus_ugovora=5');
            $this->db->group_by('naziv');
        }
        $this->db->from("partner");
        return $this->db->count_all_results();
    }

    public function dosijePartner($kompanija) {
        $this->db->where('naziv', $kompanija);
        $query = $this->db->get('partner');
        $result = $query->result_array();
        return $result;
    }

    public function partnerIdNaziv() {
        $this->db->select('idPartner, naziv');
        $this->db->from('partner');
        $query = $this->db->get();
        $result = $query->result_array();
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
        $insertovanidPartnera = $this->db->insert_id();
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

    public function dodatIdFajla($oglasnaslov, $oglasPutanja, $insertovanidOglasa) {
        $this->db->set("naziv", $oglasnaslov);
        $this->db->set("putanja", $oglasPutanja);
        $this->db->set("oglas_idoglas", $insertovanidOglasa);

        $this->db->insert('fajl');
    }

    public function dodatLogo($logo, $putanja, $insertovanidPartnera) {
        $this->db->set("naziv", $logo);
        $this->db->set("putanja", $putanja);
        $this->db->set("partner_idPartner", $insertovanidPartnera);
        $this->db->insert('logo');
    }

    public function dodatoPredavanje($predavanje) {
        $this->db->set("naslov_srpski", $predavanje['naslov_srpski']);
        $this->db->set("naslov_engleski", $predavanje['naslov_engleski']);
        $this->db->set("opis_srpski", $predavanje['opis_srpski']);
        $this->db->set("opis_engleski", $predavanje['opis_engleski']);
        $this->db->set("vreme_predavanja", $predavanje['vreme_predavanja']);
        $this->db->set("sala", $predavanje['sala']);
        $this->db->set("ime_predavaca", $predavanje['ime_predavaca']);
        $this->db->set("prezime_predavaca", $predavanje['prezime_predavaca']);
        $this->db->set("cv_srpski", $predavanje['cv_srpski']);
        $this->db->set("cv_engleski", $predavanje['cv_engleski']);
        $this->db->set("partner_idPartner", $predavanje['partner_idPartner']);
        $this->db->insert('predavanje');
    }

    public function pretragaUgovora($kompanija) {
        $this->db->select('datum_potpisivanja, datum_isticanja, tip, naziv, naziv_paketa');
        $this->db->from('ugovor, partner, paketi');
        $this->db->where('partner_idPartner=idPartner and idPaketi=paketi_idPaketi');
        $this->db->where('naziv', $kompanija);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function pretragaTelefoni($kompanija) {
        $this->db->select('telefon');
        $this->db->from('telefon_partnera, partner');
        $this->db->where('partner_idPartner=idPartner');
        $this->db->where('naziv', $kompanija);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }


     public function ispisNovcanihUgovora(){
        $this->db->select('faktura, uplata, vrednost, datum_uplate, datum_potpisivanja, datum_isticanja, tip, naziv, naziv_paketa, novcani_ugovori.valuta, status_ugovora.opis');
        $this->db->from('novcani_ugovori, ugovor, status_ugovora, paketi, partner');
        $this->db->where('status_ugovora_idstatus_ugovora=idstatus_ugovora and partner_idPartner=idPartner and paketi_idPaketi=idPaketi and ugovor_idugovor=idugovor');
        $this->db->order_by('datum_isticanja', 'asc');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
     }
     
    public function pretragaMejlovi($kompanija) {
        $this->db->select('email');
        $this->db->from('email_partnera, partner');
        $this->db->where('partner_idPartner=idPartner');
        $this->db->where('naziv', $kompanija);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
 
    public function dodatUgovor($novcaniUgovor) {
        $this->db->set("datum_potpisivanja", $novcaniUgovor['datum_potpisivanja']);
        $this->db->set("datum_isticanja", $novcaniUgovor['datum_isticanja']);
        $this->db->set("tip", $novcaniUgovor['tip']);
        $this->db->set("status_ugovora_idstatus_ugovora",  $novcaniUgovor['opis']);
        $this->db->set("paketi_idPaketi", $novcaniUgovor['id_paketa']);
        $this->db->set("partner_idPartner", $novcaniUgovor['id_partnera']);
        $this->db->insert('ugovor');
        $insertovanidNovcaniUgovor = $this->db->insert_id();
        return $insertovanidNovcaniUgovor;
    }
    
    public function dodatNovcaniUgovor($novcaniUgovor, $insertovanidNovcaniUgovor) {
        $this->db->set("vrednost", $novcaniUgovor['vrednost']);
        $this->db->set("valuta", $novcaniUgovor['valuta']);
        $this->db->set("faktura", $novcaniUgovor['faktura']);
        $this->db->set("uplata", $novcaniUgovor['uplata']);
        $this->db->set("datum_uplate", $novcaniUgovor['datum_uplate']);
        $this->db->set("ugovor_idugovor", $insertovanidNovcaniUgovor);
        $this->db->insert('novcani_ugovori');
    }
    
    public function paketIdNaziv() {
        $this->db->select('idPaketi, naziv_paketa');
        $this->db->from('paketi');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    
     public function pretragaLogo($kompanija) {
        $this->db->select('putanja');
        $this->db->from('logo, partner p');
        $this->db->where('partner_idPartner=idPartner');
        $this->db->where('p.naziv', $kompanija);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function iscitajPartnera(){
        $this->db->select('datum_isticanja, partner_idPartner, naziv, idPartner');
        $this->db->from('ugovor, partner');
        $this->db->where('idPartner=partner_idPartner');
        $this->db->order_by('datum_isticanja','desc');
        $query= $this->db->get();
        $result=$query->result_array();
        return $result;
    }
    public function iscitajPredavanje(){
        $this->db->select('naslov_srpski, vreme_predavanja, sala');
        $this->db->from('predavanje');
        $query= $this->db->get();
        $result=$query->result_array();
        return $result;
    }
    
    public function iscitajOglas(){
        $this->db->select('naziv, datum_unosenja');
        $this->db->from('oglas');
        $this->db->group_by('datum_unosenja', 'asc');
        $query= $this->db->get();
        $result=$query->result_array();
        return $result;
    }
    
    public function statusIdUgovor() {
        $this->db->select('idstatus_ugovora, opis');
        $this->db->from('status_ugovora');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
}
