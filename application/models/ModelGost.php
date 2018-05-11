<?php

class ModelGost extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function pretraga($kompanija) {
        $this->db->select('naziv, opis');
        $this->db->from('partner');
        if ($kompanija != NULL) {
            $this->db->like('naziv', $kompanija);
        }
        $query = $this->db->get();
        $result = $query->result_array(); 
        return $result;
    }

    public function ispisPaketa(){
        $this->db->select('naziv_paketa, vrednost_paketa, valuta');
        $this->db->from('paketi');
        //$this->db->where ('idPaketi=paketi_idPaketi and idstavke=stavke_idstavke');
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
