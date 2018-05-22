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

    public function dodatTelefonPartnera($telefon, $idPartner) {
        $this->db->set("telefon", $telefon);
        $this->db->set("partner_idPartner", $idPartner);
        $this->db->insert('telefon_partnera');
    }

    public function dodatEmailPartnera($email, $idPartner) {
        $this->db->set("email", $email);
        $this->db->set("partner_idPartner", $idPartner);
        $this->db->insert('email_partnera');
    }

    public function dodatIdFajla($oglasnaslov, $oglasPutanja, $idOglas) {
        $this->db->set("naziv", $oglasnaslov);
        $this->db->set("putanja", $oglasPutanja);
        $this->db->set("oglas_idoglas", $idOglas);

        $this->db->insert('fajl');
    }

    public function dodatLogo($logo, $putanja, $idPartner) {
        $this->db->set("naziv", $logo);
        $this->db->set("putanja", $putanja);
        $this->db->set("partner_idPartner", $idPartner);
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
        $this->db->select('telefon, idTelefon_partnera');
        $this->db->from('telefon_partnera, partner');
        $this->db->where('partner_idPartner=idPartner');
        $this->db->where('naziv', $kompanija);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function ispisNovcanihUgovora() {
        $this->db->select('faktura, uplata, vrednost, datum_uplate, datum_potpisivanja, datum_isticanja, tip, naziv, naziv_paketa, novcani_ugovori.valuta, status_ugovora.opis, idstatus_ugovora, idugovor, komentar');
        $this->db->from('novcani_ugovori, ugovor, status_ugovora, paketi, partner');
        $this->db->where('status_ugovora_idstatus_ugovora=idstatus_ugovora and partner_idPartner=idPartner and paketi_idPaketi=idPaketi and ugovor_idugovor=idugovor');
        $this->db->order_by('datum_isticanja', 'asc');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function pretragaMejlovi($kompanija) {
        $this->db->select('email, idEmail_partnera');
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
        $this->db->set("status_ugovora_idstatus_ugovora", $novcaniUgovor['opis']);
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

    public function iscitajPartnera() {
        $this->db->select('datum_isticanja, partner_idPartner, naziv, idPartner');
        //$this->db->from('ugovor, partner');
        $this->db->where('idPartner=partner_idPartner');
        $this->db->order_by('datum_isticanja', 'desc');
        $query = $this->db->get('ugovor, partner', 20, 0);
        $result = $query->result_array();
        return $result;
    }

    public function iscitajPredavanje() {
        $this->db->select('naslov_srpski, vreme_predavanja, sala, ime_predavaca, prezime_predavaca, idpredavanje, opis_srpski, cv_srpski');
        //$this->db->from('predavanje');
        $query = $this->db->get('predavanje', 10, 0);
        $result = $query->result_array();
        return $result;
    }

    public function iscitajOglase() {
        $this->db->select('naziv, datum_unosenja, idoglas');
        //$this->db->from('oglas');
        $this->db->group_by('datum_unosenja', 'asc');
        $query = $this->db->get('oglas', 5, 0);
        $result = $query->result_array();
        return $result;
    }

    public function statusIdUgovor() {
        $this->db->select('idstatus_ugovora, opis');     //donatorski_ugovori.opis   status_ugovora.opis
        $this->db->from('status_ugovora');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function promeniPartnera($partner) {
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
        $this->db->where('idPartner', $partner['idPartner']);
        $this->db->update('partner');
    }

    public function obrisiTelefon($idTelefon) {
        $this->db->where('idTelefon_partnera', $idTelefon);
        $this->db->delete('telefon_partnera');
    }

    public function promeniTelefon($idTelefon, $telefon) {
        $this->db->set('telefon', $telefon);
        $this->db->where('idTelefon_partnera', $idTelefon);
        $this->db->update('telefon_partnera');
    }

    public function promeniEmail($idEmail, $email) {
        $this->db->set('email', $email);
        $this->db->where('idEmail_partnera', $idEmail);
        $this->db->update('email_partnera');
    }

    public function obrisiEmail($idEmail) {
        $this->db->where('idEmail_partnera', $idEmail);
        $this->db->delete('email_partnera');
    }

    public function ispisDonatorskihUgovora() {
        $this->db->select('procenjena_vrednost, opis_donacije, datum_potpisivanja, donatorski_ugovori.valuta, datum_isticanja, isporuka, status_ugovora.opis, tip, naziv, datum_isporuke, komentar, naziv_paketa, donatorski_ugovori.valuta, idstatus_ugovora, idugovor');
        $this->db->from('donatorski_ugovori, ugovor, status_ugovora, paketi, partner');
        $this->db->where('status_ugovora_idstatus_ugovora=idstatus_ugovora and partner_idPartner=idPartner and paketi_idPaketi=idPaketi and ugovor_idugovor=idugovor');
        $this->db->order_by('datum_isticanja', 'asc');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function iscitajOglas($idOglas) {
        $this->db->select('naziv, opis, idoglas');
        $this->db->from('oglas');
        $this->db->like('idoglas', $idOglas);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    public function iscitajPredavanja($idpredavanje) {
        $this->db->select('naslov_srpski, vreme_predavanja, ime_predavaca, prezime_predavaca, sala, idpredavanje, opis_srpski, cv_srpski');
        $this->db->from('predavanje');
        $this->db->like('idpredavanje', $idpredavanje);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    public function dodatUgovorDonacije($donatorskiUgovor) {
        $this->db->set("datum_potpisivanja", $donatorskiUgovor['datum_potpisivanja']);
        $this->db->set("datum_isticanja", $donatorskiUgovor['datum_isticanja']);
        $this->db->set("tip", $donatorskiUgovor['tip']);
        $this->db->set("status_ugovora_idstatus_ugovora", $donatorskiUgovor['opis']);
        $this->db->set("paketi_idPaketi", $donatorskiUgovor['id_paketa']);
        $this->db->set("partner_idPartner", $donatorskiUgovor['id_partnera']);
        $this->db->insert('ugovor');
        $insertovanidDonatorskiUgovor = $this->db->insert_id();
        return $insertovanidDonatorskiUgovor;
    }

    public function dodatDonatorskiUgovor($donatorskiUgovor, $insertovanidDonatorskiUgovor) {
        $this->db->set("procenjena_vrednost", $donatorskiUgovor['procenjena_vrednost']);
        $this->db->set("valuta", $donatorskiUgovor['valuta']);
        $this->db->set("opis_donacije", $donatorskiUgovor['opis_donacije']);
        $this->db->set("komentar", $donatorskiUgovor['komentar']);
        $this->db->set("datum_isporuke", $donatorskiUgovor['datum_isporuke']);
        $this->db->set("ugovor_idugovor", $insertovanidDonatorskiUgovor);
        $this->db->insert('donatorski_ugovori');
    }
 
   
    public function dohvatiClanove() {
        $this->db->select('idKorisnik, ime, prezime, username');
        $this->db->from('korisnik');    
        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
    }
    public function dohvatiPartnere() {
        $this->db->select('naziv, idPartner, ime, prezime, username, idKorisnik');   
        $this->db->from('korisnik_ima_partner, korisnik, partner');
        $this->db->where('partner_idPartner=idPartner and korisnik_idKorisnik=idKorisnik');
        $query=$this->db->get();
        $result=$query->result_array();
        return $result;
    }

    public function promeniNUgovor($faktura, $uplata, $datumUplate, $komentar, $idUgovor) {
        $this->db->set('faktura', $faktura);
        $this->db->set('uplata', $uplata);
        $this->db->set('datum_uplate', $datumUplate);
        $this->db->set('komentar', $komentar);
        $this->db->where('ugovor_idugovor', $idUgovor);
        $this->db->update('novcani_ugovori');
    }

    public function promeniStatusUgovora($statusUgovora, $idUgovor) {
        $this->db->set('status_ugovora_idstatus_ugovora', $statusUgovora);
        $this->db->where('idugovor', $idUgovor);
        $this->db->update('ugovor');
    }
    
    public function promeniDUgovor($opisDonacije, $isporuka, $datumIsporuke, $komentar, $idUgovor){
        $this->db->set('opis_donacije', $opisDonacije);
        $this->db->set('isporuka', $isporuka);
        $this->db->set('datum_isporuke',$datumIsporuke);
        $this->db->set('komentar', $komentar);
        $this->db->where('ugovor_idugovor', $idUgovor);
        $this->db->update('donatorski_ugovori');
    }
    
    
}
