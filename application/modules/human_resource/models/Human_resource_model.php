<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Human_resource_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertHumanResource($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('human_resource', $data2);
    }

    function getHumanResource() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('human_resource');
        return $query->result();
    }

    function getHumanResourceById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('human_resource');
        return $query->row();
    }

    function updateHumanResource($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('human_resource', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('human_resource');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function getHumanResourceByIonUserId($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('human_resource');
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
   function getHumanResourceByIonUserIdFromUsers($id) {
       
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }
}
