<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Risk extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('risk_model');
        $permissions_check = $this->settings_model->modules();
        if (!$this->ion_auth->in_group(array('admin', 'Accountant', 'Doctor', 'Receptionist', 'Nurse', 'Laboratorist', 'Patient'))) {
            redirect('home/permission');
        }
        
    }

    public function index() {
        $data['risks'] = $this->risk_model->getRisks();
        $data['permissions'] = $this->db->get('permission_features')->result();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('risk', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewRisk() {
        //echo "<pre>"; print_r($_POST); exit;
        $id = $this->input->post('id');
        $element = $this->input->post('elements');
        $rtype = $this->input->post('type');
        $status = $this->input->post('status');
          
        //$error = array('error' => $this->upload->display_errors());
        $data = array();
        $data = array(
            'elements' => $element,
            'type' => $rtype,
            'status' => $status
        );

        if (empty($id)) {     // Adding New Notice
            //echo "<pre>"; print_r($data); exit;
            $this->risk_model->insertRisk($data);
            $this->session->set_flashdata('feedback', lang('added'));
        } else { // Updating Notice
            //echo "<pre>"; print_r($data); exit;
            $this->risk_model->updateRisk($id, $data);
            $this->session->set_flashdata('feedback', lang('updated'));
        }
        // Loading View
        redirect('risk');
    }

    function editRiskByJason() {
        $id = $this->input->get('id');
        
        $data['risk'] = $this->risk_model->getRiskById($id);
        
        echo json_encode($data);
    }

    function delete_risk() {
        $data = array();
        $id = $this->input->get('id');
        $this->risk_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('risk');
    }
        
}

/* End of file vital.php */
/* Location: ./application/modules/vital/controllers/vital.php */
