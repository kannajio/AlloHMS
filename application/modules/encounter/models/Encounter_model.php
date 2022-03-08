<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Encounter_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getEncounter() {
        $this->db->select('in_patient.*,alloted_bed.bed_id,patient.name as username,patient.serial_id as patientid');
        $this->db->where('in_patient.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('in_patient.id', 'desc');
        $this->db->join('patient', 'patient.id = in_patient.patient_id');
        $this->db->join('alloted_bed', 'alloted_bed.patient = in_patient.patient_id','left');
        $query = $this->db->get('in_patient');
        return $query->result();
    }

    function getEncounterBysearch($search) {
        $this->db->order_by('in_patient.id', 'desc');
        
        $query = $this->db->select('in_patient.*,alloted_bed.bed_id,patient.name as username,patient.serial_id as patientid')
                ->from('in_patient')
                ->join('patient', 'patient.id = in_patient.patient_id')
                ->join('alloted_bed', 'alloted_bed.patient = in_patient.patient_id','left')
                ->where('in_patient.hospital_id', $this->session->userdata('hospital_id'))
                ->where("(patient.username LIKE '%" . $search . "%', patient.serial_id LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getEncounterByLimitBySearch($limit, $start, $search) {
        $this->db->order_by('in_patient.id', 'desc');
        $this->db->limit($limit, $start);
        
        $query = $this->db->select('in_patient.*,alloted_bed.bed_id,patient.name as username,patient.serial_id as patientid')
                ->from('in_patient')
                ->join('patient', 'patient.id = in_patient.patient_id')
                ->join('alloted_bed', 'alloted_bed.patient = in_patient.patient_id','left')
                ->where('in_patient.hospital_id', $this->session->userdata('hospital_id'))
                ->where("(patient.username LIKE '%" . $search . "%', patient.serial_id LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getEncounterById($id) {
        //echo $id; exit;
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('in_patient');
        return $query->row();
    }

    function getPatientById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('patient');
        return $query->row();
    }

    function getEncounterByLimit($limit, $start) {
        $this->db->select('in_patient.*,alloted_bed.bed_id,patient.name as username,patient.serial_id as patientid');
        
        $this->db->where('in_patient.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('in_patient.id', 'desc');
        $this->db->limit($limit, $start);
        $this->db->join('patient', 'patient.id = in_patient.patient_id');
        $this->db->join('alloted_bed', 'alloted_bed.patient = in_patient.patient_id','left');
        $query = $this->db->get('in_patient');
        return $query->result();
    }

    function insertIP($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        //echo "<pre>"; print_r($data2); exit;
        $this->db->insert('in_patient', $data2);
        $insert_id = $this->db->insert_id();
        if($insert_id) {
            return true;
        }
    }

    function updateIP($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('in_patient', $data);
    }

    function updateStatus($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('appointment', $data);
        return true;
    }

    function getdata($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('in_patient');
        return $query->row();
    }

    function deleteIp($id) {
        $this->db->where('id', $id);
        $this->db->delete('in_patient');
    }


    function getAppointmentBySearch($search) {
        $date = strtotime(date('Y-m-d'));
        
        $query = $this->db->select('appointment.*,(select token from patient_checkin where  patient_checkin.appointment_id = appointment.id limit 1) as token, patient.serial_id as serial_id')
                ->from('appointment')
                ->limit($limit, $start)
                ->order_by('id', 'desc')
                ->join('patient', 'patient.id = appointment.patient')
                ->where('date', $date)
                ->where('status', 'Confirmed')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR serial_id LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getAppointment() {
        $date = strtotime(date('Y-m-d'));
        $this->db->select('appointment.*,(select token from patient_checkin where  patient_checkin.appointment_id = appointment.id limit 1) as token, (select serial_id from patient where id = appointment.patient) as serial_id');
        $this->db->order_by('id', 'desc');
        $this->db->where('date', $date);
        $this->db->where('status', 'Confirmed');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('appointment');
        return $query->result();
    }

    function getAppointmentByLimitBySearch($limit, $start, $search) {
        $date = strtotime(date('Y-m-d'));
        $query = $this->db->select('appointment.*,(select token from patient_checkin where  patient_checkin.appointment_id = appointment.id limit 1) as token, patient.serial_id as serial_id')
                ->from('appointment')
                ->limit($limit, $start)
                ->order_by('id', 'desc')
                ->join('patient', 'patient.id = appointment.patient')
                ->where('date', $date)
                ->where('status', 'Confirmed')
                ->where('appointment.hospital_id', $this->session->userdata('hospital_id'))
                ->where("(appointment.id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR serial_id LIKE '%" . $search . "%' OR doctorname LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getAppointmentByLimit($limit, $start) {
        $date = strtotime(date('Y-m-d'));
        $this->db->select('appointment.*,(select token from patient_checkin where  patient_checkin.appointment_id = appointment.id limit 1) as token, (select serial_id from patient where id = appointment.patient) as serial_id');
        $this->db->order_by('id', 'desc');
        $this->db->where('date', $date);
        $this->db->where('status', 'Confirmed');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->limit($limit, $start);
        $query = $this->db->get('appointment');
        return $query->result();
        //echo $this->db->last_query(); exit;
    }

    function getAllAppointmentCount() {
        $date = strtotime(date('Y-m-d'));
        $this->db->select('*');
        $this->db->order_by('id', 'desc');
        $this->db->where("date = '".$date."' AND hospital_id = '".$this->session->userdata('hospital_id')."' AND (status = 'Confirmed' || status = 'Treated')");
        $query = $this->db->get('appointment');
        //$query->result();
        return $query->num_rows();
    }

    function getCheckinCount() {
        $date = strtotime(date('Y-m-d'));
        $this->db->select('*');
        $this->db->limit(1);
        $this->db->order_by('id', 'desc');
        $this->db->where("YEAR(created_at) = YEAR(NOW()) AND hospital_id = '".$this->session->userdata('hospital_id')."'");
        $query = $this->db->get('patient_checkin');
        return $query->result();
    }

    function insertOp($data) {
        $this->db->insert('patient_checkin', $data);
        $insert_id = $this->db->insert_id();
        if($insert_id) {
            return true;
        }
    }

    function checkPhoneNumber($id) {
        $this->db->where('id',$id);
        $query = $this->db->get('appointment');
        $appointment = $query->row();
        if($appointment) {
            $this->db->where('id',$appointment->patient);
            $query = $this->db->get('patient');
            $patient = $query->row();
            return $patient;
        } else {
            return false;
        }
        
    }

    function getOTPSettings($hid) {
        $this->db->where('hospital_id', $hid);
        $query = $this->db->get('settings');
        return $query->row();
    }

    function getSmsSettingsByGatewayName($hid,$name) {
        $this->db->where('hospital_id', $hid);
        $this->db->where('name', $name);
        $query = $this->db->get('sms_settings');
        return $query->row();
    }

    function checkDuplicate($id) {
        $this->db->where('patient_id', $id);
        $query = $this->db->get('in_patient');
        return $query->row();
    }

    function checkDuplicateId($pid,$id) {
        $this->db->where('patient_id', $pid);
        $this->db->where('id !=', $id);
        $query = $this->db->get('in_patient');
        return $query->row();
    }

}
