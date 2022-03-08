<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payroll_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPayroll($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        //echo "<pre>"; print_r($data2); exit;
        $this->db->insert('payroll', $data2);
        $insert_id = $this->db->insert_id();
        $query = $this->db->select('name')
		->where('id', $this->session->userdata('hospital_id'))
		->get('hospital');
		$user = $query->row();

		$serialId = strtoupper(substr($user->name,0,2)).(1000 + $insert_id);
		$data = array();
		$data['payroll_id'] = $serialId;
		$this->db->update('payroll', $data, array('id' => $insert_id));
        return true;
    }

    function updatePayroll($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('payroll', $data);
    }

    function getdata($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('payroll');
        return $query->row();
    }

    function getsno() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('payroll');
        return $query->row();
    }

    function getEmployee($roll) {
        $this->db->select('users.id,users.username');
        $this->db->where('users.active', 1);
        $this->db->join('users', 'users.id = ' . $roll . '.ion_user_id');
        return $this->db->get($roll)->result_array();
    }

    function getPayroll() {
        $this->db->select('payroll.*,users.username as username');
        if ($this->ion_auth->in_group(array('admin','Accountant','superadmin','human_resource'))) {
        } else {
            $this->db->where('users.id', $this->session->userdata('user_id'));
        }
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('payroll.id', 'desc');
        $this->db->join('users', 'users.id = payroll.emp_id');
        $query = $this->db->get('payroll');
        return $query->result();
    }

    function getMyPayroll() {
        $this->db->select('payroll.*,users.username as username');
        $this->db->where('users.id', $this->session->userdata('user_id'));
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('payroll.id', 'desc');
        $this->db->join('users', 'users.id = payroll.emp_id');
        $query = $this->db->get('payroll');
        return $query->result();
    }

    function getPayrollBysearch($search) {
        $this->db->order_by('payroll.id', 'desc');
        if ($this->ion_auth->in_group(array('admin','Accountant','superadmin','human_resource'))) {
        } else {
            $this->db->where('users.id', $this->session->userdata('user_id'));
        }
        $query = $this->db->select('payroll.*,users.username as username')
                ->from('payroll')
                ->join('users', 'users.id = payroll.emp_id')
                ->where('payroll.hospital_id', $this->session->userdata('hospital_id'))
                ->where("(payroll.id LIKE '%" . $search . "%' 
                OR payroll.payroll_id LIKE '%" . $search . "%' 
                OR payroll.year LIKE '%" . $search . "%' 
                OR payroll.status LIKE '%" . $search . "%'
                OR users.username LIKE '%" . $search . "%'
                OR payroll.month_name LIKE '%" . $search . "%'
                OR payroll.net LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getMyPayrollBysearch($search) {
        $this->db->order_by('payroll.id', 'desc');
        $this->db->where('users.id', $this->session->userdata('user_id'));
        $query = $this->db->select('payroll.*,users.username as username')
                ->from('payroll')
                ->join('users', 'users.id = payroll.emp_id')
                ->where('payroll.hospital_id', $this->session->userdata('hospital_id'))
                ->where("(payroll.id LIKE '%" . $search . "%' 
                OR payroll.payroll_id LIKE '%" . $search . "%' 
                OR payroll.year LIKE '%" . $search . "%' 
                OR payroll.status LIKE '%" . $search . "%'
                OR users.username LIKE '%" . $search . "%'
                OR payroll.month_name LIKE '%" . $search . "%'
                OR payroll.net LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }


    function getPurchase1() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('purchase');
        return $query->result();
    }

    function getPayrollById($id) {
        //echo $id; exit;
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('payroll');
        return $query->row();
    }

    function getPayrollByLimitBySearch($limit, $start, $search) {
        $this->db->order_by('payroll.id', 'desc');
        $this->db->limit($limit, $start);
        if ($this->ion_auth->in_group(array('admin','Accountant','superadmin','human_resource'))) {
        } else {
            $this->db->where('users.id', $this->session->userdata('user_id'));
        }
        $query = $this->db->select('payroll.*,users.username as username')
                ->from('payroll')
                ->join('users', 'users.id = payroll.emp_id')
                ->where('payroll.hospital_id', $this->session->userdata('hospital_id'))
                ->where("(payroll.id LIKE '%" . $search . "%' 
                OR payroll.payroll_id LIKE '%" . $search . "%' 
                OR payroll.year LIKE '%" . $search . "%' 
                OR payroll.status LIKE '%" . $search . "%'
                OR users.username LIKE '%" . $search . "%'
                OR payroll.month_name LIKE '%" . $search . "%'
                OR payroll.net LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getMyPayrollByLimitBySearch($limit, $start, $search) {
        $this->db->order_by('payroll.id', 'desc');
        $this->db->limit($limit, $start);
        $this->db->where('users.id', $this->session->userdata('user_id'));
        $query = $this->db->select('payroll.*,users.username as username')
                ->from('payroll')
                ->join('users', 'users.id = payroll.emp_id')
                ->where('payroll.hospital_id', $this->session->userdata('hospital_id'))
                ->where("(payroll.id LIKE '%" . $search . "%' 
                OR payroll.payroll_id LIKE '%" . $search . "%' 
                OR payroll.year LIKE '%" . $search . "%' 
                OR payroll.status LIKE '%" . $search . "%'
                OR users.username LIKE '%" . $search . "%'
                OR payroll.month_name LIKE '%" . $search . "%'
                OR payroll.net LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getPayrollByLimit($limit, $start) {
        $this->db->select('payroll.*,users.username as username');
        if ($this->ion_auth->in_group(array('admin','Accountant','superadmin','human_resource'))) {
        } else {
            $this->db->where('users.id', $this->session->userdata('user_id'));
        }
        $this->db->where('payroll.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('payroll.id', 'desc');
        $this->db->limit($limit, $start);
        $this->db->join('users', 'users.id = payroll.emp_id');
        $query = $this->db->get('payroll');
        return $query->result();
    }

    function getMyPayrollByLimit($limit, $start) {
        $this->db->select('payroll.*,users.username as username');
        $this->db->where('users.id', $this->session->userdata('user_id'));
        $this->db->where('payroll.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('payroll.id', 'desc');
        $this->db->limit($limit, $start);
        $this->db->join('users', 'users.id = payroll.emp_id');
        $query = $this->db->get('payroll');
        return $query->result();
    }

    function deletePayroll($id) {
        $this->db->where('id', $id);
        $this->db->delete('payroll');
    }

}
