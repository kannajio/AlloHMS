<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Camp_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertCamp($data) {
        $this->db->insert('camp', $data);
    }

    function getRiskById($cid) {
        $data = array();
        $this->db->select('id');
        $this->db->where('camp_id', $cid);
        $query = $this->db->get('patient');
        $result = $query->result_array();

        $patId = array();
        foreach($result as $val) {
            $patId[] = $val['id'];
        }
        if(count($patId) > 0) {
            $this->db->where('type', 1);
            $this->db->where_in('patient_id', $patId);
            $query = $this->db->get('patient_risk');
            $low = $query->result_array();
            $data['low'] = count($low);

            $this->db->where('type', 2);
            $this->db->where_in('patient_id', $patId);
            $query = $this->db->get('patient_risk');
            $mid = $query->result_array();
            $data['mid'] = count($mid);

            $this->db->where('type', 3);
            $this->db->where_in('patient_id', $patId);
            $query = $this->db->get('patient_risk');
            $high = $query->result_array();
            $data['high'] = count($high);
        } else {
            $data['low'] = 0;
            $data['mid'] = 0;
            $data['high'] = 0;
        }
        return $data;
        //echo "<pre>"; print_r($data); exit;
    }

    function getCamps() {
        //$this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('camp');
        return $query->result();
    }

    function checkCamp($name,$id='') {
        //$this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        if($id) {
            $this->db->where('id !=', $id);
        }
        $this->db->where('category', 'vital');
        $this->db->where('name', $name);
        $query = $this->db->get('camp');
        return $query->result();
    }

    function getCampById($id) {
        //$this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('camp');
        return $query->row();
    }

    function updateCamp($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('camp', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('camp');
    }

    function getVitalByIonUserIdFromUsers($id) {
       
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

}
