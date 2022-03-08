<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Formtemplate_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertTemplate($table,$data) {
        $this->db->insert($table, $data);
        return $insert_id = $this->db->insert_id();
    }

    function getTemplates() {
        $query = $this->db->get('form_templates');
        return $query->result();
    }

    function getTemplateById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('form_templates');
        return $query->row();
    }

    function updateTemplate($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('form_templates', $data);
    }

    function deleteFormtemplate($id) {
        $this->db->where('id', $id);
        $this->db->delete('form_templates');

        $this->db->where('template_id', $id);
        $this->db->delete('template_fields');
        return true;
    }

    function deleteTemplateFields($id) {
        $this->db->where('template_id', $id);
        $this->db->delete('template_fields');
        return true;
    }

    function getformTempById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('form_templates');
        return $query->row();
    }

    function getformFieldsById($id) {
        $this->db->where('template_id', $id);
        $query = $this->db->get('template_fields');
        return $query->result();
    }

    function getVitalandSymptoms($searchTerm = '') {
        if (!empty($searchTerm)) {
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
        }
        $this->db->where('status', 1);
        $query = $this->db->get('vital_symptoms');
        return $query->result();
    }
    
}
