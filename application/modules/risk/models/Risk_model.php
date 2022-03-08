<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Risk_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertRisk($data) {
        $this->db->insert('risk_factor_elements', $data);
    }

    function getRisks() {
        //$this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('risk_factor_elements');
        return $query->result();
    }

    function checkCamp($type,$element,$id='') {
        //$this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        if($id) {
            $this->db->where('id !=', $id);
        }
        $this->db->where('elements', $element);
        $this->db->where('type', $type);
        $query = $this->db->get('risk_factor_elements');
        return $query->result();
    }

    function getRiskById($id) {
        //$this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('risk_factor_elements');
        return $query->row();
    }

    function updateRisk($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('risk_factor_elements', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('risk_factor_elements');
    }

}
