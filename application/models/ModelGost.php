<?php

class ModelGost extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function pretraga($kompanija) {
        $this->db->select('p.naziv, opis, naziv_paketa, putanja, veb_adresa');
        $this->db->from('partner p, ugovor u, paketi, logo l');
        $this->db->where("u.partner_idPartner=idPartner and paketi_idPaketi=idPaketi and l.partner_idPartner=idPartner and status_ugovora_idstatus_ugovora='5'");
        $this->db->like('p.naziv', $kompanija);
        $this->db->group_by('p.naziv, opis, naziv_paketa, putanja, veb_adresa'); //pitati tamaru ili prof
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function spisakPaketa() {
        $this->db->select('naziv_paketa, vrednost_paketa, valuta, idPaketi, trajanje_paketa_godine');
        $this->db->from('paketi');
        $this->db->order_by('vrednost_paketa', 'desc');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function ispisPaketa() {
        $this->db->select('naziv_paketa, vrednost_paketa, valuta, opis');
        $this->db->from('paketi, paket_ima_stavke, stavke');
        $this->db->where('idPaketi=paketi_idPaketi and idstavke=stavke_idstavke');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function pretragaOglasa() {
        $this->db->select('o.naziv as oglas_naziv, o.opis as oglas_opis, praksa, zaposlenje, datum_unosenja, p.naziv as partner_naziv, idoglas');
        $this->db->from('oglas o, partner p');
        $this->db->where('partner_idPartner=idPartner');
        $this->db->order_by('datum_unosenja', 'desc');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function ispisPredavanja() {
        $this->db->select('naslov_srpski, opis_srpski, cv_srpski, sala, vreme_predavanja, ime_predavaca, prezime_predavaca, idpredavanje');
        // $this->db->from('predavanje, partner');
        $this->db->where('partner_idPartner=idPartner');
        $this->db->order_by('vreme_predavanja', 'asc');
        $query = $this->db->get('predavanje, partner', 20, 0);
        $result = $query->result_array();
        return $result;
    }

    public function ispisPredavanjaArhiva() {
        $this->db->select('naslov_srpski, opis_srpski, cv_srpski, sala, vreme_predavanja, ime_predavaca, prezime_predavaca');
        // $this->db->from('predavanje, partner');
        $this->db->where('partner_idPartner=idPartner');
        $this->db->order_by('vreme_predavanja', 'desc');
        $query = $this->db->get('predavanje, partner', 20, 0);
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

    public function iscitajPredavanje($idpredavanje) {
        $this->db->select('naslov_srpski, vreme_predavanja, ime_predavaca, prezime_predavaca, sala, idpredavanje, opis_srpski, cv_srpski');
        $this->db->from('predavanje');
        $this->db->like('idpredavanje', $idpredavanje);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

}
