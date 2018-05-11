<?php

class ModelGost extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function pretraga($kompanija) {
        $this->db->select('naziv', 'opis');
        $this->db->from('partner');
        if ($kompanija != NULL) {
            $this->db->like('naziv', $kompanija);
        }
        $query = $this->db->get();
        $result = $query->result_array(); 
        return $result;
    }

}
