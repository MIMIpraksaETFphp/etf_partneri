<?php

class ModelGost extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

   /* public function pretraga() {
        $this->db->select('naziv, opis, naziv_paketa');
        $this->db->from('partner, ugovor, paketi');
        $this->db->where('partner_idPartner=idPartner and paketi_idPaketi=idPaketi');
        $query = $this->db->get();
        $result = $query->result_array(); 
        return $result;
    }*/
    
 public function pretraga($kompanija) {
        $this->db->select('naziv, opis, naziv_paketa');
        $this->db->from('partner, ugovor, paketi');
        $this->db->where("partner_idPartner=idPartner and paketi_idPaketi=idPaketi");
              $this->db->like('naziv', $kompanija);
        $query = $this->db->get();
        $result = $query->result_array(); 
        return $result;
 }
 
    public function spisakPaketa(){
        $this->db->select('naziv_paketa, vrednost_paketa, valuta');
        $this->db->from('paketi');
        $query=$this->db->get();
        $result= $query->result_array();
        return $result;
    }
    public function ispisPaketa(){
        $this->db->select('naziv_paketa, vrednost_paketa, valuta, opis');
        $this->db->from('paketi, paket_ima_stavke, stavke');
        $this->db->where ('idPaketi=paketi_idPaketi and idstavke=stavke_idstavke');
        $query= $this->db->get();
        $result=$query->result_array();
        return $result;
    }
    
    public function pretragaOglasa(){
        $this->db->select('o.naziv as oglas_naziv, o.opis as oglas_opis, praksa, zaposlenje, datum_unosenja, p.naziv as partner_naziv');
        $this->db->from('oglas o, partner p');
        $this->db->where('partner_idPartner=idPartner');
        $this->db->order_by('datum_unosenja', 'desc');
        $query = $this->db->get();
        $result=$query->result_array();
        return $result;
    }
    
    public function ispisPredavanja(){
        $this->db->select('naslov_srpski, opis_srpski, cv_srpski, sala, vreme_predavanja, ime_predavaca, prezime_predavaca');
       // $this->db->from('predavanje, partner');
        $this->db->where('partner_idPartner=idPartner');
        $this->db->order_by('vreme_predavanja', 'asc');
        $query = $this->db->get('predavanje, partner', 20, 0);
        $result = $query->result_array();
        return $result;
    }
    
    public function ispisPredavanjaArhiva(){
        $this->db->select('naslov_srpski, opis_srpski, cv_srpski, sala, vreme_predavanja, ime_predavaca, prezime_predavaca');
       // $this->db->from('predavanje, partner');
        $this->db->where('partner_idPartner=idPartner');
        $this->db->order_by('vreme_predavanja', 'desc');
        $query = $this->db->get('predavanje, partner', 20, 0);
        $result = $query->result_array();
        return $result;
    }
}
