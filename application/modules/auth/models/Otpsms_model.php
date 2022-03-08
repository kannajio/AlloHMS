<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Otpsms_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getSettings() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('settings');
        return $query->row();
    }

    function getOTPSettings($hid) {
        $this->db->where('ion_user_id', $hid);
        $query = $this->db->get('hospital');
        $hosid = $query->row();
        //echo "<pre>"; print_r($hosid); exit;
        $this->db->where('hospital_id', $hosid->id);
        $query = $this->db->get('settings');
        return $query->row();
    }

    function getSmsSettingsByGatewayName($hid,$name) {
        $this->db->where('ion_user_id', $hid);
        $query = $this->db->get('hospital');
        $hosid = $query->row();
        //echo "<pre>"; print_r($hosid); exit;
        $this->db->where('hospital_id', $hosid->id);
        $this->db->where('name', $name);
        $query = $this->db->get('sms_settings');
        return $query->row();
    }

    function updateOTP($data, $varify) {
        $uptade_ion_user = array(
            'otp' => $data,
            'verified' => $varify
        );
        $this->db->where('phone', $_SESSION['userinput']);
        $this->db->update('users', $uptade_ion_user);
        return true;
    }

    function checkPhoneNumber($phone) {
        $this->db->where('phone', $phone);
        $query = $this->db->get('users');
        return $query->row();
    }

}
