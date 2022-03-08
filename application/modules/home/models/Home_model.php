<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getSum($field, $table) {
        $this->db->select_sum($field);
        $query = $this->db->get($table);
        return $query->result();
    }

    public function updateExistUser($hos, $table) {
        $query = $this->db->select('*')
		->where('hospital_id', $this->session->userdata('hospital_id'))
		->get($table);
		$user = $query->result();
        foreach($user as $val) {
            //echo "<pre>"; print_r($val); exit;
            $data = array();
            if($table == 'payroll') {
                $serialId = $hos.(1000 + $val->id);
                $data['payroll_id'] = $serialId;
                $this->db->update($table, $data, array('id' => $val->id));
            } else {
                $serialId = $hos.(1000 + $val->ion_user_id);
                $data['serial_id'] = $serialId;
                $this->db->update($table, $data, array('ion_user_id' => $val->ion_user_id));
            }
            
        }
        return true;
        
    }

}
