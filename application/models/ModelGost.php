<?php

class ModelGost extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function pretraga($kompanija) {
        if ($kompanija != NULL) {
            $query = $this->db->query("select naziv from partner where naziv='$kompanija'");
        } else {
            $query = $this->db->query("select naziv from partner");
        }
            $result = $query->result_array(); //vraca niz 
            return $result;
        }
    }
    