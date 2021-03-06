<?php

class ModelKorisnik extends CI_Model {

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
        if ($this->session->userdata('korisnik') != null) {
            if ($this->session->userdata('korisnik')->status_korisnika_idtable1 == 4) {
                $this->db->set("status_korisnika_idtable1", $korisnik['status_korisnika_idtable1']);
            }
        }
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

    public function pretragaPartnera($limit = 1000, $pocetak = 0, $vazeciUgovor = 0, $kompanija = NULL, $paket = NULL) {
        $this->db->select('naziv, idPartner');
        if (!empty($kompanija)) {
            $this->db->like('naziv', $kompanija);
            $this->db->group_by('naziv');
            if ($vazeciUgovor == 1) {
                $this->db->where('status_ugovora_idstatus_ugovora=5');
                $this->db->from('ugovor');
                $this->db->where('partner_idPartner=idPartner');
            }
        } elseif (!empty($paket)) {
            $this->db->from('ugovor, paketi');
            $this->db->like('naziv_paketa', $paket);
            $this->db->where('partner_idPartner=idPartner and paketi_idPaketi=idPaketi');
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

    public function dosijePartner($idPartner) {
        $this->db->where('idPartner', $idPartner);
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

    public function poveziKorisnikPartner($idPartnera, $idKorisnik) {
        $this->db->set("korisnik_idKorisnik", $idKorisnik);
        $this->db->set("partner_idPartner", $idPartnera);
        $this->db->insert('korisnik_ima_partner');
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

    public function dodajOglasFajl($oglasnaslov, $oglasPutanja, $idOglas) {
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

    public function pretragaUgovora($idPartner) {
        $this->db->select('datum_potpisivanja, datum_isticanja, tip, naziv, naziv_paketa');
        $this->db->from('ugovor, partner, paketi');
        $this->db->where('partner_idPartner=idPartner and idPaketi=paketi_idPaketi');
        $this->db->where('idPartner', $idPartner);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function pretragaTelefoni($idPartner) {
        $this->db->select('telefon, idTelefon_partnera');
        $this->db->from('telefon_partnera, partner');
        $this->db->where('partner_idPartner=idPartner');
        $this->db->where('idPartner', $idPartner);
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

    public function pretragaMejlovi($idPartner) {
        $this->db->select('email, idEmail_partnera');
        $this->db->from('email_partnera, partner');
        $this->db->where('partner_idPartner=idPartner');
        $this->db->where('idPartner', $idPartner);
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

    public function pretragaLogo($idPartner) {
        $this->db->select('putanja');
        $this->db->from('logo, partner p');
        $this->db->where('partner_idPartner=idPartner');
        $this->db->where('idPartner', $idPartner);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function iscitajPartnera() {
        $this->db->select('datum_isticanja, partner_idPartner, naziv, idPartner, naziv_paketa');
        $this->db->where('idPartner=partner_idPartner');
        $this->db->where('idPaketi=paketi_idPaketi');
        $this->db->order_by('datum_isticanja', 'desc');
        $query = $this->db->get('ugovor, partner, paketi');
        $result = $query->result_array();
        return $result;
    }

    public function iscitajPredavanje() {
        $this->db->select('naslov_srpski, vreme_predavanja, sala, ime_predavaca, prezime_predavaca, idpredavanje, opis_srpski, cv_srpski');
        $query = $this->db->get('predavanje', 10, 0);
        $result = $query->result_array();
        return $result;
    }

    public function iscitajOglase() {
        $this->db->select('naziv, datum_unosenja, idoglas');
        //$this->db->from('oglas');
        $this->db->order_by('datum_unosenja', 'desc');
        $query = $this->db->get('oglas', 10, 0);
        $result = $query->result_array();
        return $result;
    }

    public function statusIdUgovor() {
        $this->db->select('idstatus_ugovora, opis');
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
        $this->db->select('naziv, opis, idoglas, datum_unosenja, partner_idPartner');
        $this->db->from('oglas');
        $this->db->like('idoglas', $idOglas);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    public function iscitajOglasFajl($idOglas) {
        $this->db->select('idfajl, naziv, oglas_idoglas, putanja');
        $this->db->from('fajl');
        $this->db->like('oglas_idoglas', $idOglas);
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
        $this->db->select('idKorisnik, ime, prezime, username, status_korisnika_idtable1');
        $this->db->from('korisnik');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function dohvatiPartnere($podaci=[]) {
        $this->db->select('naziv, idPartner, ime, prezime, username, email, idKorisnik');
        $this->db->from('korisnik_ima_partner, korisnik, partner');
        $this->db->where('partner_idPartner=idPartner and korisnik_idKorisnik=idKorisnik');
        if (isset($podaci['idPartner'])) {
            $this->db->where('idPartner', $podaci['idPartner']);
        }
        if (isset($podaci['idKorisnik'])) {
            $this->db->where('idKorisnik', $podaci['idKorisnik']);
        }
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function dohvatiPartnera($idPartner) {
        $this->db->select('email_kontakt_osobe, naziv');
        $this->db->from('partner');
        $this->db->where('idPartner', $idPartner);
        $query = $this->db->get();
        $result = $query->row_array();
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

    public function promeniDUgovor($opisDonacije, $isporuka, $datumIsporuke, $komentar, $idUgovor) {
        $this->db->set('opis_donacije', $opisDonacije);
        $this->db->set('isporuka', $isporuka);
        $this->db->set('datum_isporuke', $datumIsporuke);
        $this->db->set('komentar', $komentar);
        $this->db->where('ugovor_idugovor', $idUgovor);
        $this->db->update('donatorski_ugovori');
    }

    public function stavkeuBazi() {
        $query = $this->db->get('stavke');
        $result = $query->result_array();
        return $result;
    }

    public function dodajStavku($novaStavka) {
        $this->db->set('opis', $novaStavka);
        $this->db->insert('stavke');
    }

    public function izbrisiPartnerClan($idKorisnik, $idPartner) {
        $this->db->from('korisnik_ima_partner');
        $this->db->where('korisnik_idKorisnik', $idKorisnik);
        $this->db->where('partner_idPartner', $idPartner);
        $this->db->delete();
    }

    public function dodavanjePartneraClanu($partnerClan) {
        $this->db->set('korisnik_idKorisnik', $partnerClan['korisnik_idKorisnik']);
        $this->db->set('partner_idPartner', $partnerClan['partner_idPartner']);
        $this->db->insert('korisnik_ima_partner');
    }

    public function iscitajKorisnikUsername() {
        $this->db->select('idKorisnik, username, status_korisnika_idtable1');
        $this->db->from('korisnik');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function iscitajStatusTabelu() {
        $this->db->select('idtable1, opis');
        $this->db->from('status_korisnika');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function promenaStatusa($KorisnikStatus) {
        $this->db->set('status_korisnika_idtable1', $KorisnikStatus['status_korisnika_idtable1']);
        $this->db->where('idKorisnik', $KorisnikStatus['idKorisnik']);
        $this->db->update('korisnik');
    }

    public function dodavanjePaketa($naziv, $vrednost, $trajanje, $maxbroj) {
        $this->db->set('naziv_paketa', $naziv);
        $this->db->set('vrednost_paketa', $vrednost);
        $this->db->set('trajanje_paketa_godine', $trajanje);
        $this->db->set('maks_broj_partnera', $maxbroj);
        $this->db->set('valuta', 'EUR');
        $this->db->insert('paketi');
        $insertId = $this->db->insert_id();
        return $insertId;
    }

    public function dodajStavkePaketu($insertId, $idStavke) {
        $this->db->set('paketi_idPaketi', $insertId);
        $this->db->set('stavke_idstavke', $idStavke);
        $this->db->insert('paket_ima_stavke');
    }

    public function paketNemaUgovor($idPaket) {
        $this->db->select('idugovor');
        $this->db->from('ugovor, paketi');
        $this->db->where('paketi_idPaketi', $idPaket);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    public function brisanjePaketa($idPaket) {
        $this->db->where('idPaketi', $idPaket);
        $this->db->delete('paketi');
    }

    public function iscitajTrenutniStatus() {
        $this->db->select('username, ime, prezime, status_korisnika_idtable1, opis');
        $this->db->from('korisnik, status_korisnika');
        $this->db->where('idtable1=status_korisnika_idtable1');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function dodajMejl($subject, $message, $datum, $idKorisnik) {
        $this->db->set('naslov', $subject);
        $this->db->set('sadrzaj', $message);
        $this->db->set('datum_slanja', $datum);
        $this->db->set('korisnik_idKorisnik', $idKorisnik);
        $this->db->insert('mejl');
        $insertovaniIdMejla = $this->db->insert_id();
        return $insertovaniIdMejla;
    }

    public function dodajPrimaocaMejla($adresaPrimaoca, $idMejla) {
        $this->db->set('email_primaoca', $adresaPrimaoca);
        $this->db->set('mejl_idmejl', $idMejla);
        $this->db->insert('primalac_mejla');
    }

    public function brojPartneraPaket() {
        $query = $this->db->query('SELECT idPaketi, naziv_paketa, COUNT(paketi_idPaketi) as broj, maks_broj_partnera
                                   FROM paketi 
                                   LEFT JOIN ugovor ON idPaketi = paketi_idPaketi
                                   WHERE status_ugovora_idstatus_ugovora<>6
                                   GROUP BY naziv_paketa  
                                   ORDER BY idPaketi asc;');
        $result = $query->result_array();
        return $result;
    }

    public function brojPartneraPoPaketu($idPaketi) {
        $query = $this->db->query("SELECT idPaketi, naziv_paketa, COUNT(paketi_idPaketi) as broj, maks_broj_partnera
                                   FROM paketi 
                                   LEFT JOIN ugovor ON idPaketi = paketi_idPaketi
                                   WHERE idPaketi=$idPaketi and status_ugovora_idstatus_ugovora<>6
                                   GROUP BY naziv_paketa
                                   ORDER BY idPaketi asc;");
        $result = $query->result_array();
        return $result;
    }

    public function promeniPassword($idKorisnik, $novi_password) {
        $this->db->set('password', $novi_password);
        $this->db->where('idKorisnik', $idKorisnik);
        $this->db->update('korisnik');
    }

    public function proveraKorisnikPartner($korisnik, $partner = null) {
        $this->db->select('korisnik_idKorisnik, partner_idPartner');
        $this->db->from('korisnik_ima_partner');
        $this->db->where('korisnik_idKorisnik', $korisnik);
        if ($partner) {
            $this->db->where('partner_idPartner', $partner);
        }
        $query = $this->db->get();
        $num = $query->num_rows();
        if ($num > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function ispisNovcanihUgovoraArhiva() {
        $this->db->select('vrednost, ugovor_idugovor, komentar, datum_potpisivanja, datum_isticanja, tip, naziv, naziv_paketa, novcani_ugovori.valuta, status_ugovora.opis, idstatus_ugovora, idugovor');
        $this->db->from('novcani_ugovori, ugovor, status_ugovora, paketi, partner');
        $this->db->where('status_ugovora_idstatus_ugovora=idstatus_ugovora and partner_idPartner=idPartner and paketi_idPaketi=idPaketi and ugovor_idugovor=idugovor');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function ispisDonatorskihUgovoraArhiva() {
        $this->db->select('procenjena_vrednost, opis_donacije, datum_potpisivanja, donatorski_ugovori.valuta, datum_isticanja, isporuka, status_ugovora.opis, tip, naziv, datum_isporuke, komentar, naziv_paketa, donatorski_ugovori.valuta, idstatus_ugovora, idugovor');
        $this->db->from('donatorski_ugovori, ugovor, status_ugovora, paketi, partner');
        $this->db->where('status_ugovora_idstatus_ugovora=idstatus_ugovora and partner_idPartner=idPartner and paketi_idPaketi=idPaketi and ugovor_idugovor=idugovor');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function proveraIdenticanUsername($username) {
        $this->db->select('username');
        $this->db->from('korisnik');
        $this->db->where('username', $username);
        $query = $this->db->get();
        $num = $query->num_rows();
        if ($num > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function ispisMejlova() {
        $this->db->select('idmejl, datum_slanja, naslov, sadrzaj, ime, prezime, email');
        $this->db->from('korisnik, mejl');
        $this->db->where('korisnik_idKorisnik=idKorisnik');
        $this->db->order_by('idmejl', 'asc');
        // $this->db->where('idmejl', $idmejl);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function brojMejlova() {
        $this->db->select('idmejl');
        $this->db->from('mejl');
        $query = $this->db->get();
        $num = $query->num_rows();
        return $num;
    }

    public function ispisMejlovaNovi() {
        $this->db->select('idmejl, datum_slanja, naslov, sadrzaj, ime, prezime, email, email_primaoca');
        $this->db->from('korisnik, mejl, primalac_mejla');
        $this->db->where('korisnik_idKorisnik=idKorisnik');
        $this->db->where('idmejl=mejl_idmejl');
        $this->db->order_by('idmejl', 'asc');
        // $this->db->where('idmejl', $idmejl);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function ispisPrimalacaMejlova($idmejl) {
        $this->db->select('email_primaoca');
        $this->db->from('mejl, primalac_mejla');
        $this->db->where('idmejl=mejl_idmejl');
        $this->db->where('idmejl', $idmejl);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function proveraIdenticnaMejlAdresa($emailPrimaoca, $idMejla) {
        $this->db->select('email_primaoca, mejl_idmejl');
        $this->db->from('primalac_mejla');
        $this->db->where('email_primaoca', $emailPrimaoca);
        $this->db->where('mejl_idmejl', $idMejla);
        $query = $this->db->get();
        $num = $query->num_rows();
        if ($num > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function godinePaket($id_paketa) {
        $this->db->select('trajanje_paketa_godine');
        $this->db->where('idPaketi', $id_paketa);
        $query = $this->db->get('paketi');
        $result = $query->row_array();
        return $result;
    }

    public function brojPaketa() {
       // $this->db->select('count(idPaketi)');
        $query = $this->db->get('paketi');
        $result = $query->num_rows();
        return $result;
    }

    public function iscitajPetKompanijaPotpisivanje($danasnjiDatum) {
        $this->db->select('datum_isticanja, datum_potpisivanja, partner_idPartner, naziv, idPartner, tip, idugovor');
        $this->db->where('idPartner=partner_idPartner');
        $this->db->where("datum_potpisivanja <'$danasnjiDatum'");
        $this->db->order_by('datum_potpisivanja', 'desc');
        $query = $this->db->get('ugovor, partner', 5, 0);
        $result = $query->result_array();
        return $result;
    }

    public function iscitajPetKompanijaIsticanje($danasnjiDatum) {
        $this->db->select('datum_isticanja, datum_potpisivanja, partner_idPartner, naziv, idPartner, tip, idugovor');
        $this->db->where('idPartner=partner_idPartner');
        $this->db->where("datum_isticanja >'$danasnjiDatum'");
        $this->db->order_by('datum_isticanja', 'asc');
        $query = $this->db->get('ugovor, partner', 5, 0);
        $result = $query->result_array();
        return $result;
    }

    public function clanImaUgovor($idKorisnik) {
        $this->db->select('idugovor');
        $this->db->from('partner, ugovor u, korisnik, korisnik_ima_partner k');
        $this->db->where('u.partner_idPartner=idPartner and korisnik_idKorisnik=idKorisnik and k.partner_idPartner=idPartner');
        $this->db->where('idKorisnik', $idKorisnik);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function dohvatiPartnereUgovor($podaci=[]) {
        $this->db->select('naziv, idPartner');
        $this->db->from('korisnik_ima_partner kip, korisnik, partner, ugovor u');
        $this->db->where('kip.partner_idPartner=idPartner and kip.korisnik_idKorisnik=idKorisnik and u.partner_idPartner=idPartner');
        $this->db->where('status_ugovora_idstatus_ugovora=5');
        if (isset($podaci['idKorisnik'])) {
            $this->db->where('idKorisnik', $podaci['idKorisnik']);
        }
        $this->db->group_by('naziv');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

}
