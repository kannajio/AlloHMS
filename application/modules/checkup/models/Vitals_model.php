<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vitals_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertVital($data) {
        $this->db->insert('vital_symptoms', $data);
    }

    function getVital() {
        //$this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('category', 'vital');
        $query = $this->db->get('vital_symptoms');
        return $query->result();
    }

    function checkVitals($name,$id='') {
        //$this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        if($id) {
            $this->db->where('id !=', $id);
        }
        $this->db->where('category', 'vital');
        $this->db->where('name', $name);
        $query = $this->db->get('vital_symptoms');
        return $query->result();
    }

    function getVitalById($id) {
        //$this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('vital_symptoms');
        return $query->row();
    }

    function updateVital($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('vital_symptoms', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('vital_symptoms');
    }

    function getVitalByIonUserIdFromUsers($id) {
       
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

}
