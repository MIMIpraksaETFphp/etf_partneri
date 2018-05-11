<?php

class ModelGost extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function pretraga($kompanija) {
        $this->db->select('naziv, opis, naziv_paketa');
        $this->db->from('partner, ugovor, paketi');
        $this->db->where('partner_idPartner=idPartner and paketi_idPaketi=idPaketi');
        if ($kompanija != NULL) {
            $this->db->like('naziv', $kompanija);
        }
        $query = $this->db->get();
        $result = $query->result_array(); 
        return $result;
    }

    public function pretragaPaketa(){
        $this->db->select('naziv_paketa');
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
    
    /*public function opisPaketa(){
        $this->db->select('opis');
        $this->db->from('stavke');
        $query= $this->db->get();
        $result=$query->result_array();
        return $result;
    }*/
    
}
