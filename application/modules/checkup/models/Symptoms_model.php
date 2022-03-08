<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Symptoms_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertSymptom($data) {
        $this->db->insert('vital_symptoms', $data);
    }

    function getSymptom() {
        //$this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('category', 'symptom');
        $query = $this->db->get('vital_symptoms');
        return $query->result();
    }

    function checkSymptom($name,$id='') {
        //$this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        if($id) {
            $this->db->where('id !=', $id);
        }
        $this->db->where('category', 'symptom');
        $this->db->where('name', $name);
        $query = $this->db->get('vital_symptoms');
        return $query->result();
    }

    function getSymptomById($id) {
        //$this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('vital_symptoms');
        return $query->row();
    }

    function updateSymptom($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('vital_symptoms', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('vital_symptoms');
    }

    

    function getSymptomByIonUserId($id) {
        //$this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('vital_symptoms');
        return $query->row();
    }
     function updateIonUserId($username, $email, $password, $phone, $ion_user_id, $permission) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
            'permissions' => $permission,
          
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }
   function getSymptomByIonUserIdFromUsers($id) {
        //$this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }
}
