<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Checkup_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertTemplate($table,$data) {
        $this->db->insert($table, $data);
        return $insert_id = $this->db->insert_id();
    }

    function updateTemplate($table,$data) {
        $this->db->where('checkup_id', $data['checkup_id']);
        $this->db->where('patient_id', $data['patient_id']);
        $this->db->update($table, $data);
        return $insert_id = $this->db->insert_id();
    }

    function getCheckupList() {
        $this->db->select('checkup.id,checkup.status, checkup.created_at, form_templates.name as tname, patient.name as pname');
        $this->db->join('patient', 'patient.id=checkup.patient_id');
        $this->db->join('form_templates', 'form_templates.id=checkup.form_id');
        $this->db->where('checkup.hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('checkup');
        return $query->result();
    }

    function getCheckupsByPatient($id) {
        $this->db->select('checkup.id,checkup.status, checkup.created_at, form_templates.name as tname, patient.name as pname');
        $this->db->join('patient', 'patient.id=checkup.patient_id');
        $this->db->join('form_templates', 'form_templates.id=checkup.form_id');
        $this->db->where('checkup.patient_id', $id);
        $this->db->where('checkup.hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('checkup');
        return $query->result();
    }

    function getTemplateById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('form_templates');
        return $query->row();
    }

    function updateCheckup($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('checkup', $data);
    }

    function deleteCheckup($id) {
        $this->db->where('id', $id);
        $this->db->delete('checkup');

        $this->db->where('checkup_id', $id);
        $this->db->delete('checkup_datas');
        return true;
    }

    function deleteCheckupDatas($id) {
        $this->db->where('checkup_id', $id);
        $this->db->delete('checkup_datas');
        return true;
    }

    function delete_checkup_tags($id) {
        $this->db->where('checkup_id', $id);
        $this->db->delete('checkup_tags');
        return true;
    }

    function getformTempById($id) {
        $this->db->select('checkup.id,checkup.status, checkup.created_at, checkup.patient_id as pid, checkup.form_id as tid, form_templates.name as tname, patient.name as pname, patient.serial_id as psid');
        $this->db->join('patient', 'patient.id=checkup.patient_id');
        $this->db->join('form_templates', 'form_templates.id=checkup.form_id');
        $this->db->where('checkup.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('checkup.id', $id);
        $query = $this->db->get('checkup');
        return $query->row();
    }

    function getCheckupTagsById($id) {
        $this->db->where('checkup_id', $id);
        $query = $this->db->get('checkup_tags');
        $checkupData = $query->row();
        $data = array();
        $exp = explode(',',$checkupData->tags);
        $this->db->where('input_type','tag');
        $this->db->where_in('id', $exp);
        $query = $this->db->get('vital_symptoms');
        $result = $query->result_array();
        foreach($result as $val) {
            $data[] = $val['name'];
        }
        return implode(',',$data);
    }

    function getformFieldsById($tempid, $id) {
        $data = $output = array();
        $this->db->where('id', $id);
        $this->db->where('form_id', $tempid);
        $query = $this->db->get('checkup');
        $checkupResult = $query->row();
        if($checkupResult) {
            $this->db->where('checkup_id', $id);
            $query = $this->db->get('checkup_datas');
            $checkupData = $query->result_array();

            // $this->db->where('template_id', $tempid);
            // $query = $this->db->get('template_fields');
            // $tempFields = $query->result_array();
            
            $i = 0;
            foreach($checkupData as $val) {
                $this->db->where('id', $val['field_id']);
                $query = $this->db->get('vital_symptoms');
                $result = $query->row();

                $data['field_id'] = $val['field_id'];
                $data['field_values'] = $val['field_values'];
                $data['input_type'] = $result->input_type;
                $data['input_options'] = $result->input_options;
                $data['name'] = $result->name;
                $data['unit'] = $result->unit;
                $data['category'] = $result->category;
                $output[] = $data;
                $i++;
            }
        }
        return $output;
    }

    function getTagedItems() {
        $data = array();
        $this->db->where('input_type','tag');
        if(isset($_GET['term']) && $_GET['term'] != '') {
            $this->db->like('name',$_GET['term']);
        }
        $query = $this->db->get('vital_symptoms');
        $result = $query->result_array();
        foreach($result as $val) {
            $res = array();
            $res['id'] = $val['id'];
            $res['label'] = $val['name'];
            $res['value'] = $val['name'];
            $data[] = $res;
        }
        return $data;
    }

    function getRisks() {
        $data = array();
        $rtype = 1;
        if($_SESSION['rtype']) {
            $rtype = $_SESSION['rtype'];
        }
        $this->db->where('type',$rtype);
        if(isset($_GET['term']) && $_GET['term'] != '') {
            $this->db->like('elements',$_GET['term']);
        }
        $query = $this->db->get('risk_factor_elements');
        $result = $query->result_array();
        foreach($result as $val) {
            $res = array();
            $res['id'] = $val['id'];
            $res['label'] = $val['elements'];
            $res['value'] = $val['elements'];
            $data[] = $res;
        }
        return $data;
    }

    function getTagId($tags) {
        $data = array();
        $exp = explode(',',$tags);
        foreach($exp as $val) {
            $this->db->where('input_type','tag');
            $this->db->where_in('name', $val);
            $query = $this->db->get('vital_symptoms');
            $result = $query->row();
            if($result) {
                $data[] = $result->id;
            } else {
                $insertTag = array();
                $insertTag['name'] = $val;
                $insertTag['input_type'] = 'tag';
                $insertTag['category'] = 'symptom';
                $this->db->insert('vital_symptoms', $insertTag);
                $insert_id = $this->db->insert_id();
                $data[] = $insert_id;
            }
        }
        return implode(',',$data);
    }

    function getRiskId($tags) {
        $data = array();
        $exp = explode(',',$tags);
        foreach($exp as $val) {
            $this->db->where('type',$_POST['type']);
            $this->db->where('elements', $val);
            $query = $this->db->get('risk_factor_elements');
            $result = $query->row();
            if($result) {
                $data[] = $result->id;
            } else {
                $insertTag = array();
                $insertTag['elements'] = $val;
                $insertTag['type'] = $_POST['type'];
                $insertTag['status'] = 1;
                $this->db->insert('risk_factor_elements', $insertTag);
                $insert_id = $this->db->insert_id();
                $data[] = $insert_id;
            }
        }
        return implode(',',$data);
    }

    function getRiskTagsById($id,$patientid) {
        $this->db->where('checkup_id', $id);
        $this->db->where('patient_id', $patientid);
        $query = $this->db->get('patient_risk');
        $checkupData = $query->row();
        
        $data = array();
        $exp = explode(',',$checkupData->risk);
        
        $this->db->where_in('id', $exp);
        $query = $this->db->get('risk_factor_elements');
        $result = $query->result_array();
        foreach($result as $val) {
            $data[] = $val['elements'];
        }
        //echo "<pre>"; print_r($data); exit;
        return implode(',',$data);
    }

    function getRiskById($id,$patientid) {
        $this->db->where('checkup_id', $id);
        $this->db->where('patient_id', $patientid);
        $query = $this->db->get('patient_risk');
        return $result = $query->row();
    }

    function getVitalandSymptoms($searchTerm = '') {
        if (!empty($searchTerm)) {
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
        }
        //$this->db->where('input_type != "tag"');
        $this->db->where('status', 1);
        $query = $this->db->get('vital_symptoms');
        return $query->result();
    }

    function getPatientinfoWithAddNewOption($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(10);
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        }
        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['serial_id'] . ')');
        }
        return $data;
    }

    function getTemplateOption($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
            $fetched_records = $this->db->get('form_templates');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->limit(10);
            $fetched_records = $this->db->get('form_templates');
            $users = $fetched_records->result_array();
        }
        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }
        return $data;
    }

    function getTemplateFields($tempid) {
        $this->db->select('vital_symptoms.input_type, vital_symptoms.input_options, template_fields.field_id, vital_symptoms.name, vital_symptoms.unit, vital_symptoms.category');
        $this->db->join('vital_symptoms', 'vital_symptoms.id=template_fields.field_id');
        $this->db->where('template_id', $tempid);
        //$this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $fetched_records = $this->db->get('template_fields');
        $users = $fetched_records->result_array();
        //echo "<pre>"; print_r($users); exit;
        
        return $users;
    }
    
}
