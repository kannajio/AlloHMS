<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 include("./vendor/autoload.php");

use Omnipay\Omnipay;
use Twilio\Rest\Client;

class Api extends MX_Controller {
    
    public $hospitalID;
    
    function __construct() {
        parent::__construct();
        $this->load->model('api/api_model');
        $this->load->library(array('ion_auth','form_validation'));
        require APPPATH . 'third_party/stripe/stripe-php2/init.php';
        $this->load->module('paypal');
 
        $this->load->model('doctor/doctor_model');
        $this->load->model('department/department_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('patient/patient_model');
        $this->load->model('prescription/prescription_model');
        $this->load->model('schedule/schedule_model');
        $this->load->model('auth/otpsms_model');
        $this->load->model('checkup/checkup_model');
        $this->load->model('risk/risk_model');
        $this->load->model('checkup/vitals_model');
        $this->load->model('checkup/symptoms_model');

        //$this->load->module('patient');
        //$this->load->module('sms');
        
       
        $this->load->model('donor/donor_model');
        $this->load->model('bed/bed_model');
        $this->load->model('lab/lab_model');
        $this->load->model('finance/finance_model');
        $this->load->model('finance/pharmacy_model');
        $this->load->model('sms/sms_model');
        // $postdata = file_get_contents("php://input");
        // $_POST = (array) json_decode($postdata);
    }
        
     public function authenticateNew() {
        $identity = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = false;
        $group = $this->input->post('group');
        $users = $this->db->get_where('users', array('email' => $identity))->row();
        $ion_user_id = $users->id;
        if (!empty($ion_user_id)) {
            if ($group == 'Doctor' || $group == 'doctor') {
                $doctor_details = $this->db->get_where('doctor', array('ion_user_id' => $ion_user_id))->row();
                $data['user_id'] = $doctor_details->id;
            } else {
                $patient_details = $this->db->get_where('patient', array('ion_user_id' => $ion_user_id))->row();
                $data['user_id'] = $patient_details->id;
            }
            $data['message'] = 'successfully logged in';
            $data['idToken'] = rand(1111, 9999);
            $data['ion_id'] = $ion_user_id;
            $data['expiresIn'] = 86400;
            $data['error'] = true;
            $data['hospital_id'] = $this->getHospitalID($data['ion_id']);
            echo json_encode($data);
        } else {
             $data['idToken'] = null;
            $data['ion_id'] = null;
            $data['expiresIn'] = null;
            $data['message'] = 'check email and password';
            echo json_encode($data);
        }
    }

    public function authenticate() {
        $identity = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = false;
        $group = $this->input->post('group');
        if ($this->ion_auth->login($identity, $password, $remember)) {
            $id = $this->ion_auth->get_user_id();
            $group_id = $this->db->get_where('users_groups', array('user_id' =>  $id))->row();
            $group2 = $this->db->get_where('groups', array('id' => $group_id->group_id))->row();
            if($group2->name == $group) {
               if($group == 'Doctor') {
                    $user_id = $this->db->get_where('doctor', array('ion_user_id' => $id))->row();
               } else {
                    $user_id = $this->db->get_where('patient', array('ion_user_id' => $id))->row();
               }
                $data['message'] = 'successfully logged in';
                $data['idToken'] = rand(1111,9999);
                $data['ion_id'] = $this->ion_auth->get_user_id();
                $data['user_id'] = $user_id->id;
                $data['expiresIn'] = 86400;
                $data['error'] = null;
                $data['hospital_id'] = $this->getHospitalID($data['ion_id']);
                echo json_encode($data);
            } else {
                $data['message'] = 'check email and password';
                echo json_encode($data);
            }
        } else {
            $data['email'] = $identity;
            $data['message'] = 'something went wrong';
            echo json_encode($data);
        }
    }
    
    //Patient Login Function
    function patientLogin() {
        $identity = $this->input->get('identity');
        $password = $this->input->get('password');
        $remember = (bool) $this->input->get('remember');
        $validate_data = array('identity' => $identity, 'password' => $password);
        $this->form_validation->set_data($validate_data);
        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {
            if ($this->ion_auth->login($identity, $password, $remember)) {
                $data['message'] = 'successfully logged in';
                $data['ion_id'] = $this->ion_auth->get_user_id();
                $data['hospital_id'] = $this->getHospitalID($data['ion_id']);
                echo json_encode($data);
            } else {
                $data['message'] = 'something went wrong';
                echo json_encode($data);
            }
        } else {
            $data['message'] = 'invalid';
            echo json_encode($data);
        }
    }
    
    //Function to logout
    function logout() {
        $logout = $this->ion_auth->logout();
        $data['message'] = 'invalid';
        echo json_encode($data);
    }
    
    //Get Profile Function
    function getProfile() {
        $id = $this->input->get('id');
        $data = $this->api_model->apiGetProfileById($id);
        
        echo json_encode($data);
    }
    
    function getPatientProfile() {
        $id = $this->input->get('id');
        $data = $this->db->get_where('patient', array('ion_user_id' => $id))->row();
        echo json_encode($data);
    }
    
    function getDoctorProfile() {
        $id = $this->input->get('id');
        $data = $this->db->get_where('doctor', array('ion_user_id' => $id))->row();
        echo json_encode($data);
    }
    


    //Update Profile Function
    function updateProfile() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $img_url = $this->input->post('img_url');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $department = $this->input->post('department');
        $profile = $this->input->post('profile');
        $ion_user_id = $this->input->post('ion_user_id');
        $hospital_id = $this->input->post('hospital_id');
        $data['profile'] = $this->api_model->apiGetProfileById($id);
        if ($data['profile']->email != $email) {
            if ($this->ion_auth->email_check($email)) {
                $data = 'emailExists';
                echo json_encode($data);
            }
        }
        $validate_data = array('name' => $name, 'password' => $password,'img_url' => $img_url, 'email' => $email,'department' => $department,'address' => $address,'ion_user_id' => $ion_user_id,'hospital_id' => $hospital_id,'profile' => $profile);
        $this->form_validation->set_data($validate_data);
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        if (!empty($password)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        $this->form_validation->set_rules('img_url', 'img_url', 'trim|required|xss_clean');
        $this->form_validation->set_rules('department', 'department', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', 'address', 'trim|required|xss_clean');
        $this->form_validation->set_rules('ion_user_id', 'ion_user_id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('hospital_id', 'hospital_id', 'trim|required|xss_clean');
        $this->form_validation->set_rules('profile', 'profile', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data = 'false';
            echo json_encode($data);
        } else {
            $data2 = array();
            $data2 = array(
                'name' => $name,
                'email' => $email,
                'img_url' => $img_url,
                'department' => $department,
                'address' => $address,
                'ion_user_id' => $ion_user_id,
                'hospital_id' => $hospital_id,
                'profile' => $profile,
            );
            $username = $name;
            $ion_user_id = $id;
            $group_id = $this->api_model->getUsersGroups($ion_user_id)->row()->group_id;
            $group_name = $this->api_model->getGroups($group_id)->row()->name;
            $group_name = strtolower($group_name);
            if (empty($password)) {
                $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
            } else {
                $password = $this->ion_auth_model->hash_password($password);
            }
            $this->api_model->updateIonUser($username, $email, $password, $ion_user_id);
            $this->api_model->updateProfile($ion_user_id, $data2, $group_name);
            $data = 'successful';
            echo json_encode($data);
        }
    }
    
    function updatePatientProfile() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $img_url = $this->input->post('img_url');

        $data['profile'] = $this->api_model->apiGetProfileById($id);
        $validate_data = array('name' => $name, 'password' => $password, 'email' => $email);
        $this->form_validation->set_data($validate_data);
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        if (!empty($password)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data = 'false';
            echo json_encode($data);
        } else {
            $data2 = array();
            $data2 = array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'img_url'=>$img_url,
            );
            $username = $name;
            $ion_user_id = $id;
            $group_id = $this->api_model->getUsersGroups($ion_user_id)->row()->group_id;
            $group_name = $this->api_model->getGroups($group_id)->row()->name;
            $group_name = strtolower($group_name);
            if (empty($password)) {
                $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
            } else {
                $password = $this->ion_auth_model->hash_password($password);
            }
            $this->api_model->updateIonUser($username, $email, $password, $ion_user_id);
            $this->api_model->updateProfile($ion_user_id, $data2, $group_name);
            $data = 'successful';
            echo json_encode($data);
        }
    }
    function updateDoctorProfile() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $department = $this->input->post('department');
        $phone = $this->input->post('phone');
        $img_url = $this->input->post('img_url');

        $data['profile'] = $this->api_model->apiGetProfileById($id);
        $validate_data = array('name' => $name, 'password' => $password, 'email' => $email);
        $this->form_validation->set_data($validate_data);
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        if (!empty($password)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data = 'failed';
            echo json_encode($data);
        } else {
            $data2 = array();
            $data2 = array(
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'department' => $department,
                'img_url' => $img_url,
            );
            $username = $name;
            $ion_user_id = $id;
            $group_id = $this->api_model->getUsersGroups($ion_user_id)->row()->group_id;
            $group_name = $this->api_model->getGroups($group_id)->row()->name;
            $group_name = strtolower($group_name);
            if (empty($password)) {
                $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
            } else {
                $password = $this->ion_auth_model->hash_password($password);
            }
            $this->api_model->updateIonUser($username, $email, $password, $ion_user_id);
            $this->api_model->updateProfile($ion_user_id, $data2, $group_name);
            $data = 'successful';
            echo json_encode($data);
        }
    }    
    //Get Donor Info Function
    function getDonor() {
        //user ion id
        $id = $this->input->get('user_ion_id');
        $this->hospitalID = $this->getHospitalID($id);
        $data['donors'] = $this->api_model->getDonor($this->hospitalID);
        $data['groups'] = $this->api_model->getBloodBank($this->hospitalID);
        $data['message'] = 'successful';
        echo json_encode($data);
    }
    
    //Get Patient Specific Report
    function myReport() {
        $userID = $this->input->get('user_ion_id');
        $this->hospitalID = $this->getHospitalID($userID);
        $id = $this->input->get('id');
        $data['report'] = $this->api_model->getReportById($id, $this->hospitalID);
        $data['message'] = 'successful';
        echo json_encode($data);
    }
    
    
    //Get Patient all reports
    function myReports() {
        $data['reports'] = array();
        $userId = $this->input->get('user_ion_id');
        $this->hospitalID = $this->getHospitalID($userId);
        $reports = $this->api_model->getReport($this->hospitalID);
        foreach($reports as $report) {
            if($userId ==  explode('*', $report->patient)[1]) {
                array_push($data['reports'], $report);
            }
        }
        echo json_encode($data);
    }
    
    //Get Patient Document
    function myDocument() {
            $patient_ion_id = $this->input->get('id');
            $this->hospitalID = $this->getHospitalID($patient_ion_id);
            $patient_id = $this->api_model->getPatientByIonUserId($patient_ion_id, $this->hospitalID)->id;
            $data['files'] = $this->api_model->getPatientMaterialByPatientId($patient_id, $this->hospitalID);
            $data['message'] = 'successful';
            echo json_encode($data);
    }
    
    //Get Patient Case List Function
    function myCaseList() {
            $patient_ion_id = $this->input->get('id');
            $this->hospitalID = $this->getHospitalID($patient_ion_id);
            $patient_id = $this->api_model->getPatientByIonUserId($patient_ion_id, $this->hospitalID)->id;
            $data['medical_histories'] = $this->api_model->getMedicalHistoryByPatientId($patient_id, $this->hospitalID);
            $data['message'] = 'successful';
            echo json_encode($data);
    }
    
    //Get Prescription Function
    function myPrescription() {
            $patient_ion_id = 764;
            $this->hospitalID = $this->getHospitalID($patient_ion_id);
            $patient_id = $this->api_model->getPatientByIonUserId($patient_ion_id, $this->hospitalID)->id;
            $data = $this->api_model->getPrescriptionByPatientId($patient_id, $this->hospitalID);
            echo json_encode($data);
    }
    
    function deleteAppointment() {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('appointment');
        echo json_encode('success');
    }
    
    //Delete Prescription
    function deletePrescription() {
        $id = $this->input->get('id');
        $patient_ion_id = 764;
        $this->hospitalID = $this->getHospitalID($patient_ion_id);
        $data['prescription'] = $this->api_model->getPrescriptionById($id, $this->hospitalID);
        if (!empty($data['prescription']->hospital_id)) {
            if ($data['prescription']->hospital_id != $this->hospitalID) {
                $data['message'] = 'failed';
                echo json_encode($data);
            } else {
                $this->api_model->deletePrescription($id);
                $data['message'] = 'successful';
                echo json_encode($data);
            }
        } else {
            $data['message'] = 'failed';
            echo json_encode($data);
        }
    }
    //Get Lab By filtering
    function myLab() {
        $userId = $this->input->get('user_ion_id');
        $group = $this->input->get('group');
        $this->hospitalID = $this->getHospitalID($userId);
        $data['labs'] = array();
        $labs = $this->api_model->getLab($this->hospitalID);
        if ($group == 'Patient') {
            $patient_user_id = $userId;
            $patient_id = $this->api_model->getPatientByIonUserId($patient_user_id, $this->hospitalID)->id;
        }
        foreach ($labs as $lab) {
            if ($patient_id == $lab->patient) {
                $date = date('d-m-y', $lab->date);
                //$options2 = '<a class="btn btn-xs invoicebutton" title="' . lang('lab') . '" style="color: #fff;" href="lab/invoice?id=' . $lab->id . '"><i class="fa fa-file"></i> ' . lang('') . '</a>';
                $doctor_info = $this->api_model->getDoctorById($lab->doctor, $this->hospitalID);
                if (!empty($doctor_info)) {
                    $doctor = $doctor_info->name;
                } else {
                    if (!empty($lab->doctor_name)) {
                        $doctor = $lab->doctor_name;
                    } else {
                        $doctor = ' ';
                    }
                }
                $patient_info = $this->api_model->getPatientById($lab->patient, $this->hospitalID);
                if (!empty($patient_info)) {
                    $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
                } else {
                    $patient_details = ' ';
                }
                $data['labs'] = array(
                    $lab->id,
                    $patient_info->name,
                    $patient_info->address,
                    $patient_info->phone,
                    $date,
                );
            }
        }
        echo json_encode($data);
    }
        //Get Invoice Function
    function invoice() {
        $userId = $this->input->get('user_ion_id');
        $this->hospitalID = $this->getHospitalID($userId);
        $id = $this->input->get('invoice_id');
        $data['settings'] = $this->api_model->getSettings($this->hospitalID);
        $data['lab'] = $this->api_model->getLabById($id, $this->hospitalID);

        $data['message'] = 'successful';
        
       echo json_encode($data);
    }
    
    //to view a prescription
    function viewPrescription() {
        $userId = $this->input->get('user_ion_id');
        $this->hospitalID = $this->getHospitalID($userId);
        $id = $this->input->get('id');
        $data['prescription'] = $this->api_model->getPrescriptionById($id, $this->hospitalID);

        if (!empty($data['prescription']->hospital_id)) {
            if ($data['prescription']->hospital_id != $this->hospitalID) {
                $data['message'] = 'invalid';
                echo json_encode($data);
            } else {
                $data['settings'] = $this->api_model->getSettings($this->hospitalID);
                $data['message'] = 'successful';
                echo json_encode($data);
            }
        } else {
            $data['message'] = 'true';
                echo json_encode($data);
        }
    }
    
    //Add New Appointment Function
    public function addNewAppointment() {
                $id = $this->input->post('id');
                $patient = $this->input->post('patient');
                $doctor = $this->input->post('doctor');
                $date=$this->input->post('date');
                $time_slot=$this->input->post('time_slot');
                $remarks=$this->input->post('remarks');
                $sms=$this->input->post('sms');
                $status=$this->input->post('status');
                $redirect=$this->input->post('redirect');
                $request=$this->input->post('request');
                $p_name=$this->input->post('p_name');
                $p_email=$this->input->post('p_email');
                $p_phone=$this->input->post('p_phone');
                $p_age=$this->input->post('p_age');
                $p_gender=$this->input->post('p_gender');
                $name=$this->input->post('name');
                $ion_user_id=$this->findDoctorIonId($doctor);
        $this->hospitalID = $this->getHospitalID($ion_user_id);
        if (!empty($date)) {
            $date = strtotime($date);
        }


        $time_slot = $time_slot;

        $time_slot_explode = explode('To', $time_slot);

        $s_time = trim($time_slot_explode[0]);
        $e_time = trim($time_slot_explode[1]);


        $remarks = $remarks;

        $sms = $sms;

        $status = $status;

        $redirect = $redirect;

        $request = $request;

        if (empty($request)) {
            $request = '';
        }


        $user = $ion_user_id;

        if ($this->ion_auth->in_group(array('Patient'))) {
            $user = '';
        }



        if ((empty($id))) {
            $add_date = date('m/d/y');
            $registration_time = time();
            $patient_add_date = $add_date;
            $patient_registration_time = $registration_time;
        } else {
            $add_date = $this->api_model->getAppointmentById($id, $this->hospitalID)->add_date;
            $registration_time = $this->api_model->getAppointmentById($id, $this->hospitalID)->registration_time;
        }

        $s_time_key = $this->getArrayKey($s_time);


        $p_name = $p_name;
        $p_email = $p_email;
        if (empty($p_email)) {
            $p_email = $p_name . '-' . rand(1, 1000) . '-' . $p_name . '-' . rand(1, 1000) . '@example.com';
        }
        if (!empty($p_name)) {
            $password = $p_name . '-' . rand(1, 100000000);
        }
        $p_phone = $p_phone;
        $p_age = $p_age;
        $p_gender = $p_gender;
        $patient_id = rand(10000, 1000000);
        
        
        $validate_data = array(
            'p_name' => $p_name, 
            'p_phone' => $p_phone,
            'patient' => $patient,
            'doctor' => $doctor,
            'date' => $date,
            's_time' => $s_time,
            'e_time' => $e_time,
            'remarks' => $remarks
         );
        
        $this->load->library('form_validation');
        $this->form_validation->set_data($validate_data);

        if ($patient == 'add_new') {
            $this->form_validation->set_rules('p_name', 'Patient Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('p_phone', 'Patient Phone', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        }

        // Validating Name Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field
        $this->form_validation->set_rules('doctor', 'Doctor', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        // Validating Email Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('s_time', 'Start Time', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('e_time', 'End Time', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|min_length[1]|max_length[1000]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
                // $data['patients'] = $this->api_model->getPatient($this->hospitalID);
                // $data['doctors'] = $this->api_model->getDoctor($this->hospitalID);
                // $data['settings'] = $this->api_model->getSettings($this->hospitalID);
                // $data['message'] = "invalid";
                // return $data;
                echo json_encode($data['message'] = 'failed');
        } else {

            if ($patient == 'add_new') {

                $limit = $this->api_model->getLimit($this->hospitalID);
                if ($limit <= 0) {
                    $data['message'] = "Limit Excessed";
                    return $data;
                }

                $data_p = array(
                    'patient_id' => $patient_id,
                    'name' => $p_name,
                    'email' => $p_email,
                    'phone' => $p_phone,
                    'sex' => $p_gender,
                    'age' => $p_age,
                    'add_date' => $patient_add_date,
                    'registration_time' => $patient_registration_time,
                    'how_added' => 'from_appointment'
                );
                $username = $p_name;
                // Adding New Patient
                if ($this->ion_auth->email_check($p_email)) {
                    $data['message'] = "Email exits";
                    return $data;
                } else {
                    $dfg = 5;
                    $this->ion_auth->register($username, $password, $p_email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $p_email))->row()->id;
                    $this->api_model->insertPatient($data_p, $this->hospitalID);
                    $patient_user_id = $this->db->get_where('patient', array('email' => $p_email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->api_model->updatePatient($patient_user_id, $id_info);
                    $this->api_model->addHospitalIdToIonUser($ion_user_id, $this->hospitalID);
                }

                $patient = $patient_user_id;
                //    }
            }

            $patient_phone = $this->api_model->getPatientById($patient, $this->hospitalID)->phone;
            
            $temp_phone = str_replace('+','',$patient_phone);

            if (empty($id)) {
                $room_id = 'hms-meeting-' . $temp_phone . '-' . rand(10000, 1000000) . '-' . $this->hospital_id;
                $live_meeting_link = 'https://meet.jit.si/' . $room_id;
            } else {
                $appointment_details = $this->api_model->getAppointmentById($id);
                $room_id = $appointment_details->room_id;
                $live_meeting_link = $appointment_details->live_meeting_link;
            }



            //$error = array('error' => $this->upload->display_errors());
            $patientname = $this->api_model->getPatientById($patient, $this->hospitalID)->name;
            $doctorname = $this->api_model->getDoctorById($doctor, $this->hospitalID)->name;
            $data = array();
            $data = array(
                'patient' => $patient,
                'patientname' => $patientname,
                'doctor' => $doctor,
                'doctorname' => $doctorname,
                'date' => $date,
                's_time' => $s_time,
                'e_time' => $e_time,
                'time_slot' => $time_slot,
                'remarks' => $remarks,
                'add_date' => $add_date,
                'registration_time' => $registration_time,
                'status' => $status,
                's_time_key' => $s_time_key,
                'user' => $user,
                'request' => $request,
                'room_id' => $room_id,
                'live_meeting_link' => $live_meeting_link
            );
            $username = $name;
            if (empty($id)) {     // Adding New department
                $this->api_model->insertAppointment($data, $this->hospitalID);
                /* if (!empty($sms)) {
                  $this->sms->sendSmsDuringAppointment($patient, $doctor, $date, $s_time, $e_time);
                  } */
                $patient_doctor = $this->api_model->getPatientById($patient, $this->hospitalID)->doctor;
                $patient_doctors = explode(',', $patient_doctor);

                if (!in_array($doctor, $patient_doctors)) {
                    $patient_doctors[] = $doctor;
                    $doctorss = implode(',', $patient_doctors);
                    $data_d = array();
                    $data_d = array('doctor' => $doctorss);
                    $this->api_model->updatePatient($patient, $data_d);
                }
                $this->sendSmsDuringAppointment($id, $data, $patient, $doctor, $status);
            } else { // Updating department
                $previous_status = $this->api_model->getAppointmentById($id, $this->hospitalID)->status;
                if ($previous_status != "Confirmed") {
                    if ($status == "Confirmed") {
                        $this->sendSmsDuringAppointment($id, $data, $patient, $doctor, $status);
                    }
                }
                $this->api_model->updateAppointment($id, $data);
            }
            $data['message'] = "invalid";
            echo json_encode($data);
        }
    }
    
    
    /* For Flutter APP */
    public function addAppointment() {
                $id = $this->input->post('id'); 
                $patient = $this->input->post('patient');
                $doctor = $this->input->post('doctor');
                $date=$this->input->post('date');
                $time_slot=$this->input->post('time_slot');
                $status=$this->input->post('status');
                $remarks=$this->input->post('remarks');
                $user_type = $this->input->post('user_type');

                if($user_type == 'patient') {
                    $ion_user_id= $this->findPatientIonId($patient);
                } else {
                    $ion_user_id = $this->findDoctorIonId($doctor);
                }

        $this->hospitalID = $this->getHospitalID($ion_user_id);
        if (!empty($date)) {
            $date = strtotime($date);
        }

        $time_slot = $time_slot;
        $time_slot_explode = explode('To', $time_slot);
        $s_time = trim($time_slot_explode[0]);
        $e_time = trim($time_slot_explode[1]);

            $patient_phone = $this->api_model->getPatientById($patient, $this->hospitalID)->phone;
            $add_date = date('m/d/y');
            $registration_time = time();
                $temp_phone = str_replace('+','',$patient_phone);
                $temp_phone = str_replace('.','',$temp_phone);
                $room_id = 'hms-meeting-' . $temp_phone . '-' . rand(10000, 1000000) . '-' . $this->hospital_id;
                $live_meeting_link = 'https://meet.jit.si/' . $room_id;

            //$error = array('error' => $this->upload->display_errors());
            $patientname = $this->api_model->getPatientById($patient, $this->hospitalID)->name;
            $doctorname = $this->api_model->getDoctorById($doctor, $this->hospitalID)->name;
            $data = array();
            $data = array(
                'patient' => $patient,
                'patientname' => $patientname,
                'doctor' => $doctor,
                'doctorname' => $doctorname,
                'date' => $date,
                's_time' => $s_time,
                'e_time' => $e_time,
                'time_slot' => $time_slot,
                'add_date' => $add_date,
                'remarks' => $remarks,
                'registration_time' => $registration_time,
                'status' => $status,
                's_time_key' => $s_time_key,
                'user' => $user,
                'room_id' => $room_id,
                'live_meeting_link' => $live_meeting_link
            );
            $username = $name;
            if (empty($id)) {  
// Adding New department
                $this->api_model->insertAppointment($data, $this->hospitalID);
                /* if (!empty($sms)) {
                  $this->sms->sendSmsDuringAppointment($patient, $doctor, $date, $s_time, $e_time);
                  } */
                $patient_doctor = $this->api_model->getPatientById($patient, $this->hospitalID)->doctor;
                $patient_doctors = explode(',', $patient_doctor);
                if (!in_array($doctor, $patient_doctors)) {
                    $patient_doctors[] = $doctor;
                    $doctorss = implode(',', $patient_doctors);
                    $data_d = array();
                    $data_d = array('doctor' => $doctorss);
                    $this->api_model->updatePatient($patient, $data_d);
                }
                //$this->sendSmsDuringAppointment($id, $data, $patient, $doctor, $status);
                // echo $ion_user_id;
                // die();
            } else { // Updating department
                $previous_status = $this->api_model->getAppointmentById($id, $this->hospitalID)->status;
                if ($previous_status != "Confirmed") {
                    if ($status == "Confirmed") {
                        $this->sendSmsDuringAppointment($id, $data, $patient, $doctor, $status);
                    }
                }
                $this->api_model->updateAppointment($id, $data);
            }
            $data['message'] = "success";
            echo json_encode($data);
    }

    
    public function updateAppointment() {
                $id = $this->input->post('id'); 
                $patient = $this->input->post('patient');
                $doctor = $this->input->post('doctor');
                $date=$this->input->post('date');
                $time_slot=$this->input->post('time_slot');
                $status=$this->input->post('status');
                $remarks=$this->input->post('remarks');
                $user_type = $this->input->post('user_type');
                
                if($user_type == 'patient') {
                    $ion_user_id= $this->findPatientIonId($patient);
                } else {
                    $ion_user_id = $this->findDoctorIonId($doctor);
                }
                
        $this->hospitalID = $this->getHospitalID($ion_user_id);
        
        if (!empty($date)) {
            $date = strtotime($date);
        }


        $time_slot = $time_slot;

        $time_slot_explode = explode('To', $time_slot);

        $s_time = trim($time_slot_explode[0]);
        $e_time = trim($time_slot_explode[1]);
    

            $patient_phone = $this->api_model->getPatientById($patient, $this->hospitalID)->phone;
            $add_date = date('m/d/y');
            $registration_time = time();

$temp_phone = str_replace('+','',$patient_phone);
$temp_phone = str_replace('.','',$temp_phone);
                $room_id = 'hms-meeting-' . $temp_phone . '-' . rand(10000, 1000000) . '-' . $this->hospital_id;
                $live_meeting_link = 'https://meet.jit.si/' . $room_id;

            //$error = array('error' => $this->upload->display_errors());
            $patientname = $this->api_model->getPatientById($patient, $this->hospitalID)->name;
            $doctorname = $this->api_model->getDoctorById($doctor, $this->hospitalID)->name;
            $data = array();
            $data = array(
                'patient' => $patient,
                'patientname' => $patientname,
                'doctor' => $doctor,
                'doctorname' => $doctorname,
                'date' => $date,
                's_time' => $s_time,
                'e_time' => $e_time,
                'time_slot' => $time_slot,
                'add_date' => $add_date,
                'remarks' => $remarks,
                'registration_time' => $registration_time,
                'status' => $status,
                's_time_key' => $s_time_key,
                'user' => $user,
                'room_id' => $room_id,
                'live_meeting_link' => $live_meeting_link
            );
            $username = $name;
            

            if ($id) {  
                $previous_status = $this->api_model->getAppointmentById($id, $this->hospitalID)->status;
                if ($previous_status != "Confirmed") {
                    if ($status == "Confirmed") {
                        $this->sendSmsDuringAppointment($id, $data, $patient, $doctor, $status, $this->hospitalID);
                    }
                }
                $this->api_model->updateAppointment($id, $data);

                /* if (!empty($sms)) {
                  $this->sms->sendSmsDuringAppointment($patient, $doctor, $date, $s_time, $e_time);
                  } */

                $patient_doctor = $this->api_model->getPatientById($patient, $this->hospitalID)->doctor;

                $patient_doctors = explode(',', $patient_doctor);



                if (!in_array($doctor, $patient_doctors)) {
                    $patient_doctors[] = $doctor;
                    $doctorss = implode(',', $patient_doctors);
                    $data_d = array();
                    $data_d = array('doctor' => $doctorss);
                    $this->api_model->updatePatient($patient, $data_d);
                }
                //$this->sendSmsDuringAppointment($id, $data, $patient, $doctor, $status);
 //                                                               echo $ion_user_id;
//die();
            }
            
            $data['message'] = "success";
            echo json_encode($data);
    }
    
    public function getAppointmentById() {
        $id = $this->input->get('id');
        $appointment = $this->api_model->getAppointmentByIdOnly($id);
        $data = [
                        "id" => $appointment->id,
                        "patient_name" => $appointment->patientname,
                        "doctor_name" => $appointment->doctorname,
                        "patient" => $appointment->patient,
                        "doctor" => $appointment->doctor,
                        "date" => date('d-m-Y', $appointment->date),
                        "remarks" => $appointment->remarks,
                        "status" => $appointment->status,
                        'jitsi_link' => $appointment->room_id,
                        'start_time' => $appointment->s_time,
                        'end_time' => $appointment->e_time
            ];
        echo json_encode($data);
    }
    public function getDepartment() {
       // $id = $this->input->get('id');
        $appointment = $this->api_model->getDepartment();
       
        echo json_encode($appointment);
    }
    function sendSmsDuringAppointment($id, $data, $patient, $doctor, $status, $hospitalID) {
        //sms
        $this->hospitalID = $hospitalID;
        $set['settings'] = $this->api_model->getSettings($this->hospitalID);
        $patientdetails = $this->api_model->getPatientById($patient, $this->hospitalID);
        $doctordetails = $this->api_model->getDoctorById($doctor, $this->hospitalID);
        if (empty($id)) {
            // if ($status != 'Confirmed') {
            //     $autosms = $this->api_model->getAutoSmsByType('appoinment_creation', $this->hospitalID);
            //     $autoemail = $this->api_model->getAutoEmailByType('appoinment_creation', $this->hospitalID);
            // } else {
            //     $autosms = $this->api_model->getAutoSmsByType('appoinment_confirmation', $this->hospitalID);
            //     $autoemail = $this->api_model->getAutoEmailByType('appoinment_confirmation', $this->hospitalID);
            // }
        } else {

            // $autosms = $this->api_model->getAutoSmsByType('appoinment_confirmation', $this->hospitalID);
            // $autoemail = $this->api_model->getAutoEmailByType('appoinment_confirmation', $this->hospitalID);
        }
        $message = $autosms->message;
        $to = $patientdetails->phone;
        $name1 = explode(' ', $patientdetails->name);
        if (!isset($name1[1])) {
            $name1[1] = null;
        }
        $data1 = array(
            'firstname' => $name1[0],
            'lastname' => $name1[1],
            'name' => $patientdetails->name,
            'doctorname' => $doctordetails->name,
            'appoinmentdate' => date('d-m-Y', $data['date']),
            'time_slot' => $data['time_slot'],
            'hospital_name' => $set['settings']->system_vendor
        );

        if ($autosms->status == 'Active') {
            $messageprint = $this->parser->parse_string($message, $data1);

            $data2[] = array($to => $messageprint);
            $this->sendSms($to, $message, $data2);
        }
        //end
        //email
        // $autoemail = $this->email_model->getAutoEmailByType('payment');
        if ($autoemail->status == 'Active') {
            $emailSettings = $this->api_model->getEmailSettings($this->hospitalID);
            $message1 = $autoemail->message;
            $messageprint1 = $this->parser->parse_string($message1, $data1);
            $this->email->from($emailSettings->admin_email);
            $this->email->to($patientdetails->email);
            $this->email->subject(lang('appointment'));
            $this->email->message($messageprint1);
            $this->email->send();
        }

        //end
    }
    
    //Add Patient Material Function
    function addPatientMaterial() {
        $userID = $this->input->post('user_ion_id');
        $this->hospitalID = $this->getHospitalID($userID);
        $title = $this->input->post('title');
        $patient_id = $this->input->post('patient');
        $img_url = $this->input->post('img_url');
        $group = $this->input->post('group');
        $date = time();
        //$redirect = $this->input->post('redirect');

        /*if ($this->ion_auth->in_group(array('Patient'))) {
            if (empty($patient_id)) {
                $current_patient = $this->ion_auth->get_user_id();
                $patient_id = $this->api_model->getPatientByIonUserId($current_patient, $this->hospitalID)->id;
            }
        }*/
        if ($group == 'Patient') {
            if (empty($patient_id)) {
                $current_patient = $userID;
                $patient_id = $this->api_model->getPatientByIonUserId($current_patient, $this->hospitalID)->id;
            }
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $data2['message'] = 'invalid';
            echo json_encode($data2);
        } else {

            if (!empty($patient_id)) {
                $patient_details = $this->api_model->getPatientById($patient_id, $this->hospitalID);
                $patient_name = $patient_details->name;
                $patient_phone = $patient_details->phone;
                $patient_address = $patient_details->address;
            } else {
                $patient_name = 0;
                $patient_phone = 0;
                $patient_address = 0;
            }


            $file_name = $_FILES['img_url']['name'];
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 1;
            foreach ($file_name_pieces as $piece) {
                if ($count !== 1) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "48000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "10000",
                'max_width' => "10000"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'url' => $img_url,
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
                    'patient_address' => $patient_address,
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
            } else {
                $data = array();
                $data = array(
                    'date' => $date,
                    'title' => $title,
                    'patient' => $patient_id,
                    'patient_name' => $patient_name,
                    'patient_address' => $patient_address,
                    'patient_phone' => $patient_phone,
                    'date_string' => date('d-m-y', $date),
                );
                //$this->session->set_flashdata('feedback', lang('upload_error'));
                $data['message'] = "error";
            }

            $this->api_model->insertPatientMaterial($data, $this->hospitalID);
            //$this->session->set_flashdata('feedback', lang('added'));

            $data2['message'] = 'successful';
            echo json_encode($data2);
        }
    }
    
    
    function patientAllInvoices() {
        $id = $this->input->get('id');
        //$patient_ion_id = $this->input->get('id');
        $patient_ion_id = $this->findPatientIonId($id);
        $this->hospitalID = $this->getHospitalID($patient_ion_id);
        $patient = $this->api_model->getPatientByIonUserId($patient_ion_id, $this->hospitalID)->id;
        $data = $this->api_model->getPaymentByPatientId($patient, $this->hospitalID);
        echo json_encode($data);
    }
    
    function paymentGateway() {
        $id = $this->input->get('id');
        //$patient_ion_id = $this->input->get('id');
        $patient_ion_id = $this->findPatientIonId($id);
        $this->hospitalID = $this->getHospitalID($patient_ion_id);
        $patient = $this->api_model->getPatientByIonUserId($patient_ion_id, $this->hospitalID)->id;
        $settings = $this->api_model->getSettings($this->hospitalID);
        $data = $this->api_model->getGatewayByName($settings->payment_gateway, $this->hospitalID);
        echo json_encode($data);
    }
    
    
    
    //Patient payment history
    function myPaymentHistory() {
        $id = $this->input->get('id');
        //$patient_ion_id = $this->input->get('id');
        $patient_ion_id = $this->findPatientIonId($id);
        $this->hospitalID = $this->getHospitalID($patient_ion_id);
        $patient = $this->api_model->getPatientByIonUserId($patient_ion_id, $this->hospitalID)->id;
      //  $data['settings'] = $this->api_model->getSettings($this->hospitalID);
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 86399;
        }

        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;

        if (!empty($date_from)) {
            $data['payments'] = $this->api_model->getPaymentByPatientIdByDate($patient, $date_from, $date_to, $this->hospitalID);
            $data['deposits'] = $this->api_model->getDepositByPatientIdByDate($patient, $date_from, $date_to, $this->hospitalID);
            $data['gateway'] = $this->api_model->getGatewayByName($data['settings']->payment_gateway, $this->hospitalID);
        } else {
            $data['payments'] = $this->api_model->getPaymentByPatientId($patient, $this->hospitalID);
         //   $data['pharmacy_payments'] = $this->api_model->getPharmacyPaymentByPatientId($patient, $this->hospitalID);
         //   $data['ot_payments'] = $this->api_model->getOtPaymentByPatientId($patient, $this->hospitalID);
         //   $data['deposits'] = $this->api_model->getDepositByPatientId($patient, $this->hospitalID);
         //   $data['gateway'] = $this->api_model->getGatewayByName($data['settings']->payment_gateway, $this->hospitalID);
        }



      //  $data['patient'] = $this->api_model->getPatientByid($patient, $this->hospitalID);
     //   $data['settings'] = $this->api_model->getSettings($this->hospitalID);


        $data['message'] = 'successful';
        echo json_encode($data);
    }
    
    //Patient Deposit Function
    function deposit() {
        


        //$id = $this->input->post('id');
        $patient_id = $this->input->post('patient_id');

        $group = $this->input->post('group');
        
        
        
        $userID = $this->findPatientIonId($patient_id);
                                

        $this->hospitalID = $this->getHospitalID($userID);
        



        if ($group == 'Patient' || $group == 'patient') {
            $patient_ion_id = $userID;
            $patient = $this->api_model->getPatientByIonUserId($patient_ion_id, $this->hospitalID)->id;
        } else {
            $data['message'] = 'undefined_patient_id';
            echo json_encode($data);
        }

        


        $payment_id = $this->input->post('payment_id');
        $date = time();

        $deposited_amount = $this->input->post('deposited_amount');

        $deposit_type = $this->input->post('deposit_type');

        if ($deposit_type != 'Card') {
            $data['message'] = 'undefined_payment_type';
            echo json_encode($data);
        }

        $user = $userID;

        
            $data = array();
            $data = array('patient' => $patient,
                'date' => $date,
                'payment_id' => $payment_id,
                'deposited_amount' => $deposited_amount,
                'deposit_type' => $deposit_type,
                'user' => $user
            );

                    
                    


            if (empty($id)) {
                if ($deposit_type == 'Card') {
                    $payment_details = $this->api_model->getPaymentById($payment_id, $this->hospitalID);
                    $gateway = $this->api_model->getSettings($this->hospitalID)->payment_gateway;
                    if ($gateway == 'PayPal') {
                        $card_type = $this->input->post('card_type');
                        $card_number = $this->input->post('card_number');
                        $expire_date = $this->input->post('expire_date');
                        $cvv = $this->input->post('cvv_number');

                        $all_details = array(
                            'patient' => $payment_details->patient,
                            'date' => $payment_details->date,
                            'amount' => $payment_details->amount,
                            'doctor' => $payment_details->doctor_name,
                            'discount' => $payment_details->discount,
                            'flat_discount' => $payment_details->flat_discount,
                            'gross_total' => $payment_details->gross_total,
                            'status' => 'unpaid',
                            'patient_name' => $payment_details->patient_name,
                            'patient_phone' => $payment_details->patient_phone,
                            'patient_address' => $payment_details->patient_address,
                            'deposited_amount' => $deposited_amount,
                            'payment_id' => $payment_details->id,
                            'card_type' => $card_type,
                            'card_number' => $card_number,
                            'expire_date' => $expire_date,
                            'cvv' => $cvv,
                            'from' => 'patient_payment_details',
                            'user' => $user,
                            'cardholdername' => $this->input->post('cardholder')
                        );
                    
                        
                        $this->paymentPaypal($all_details);
                    } elseif ($gateway == 'Paystack') {
                        $ref = date('Y') . '-' . rand() . date('d') . '-' . date('m');
                        $amount_in_kobo = $deposited_amount;
                        $this->load->module('paystack');
                        $this->paystack->paystack_standard($amount_in_kobo, $ref, $patient, $payment_id, $user, '2');
                    } elseif ($gateway == 'Stripe') {

                        $stripe = $this->db->get_where('paymentGateway', array('name =' => 'Stripe'))->row();
                        
                        $card_number = $this->input->post('card_number');
                        $expire_date = $this->input->post('expire_date');
                        $cvv = $this->input->post('cvv_number');
                        
                        $exp = explode('/',$expire_date);
                        

                        
                        $stripe2 = new \Stripe\StripeClient($stripe->secret);
                        $response = $stripe2->tokens->create([
                          'card' => [
                            'number' => $card_number,
                            'exp_month' => trim($exp[0]," "),
                            'exp_year' => trim($exp[1]," "),
                            'cvc' => $cvv,
                          ],
                        ]);
                        //$token = $this->input->post('token');

                        $stripe3 = new \Stripe\StripeClient($stripe->secret);
                        $charge = $stripe3->charges->create([
                          'amount' => $deposited_amount * 100,
                          'currency' => 'usd',
                          'source' => $response['id'],
                        ]);
                        // \Stripe\Stripe::setApiKey($stripe->secret);
                        // $charge = \Stripe\Charge::create(array(
                        //             "amount" => $deposited_amount * 100,
                        //             "currency" => "usd",
                        //             "source" => $response['id']
                        // ));
                        $chargeJson = $charge->jsonSerialize();
                         if ($chargeJson['status'] == 'succeeded') {
                            $data1 = array(
                                'date' => $date,
                                'patient' => $patient,
                                'payment_id' => $payment_id,
                                'deposited_amount' => $deposited_amount,
                                'gateway' => 'Stripe',
                                'user' => $user,
                                'hospital_id' => $this->hospitalID
                            );
                            $this->api_model->insertDeposit($data1, $this->hospitalID);
                            $message = 'successful';
                        } else {
                            $message = 'failed';
                        }
                      //  redirect("finance/invoice?id=" . "$inserted_id");
                        echo json_encode($message);
                    } elseif ($gateway == 'Pay U Money') {
                        redirect("payu/check?deposited_amount=" . "$deposited_amount" . '&payment_id=' . $payment_id);
                    } else {
                        $message = 'payment_failed_no_gateway_selected';
                        echo json_encode($message);
                    }
                } else {
                    $this->api_model->insertDeposit($data, $this->hospitalID);
                    $message = 'successful';
                    echo json_encode($message);
                }
            } else {
                $this->api_model->updateDeposit($id, $data);

                $amount_received_id = $this->api_model->getDepositById($id, $this->hospitalID)->amount_received_id;
                if (!empty($amount_received_id)) {
                    $amount_received_payment_id = explode('.', $amount_received_id);
                    $payment_id = $amount_received_payment_id[0];
                    $data_amount_received = array('amount_received' => $deposited_amount);
                    $this->api_model->updatePayment($amount_received_payment_id[0], $data_amount_received, $this->hospitalID);
                }

                $data['message'] = 'updated';
                    echo json_encode($data);
            }
        
    }
    
    //Patient payment history functoin
    function patientPaymentHistory() {
        $patient = $this->input->get('patient');
        //$this->hospitalID = $this->input->post('hospital_id');
        if (empty($patient)) {
            $patient = $this->input->post('patient');
        }
        
        $userIonId = $this->findPatientIonId($patient);
        $this->hospitalID = $this->getHospitalID($userIonId);

        $patient_hospital_id = $this->api_model->getPatientById($patient, $this->hospitalID)->hospital_id;

        $data['settings'] = $this->api_model->getSettings($this->hospitalID);
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 86399;
        }

        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;

        if (!empty($date_from)) {
            $data['payments'] = $this->api_model->getPaymentByPatientIdByDate($patient, $date_from, $date_to, $this->hospitalID);
            $data['deposits'] = $this->api_model->getDepositByPatientIdByDate($patient, $date_from, $date_to, $this->hospitalID);
            $data['gateway'] = $this->api_model->getGatewayByName($data['settings']->payment_gateway, $this->hospitalID);
        } else {
            $data['payments'] = $this->api_model->getPaymentByPatientId($patient, $this->hospitalID);
            $data['pharmacy_payments'] = $this->api_model->getPharmacyPaymentByPatientId($patient, $this->hospitalID);
            $data['ot_payments'] = $this->api_model->getOtPaymentByPatientId($patient);
            $data['deposits'] = $this->api_model->getDepositByPatientId($patient);
            $data['gateway'] = $this->api_model->getGatewayByName($data['settings']->payment_gateway, $this->hospitalID);
        }



        $data['patient'] = $this->api_model->getPatientById($patient, $this->hospitalID);




        $data['message'] = 'successful';
        echo json_encode($date);
    }
    
    //Invoice Details of Payment
    function myInvoice() {
        $userId = $this->input->get('user_ion_id');
        $this->hospitalID = $this->getHospitalID($userId);
        $id = $this->input->get('id');
        $data['settings'] = $this->api_model->getSettings($this->hospitalID);
        $data['discount_type'] = $this->api_model->getDiscountType($this->hospitalID);
        $data['payment'] = $this->api_model->getPaymentById($id, $this->hospitalID);
        echo json_encode($data);
    }
    
        //Send sms function
    function sendSms($to, $message, $data) {
        $sms_gateway = $this->api_model->getSettings($this->hospitalID)->sms_gateway;
        if (!empty($sms_gateway)) {
            $smsSettings = $this->api_model->getSmsSettingsByGatewayName($sms_gateway, $this->hospitalID);
        } else {
            $data['message'] = 'Gateway_NOT_Selected';
            echo json_encode($data);
        }
        $j = sizeof($data);
        foreach ($data as $key => $value) {
            foreach ($value as $key2 => $value2) {
                
                if ($smsSettings->name == 'Clickatell') {
                    $username = $smsSettings->username;
                    $password = $smsSettings->password;
                    $api_id = $smsSettings->api_id;

                     file_get_contents("https://api.clickatell.com/http/sendmsg"
                            . "?user=$username&password=$password&api_id=$api_id&to=$key2&text=$value2");
                    
                }

                if ($smsSettings->name == 'MSG91') {
                    $authkey = $smsSettings->authkey;
                    $sender = $smsSettings->sender;
                    $value2 = urlencode($value2);
                  //  file_get_contents('http://api.msg91.com/api/v2/sendsms?route=4&sender=' . $sender . '&mobiles=' . $key2 . '&authkey=' . $authkey . '&message=' . $value2 . '&country=0');           // file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey='.$api_id.'&to='.$to.'&content='.$message1);           // file_get_contents('https://api.clickatell.com/http/sendmsg?user=' . $username . '&password=' . $password . '&api_id=' . $api_id . '&to=' . $to . '&text=' . $message1);
                    file_get_contents('http://world.msg91.com/api/v2/sendsms?authkey='.$authkey.'&mobiles='.$key2.'&message='.$value2.'&sender='.$sender.'&route=4&country=0');
                }
                if ($smsSettings->name == 'Twilio') {
                    $sid = $smsSettings->sid;
                    $token = $smsSettings->token;
                    $sendername = $smsSettings->sendernumber;
                    if (!empty($sid) && !empty($token) && !empty($sendername)) {
                        $client = new Client($sid, $token);
                        $client->messages->create(
                                $key2, // Text this number
                                array(
                            'from' => $sendername, // From a valid Twilio number
                            'body' => $value2
                                )
                        );
                    }


//file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey=' . $api_id . '&to=' . $to . '&content=' . $message);           // file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey='.$api_id.'&to='.$to.'&content='.$message1);           // file_get_contents('https://api.clickatell.com/http/sendmsg?user=' . $username . '&password=' . $password . '&api_id=' . $api_id . '&to=' . $to . '&text=' . $message1);
                }
            }
        }
    }
    
    //GET PATIENT INFO FUNCTION
    function getPatientInfo() {
        $id = $this->input->get('id');
        $userIonId = findPatientIonId($id);
        $this->hospitalID = $this->getHospitalID($userIonId);
        //$this->hospitalID = $this->input->get('hospital_id');
        $data['patient'] = $this->api_model->getPatientById($id, $this->hospitalID);
        $doctor = $data['patient']->doctor;
        $data['doctor'] = $this->api_model->getDoctorById($doctor, $this->hospitalID);

        if (!empty($data['patient']->birthdate)) {
            $birthDate = strtotime($data['patient']->birthdate);
            $birthDate = date('m/d/Y', $birthDate);
            $birthDate = explode("/", $birthDate);
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
            $data['age'] = $age . ' Year(s)';
        }

        $data['message'] = 'successful';
        echo json_encode($data);
    }
    
    //Get Appointments todays for both patient and doctor
    function getMyTodaysAppoinmentList() {
        // $group = $this->input->get('group');
        // $id = $this->input->get('id');
        
$group = $this->input->get('group');
        $id = $this->input->get('id');
        
        // $group = 'patient';
        // $id = 62;
        if($group == 'doctor') {
            $ion_id = $this->findDoctorIonId($id);
        } else {
            $ion_id = $this->findPatientIonId($id);
        }
        $this->hospitalID = $this->getHospitalID($ion_id);
        if ($group == 'doctor') {
            //$doctor = $this->db->get_where('doctor', array('ion_user_id' => $id))->row()->id;
            $data1['appointments'] = $this->api_model->getAppointmentListByDoctor($id, $this->hospitalID);
        } else {
            $data1['appointments'] = $this->api_model->getAppointment($this->hospitalID);
        }
        
        $i = 0;
        
        $data = [];
        foreach ($data1['appointments'] as $appointment) {
            //$i = $i + 1;

            if($group == 'Patient') {
                $patient_ion_id = $id;
            $patient_details = $this->api_model->getPatientByIonUserId($patient_ion_id, $this->hospitalID);
            $patient_id = $patient_details->id;
            if ($patient_id == $appointment->patient) {
                $patientdetails = $this->api_model->getPatientById($appointment->patient, $this->hospitalID);
                if (!empty($patientdetails)) {
                    $patientname = $patientdetails->name;
                } else {
                    $patientname = $appointment->patientname;
                }
                $doctordetails = $this->api_model->getDoctorById($appointment->doctor, $this->hospitalID);
                if (!empty($doctordetails)) {
                    $doctorname = $doctordetails->name;
                } else {
                    $doctorname = $appointment->doctorname;
                }


                if ($appointment->date == strtotime(date('Y-m-d'))) {
                     array_push($data, array(
                        "id" => $appointment->id,
                        "patient_name" => $patientname,
                        "doctor_name" => $doctorname,
                        "date" => date('d-m-Y', $appointment->date),
                        "remarks" => $appointment->remarks,
                        "status" => $appointment->status,
                        'jitsi_link' => $appointment->room_id,
                        'start_time' => $appointment->s_time,
                        'end_time' => $appointment->e_time,
                    ));
                    $i = $i + 1;
                } else {
                    $info1[] = array($appointment->id,
                        $appointment->patientname,
                        $appointment->doctorname,
                        date('d-m-Y', $appointment->date) . ' <br> ' . $appointment->s_time . '-' . $appointment->e_time,
                        $appointment->remarks,
                        $appointment->status,
                    );
                }
            }
            } else {
                $patientdetails = $this->api_model->getPatientById($appointment->patient, $this->hospitalID);
                if (!empty($patientdetails)) {
                    //$patientname = ' <a type="button" class="" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $patientdetails->name . '</a>';
                    $patientname = $patientdetails->name;
                } else {
                    //$patientname = ' <a type="button" class="" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $appointment->patientname . '</a>';
                    $patientname = $appointment->patientname;
                }
                $doctordetails = $this->api_model->getDoctorById($appointment->doctor, $this->hospitalID);
                if (!empty($doctordetails)) {
                    $doctorname = $doctordetails->name;
                } else {
                    $doctorname = $appointment->doctorname;
                }

                if ($appointment->date == strtotime(date('Y-m-d'))) {
                     array_push($data, array(
                        "id" => $appointment->id,
                        "patient_name" => $patientname,
                        "doctor_name" => $doctorname,
                        "date" => date('d-m-Y', $appointment->date),
                        "remarks" => $appointment->remarks,
                        "status" => $appointment->status,
                        'jitsi_link' => $appointment->room_id,
                        'start_time' => $appointment->s_time,
                        'end_time' => $appointment->e_time,
                    ));
                    $i = $i + 1;
                } else {
                    $info1[] = array($appointment->id,
                        $appointment->patientname,
                        $appointment->doctorname,
                        date('d-m-Y', $appointment->date) . ' <br> ' . $appointment->s_time . '-' . $appointment->e_time,
                        $appointment->remarks,
                        $appointment->status,
                    );
                }
            }
        }
        
        //$data['message'] = 'Successful';

        echo json_encode($data);
    }
    
    
    //Get Appointments todays for both patient and doctor
    function getMyAllAppoinmentList() {
        $group = $this->input->get('group');
        $id = $this->input->get('id');
        
        // $group = 'patient';
        // $id = 62;
        if($group == 'doctor') {
            $ion_id = $this->findDoctorIonId($id);
        } else {
            $ion_id = $this->findPatientIonId($id);
        }
        $this->hospitalID = $this->getHospitalID($ion_id);
        $id = $ion_id;
        if ($group == 'doctor') {
            $doctor = $this->db->get_where('doctor', array('ion_user_id' => $id))->row()->id;
            $data1['appointments'] = $this->api_model->getAppointmentListByDoctor($doctor, $this->hospitalID);
        } else {
            $data1['appointments'] = $this->api_model->getAppointment($this->hospitalID);
        }
        
        $i = 0;
        
        $data = [];
        foreach ($data1['appointments'] as $appointment) {
            //$i = $i + 1;

            if($group == 'patient') {
                $patient_ion_id = $id;
            $patient_details = $this->api_model->getPatientByIonUserId($patient_ion_id, $this->hospitalID);
            $patient_id = $patient_details->id;
            if ($patient_id == $appointment->patient) {
                $patientdetails = $this->api_model->getPatientById($appointment->patient, $this->hospitalID);
                if (!empty($patientdetails)) {
                    $patientname = $patientdetails->name;
                } else {
                    $patientname = $appointment->patientname;
                }
                $doctordetails = $this->api_model->getDoctorById($appointment->doctor, $this->hospitalID);
                if (!empty($doctordetails)) {
                    $doctorname = $doctordetails->name;
                } else {
                    $doctorname = $appointment->doctorname;
                }


                if (true) {
                     array_push($data, array(
                        "id" => $appointment->id,
                        "patient_name" => $patientname,
                        "doctor_name" => $doctorname,
                        "date" => date('d-m-Y', $appointment->date),
                        "remarks" => $appointment->remarks,
                        "status" => $appointment->status,
                        'jitsi_link' => $appointment->room_id,
                        'start_time' => $appointment->s_time,
                        'end_time' => $appointment->e_time,
                    ));
                    $i = $i + 1;
                } else {
                    $info1[] = array($appointment->id,
                        $appointment->patientname,
                        $appointment->doctorname,
                        date('d-m-Y', $appointment->date),
                        $appointment->remarks,
                        $appointment->status,
                    );
                }
            }
            } else {
                $patientdetails = $this->api_model->getPatientById($appointment->patient, $this->hospitalID);
                if (!empty($patientdetails)) {
                    //$patientname = ' <a type="button" class="" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $patientdetails->name . '</a>';
                    $patientname = $patientdetails->name;
                } else {
                    //$patientname = ' <a type="button" class="" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $appointment->patientname . '</a>';
                    $patientname = $appointment->patientname;
                }
                $doctordetails = $this->api_model->getDoctorById($appointment->doctor, $this->hospitalID);
                if (!empty($doctordetails)) {
                    $doctorname = $doctordetails->name;
                } else {
                    $doctorname = $appointment->doctorname;
                }

                if (true) {
                     array_push($data, array(
                        "id" => $appointment->id,
                        "patient_name" => $patientname,
                        "doctor_name" => $doctorname,
                        "date" => date('d-m-Y', $appointment->date),
                        "remarks" => $appointment->remarks,
                        "status" => $appointment->status,
                        'jitsi_link' => $appointment->room_id,
                        'start_time' => $appointment->s_time,
                        'end_time' => $appointment->e_time,
                    ));
                    $i = $i + 1;
                } else {
                    $info1[] = array($appointment->id,
                        $appointment->patientname,
                        $appointment->doctorname,
                        date('d-m-Y', $appointment->date),
                        $appointment->remarks,
                        $appointment->status,
                    );
                }
            }
        }

        echo json_encode($data);
    }
    
    
    //Get Hospital ID from user id
    function getHospitalID($id) {
        //return $this->db->get_where('users', array('id' => $id))->row()->hospital_ion_id;
        $current_user_id = $id;
        $group_id = $this->db->get_where('users_groups', array('user_id' => $current_user_id))->row()->group_id;
        $group_name = $this->db->get_where('groups', array('id' => $group_id))->row()->name;
        $group_name = strtolower($group_name);
        return $this->db->get_where($group_name, array('ion_user_id' => $current_user_id))->row()->hospital_id;
    }
    
    
    
    // public function addNewPrescription() {

    //     $id = $this->input->post('id');
    //     $tab = $this->input->post('tab');
    //     $date = $this->input->post('date');
    //     $patient_ion_id = 764;
    //     $this->hospitalID = $this->getHospitalID($patient_ion_id);
    //     if (!empty($date)) {
    //         $date = strtotime($date);
    //     }

    //     $patient = $this->input->post('patient');
    //     $doctor = $this->input->post('doctor');
    //     $note = $this->input->post('note');
    //     $symptom = $this->input->post('symptom');
    //     $medicine = $this->input->post('medicine');
    //     $dosage = $this->input->post('dosage');
    //     $frequency = $this->input->post('frequency');
    //     $days = $this->input->post('days');
    //     $instruction = $this->input->post('instruction');
    //     $admin = $this->input->post('admin');


    //     $advice = $this->input->post('advice');

    //     $report = array();

    //     if (!empty($medicine)) {
    //         foreach ($medicine as $key => $value) {
    //             $report[$value] = array(
    //                 'dosage' => $dosage[$key],
    //                 'frequency' => $frequency[$key],
    //                 'days' => $days[$key],
    //                 'instruction' => $instruction[$key],
    //             );

    //             // }
    //         }

    //         foreach ($report as $key1 => $value1) {
    //             $final[] = $key1 . '***' . implode('***', $value1);
    //         }

    //         $final_report = implode('###', $final);
    //     } else {
    //         $final_report = '';
    //     }





    //     // $this->load->library('form_validation');
    //     // $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    //     // // Validating Date Field
    //     // $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');
    //     // // Validating Patient Field
    //     // $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
    //     // // Validating Doctor Field
    //     // $this->form_validation->set_rules('doctor', 'Doctor', 'trim|min_length[1]|max_length[100]|xss_clean');
    //     // // Validating Advice Field
    //     // $this->form_validation->set_rules('symptom', 'History', 'trim|min_length[1]|max_length[1000]|xss_clean');
    //     // // Validating Do And Dont Name Field
    //     // $this->form_validation->set_rules('note', 'Note', 'trim|min_length[1]|max_length[1000]|xss_clean');

    //     // // Validating Advice Field
    //     // $this->form_validation->set_rules('advice', 'Advice', 'trim|min_length[1]|max_length[1000]|xss_clean');

    //     // // Validating Validity Field
    //     // $this->form_validation->set_rules('validity', 'Validity', 'trim|min_length[1]|max_length[100]|xss_clean');



    //     if ($this->form_validation->run() == FALSE) {
    //         if (!empty($id)) {
    //             $data['message'] = 'failed';
    //         } else {
    //             // $data = array();
    //             // $data['setval'] = 'setval';
    //             // $data['medicines'] = $this->api_model->getMedicine($this->hospitalID);
    //             // $data['patients'] = $this->api_model->getPatient($this->hospitalID);
    //             // $data['doctors'] = $this->api_model->getDoctor($this->hospitalID);
    //             // $data['settings'] = $this->api_model->getSettings($this->hospitalID);
    //             // $this->load->view('home/dashboard', $data); // just the header file
    //             // $this->load->view('add_new_prescription_view', $data);
    //             // $this->load->view('home/footer'); // just the header file
    //             $data['message'] = 'failed';
    //         }
    //     } else {
    //         $data = array();
    //         $patientname = $this->api_model->getPatientById($patient, $this->hospitalID)->name;
    //         $doctorname = $this->api_model->getDoctorById($doctor, $this->hospitalID)->name;
    //         $data = array('date' => $date,
    //             'patient' => $patient,
    //             'doctor' => $doctor,
    //             'symptom' => $symptom,
    //             'medicine' => $final_report,
    //             'note' => $note,
    //             'advice' => $advice,
    //             'patientname' => $patientname,
    //             'doctorname' => $doctorname
    //         );
    //         if (empty($id)) {
    //             $this->api_model->insertPrescription($data, $this->hospitalID);
    //             $data['message'] = 'success';
    //             // $this->session->set_flashdata('feedback', lang('added'));
    //         } else {
    //             $this->prescription_model->updatePrescription($id, $data);
    //             $data['message'] = 'success';
    //             // $this->session->set_flashdata('feedback', lang('updated'));
    //         }
            
    //     }
    //                 echo json_encode($data);
    // }
    
    
    public function addNewPrescription() {
        $tab = $this->input->post('tab');
        $date = $this->input->post('date');
        $patient_ion_id = 764;
        $this->hospitalID = $this->getHospitalID($patient_ion_id);
        if (!empty($date)) {
            $date = strtotime($date);
        }

        $patient = $this->input->post('patient');
        $doctor = $this->input->post('doctor');
        $note = $this->input->post('note');
        $symptom = $this->input->post('symptom');
        $medicine = $this->input->post('medicine');
        $dosage = $this->input->post('dosage');
        $frequency = $this->input->post('frequency');
        $days = $this->input->post('days');
        $instruction = $this->input->post('instruction');
        $admin = $this->input->post('admin');
        
        $advice = $this->input->post('advice');

        $report = array();

        if (!empty($medicine)) {
            foreach ($medicine as $key => $value) {
                $report[$value] = array(
                    'dosage' => $dosage[$key],
                    'frequency' => $frequency[$key],
                    'days' => $days[$key],
                    'instruction' => $instruction[$key],
                );

                // }
            }

            foreach ($report as $key1 => $value1) {
                $final[] = $key1 . '***' . implode('***', $value1);
            }

            $final_report = implode('###', $final);
        } else {
            $final_report = '';
        }
        
        $data = array();
            $patientname = $this->api_model->getPatientById($patient, $this->hospitalID)->name;
            $doctorname = $this->api_model->getDoctorById($doctor, $this->hospitalID)->name;
            $data = array('date' => $date,
                'patient' => $patient,
                'doctor' => $doctor,
                'symptom' => $symptom,
                'medicine' => $final_report,
                'note' => $note,
                'advice' => $advice,
                'patientname' => $patientname,
                'doctorname' => $doctorname
            );
        $this->api_model->insertPrescription($data, $this->hospitalID);
        $data['message'] = 'success';
        echo json_encode($data);
    }
    
    public function editNewPrescription() {
        $id = $this->input->post('id');
        $tab = $this->input->post('tab');
        $date = $this->input->post('date');
        $patient_ion_id = 764;
        $this->hospitalID = $this->getHospitalID($patient_ion_id);
        if (!empty($date)) {
            $date = strtotime($date);
        }

        $patient = $this->input->post('patient');
        $doctor = $this->input->post('doctor');
        $note = $this->input->post('note');
        // $symptom = $this->input->post('symptom');
        // $medicine = $this->input->post('medicine');
        // $dosage = $this->input->post('dosage');
        // $frequency = $this->input->post('frequency');
        // $days = $this->input->post('days');
        // $instruction = $this->input->post('instruction');
        // $admin = $this->input->post('admin');
        
        // $advice = $this->input->post('advice');

        // $report = array();

        // if (!empty($medicine)) {
        //     foreach ($medicine as $key => $value) {
        //         $report[$value] = array(
        //             'dosage' => $dosage[$key],
        //             'frequency' => $frequency[$key],
        //             'days' => $days[$key],
        //             'instruction' => $instruction[$key],
        //         );

        //         // }
        //     }

        //     foreach ($report as $key1 => $value1) {
        //         $final[] = $key1 . '***' . implode('***', $value1);
        //     }

        //     $final_report = implode('###', $final);
        // } else {
        //     $final_report = '';
        // }
        
        $data = array();
            $patientname = $this->api_model->getPatientById($patient, $this->hospitalID)->name;
            $doctorname = $this->api_model->getDoctorById($doctor, $this->hospitalID)->name;
            $data = array('date' => $date,
                'patient' => $patient,
                'doctor' => $doctor,
                // 'symptom' => $symptom,
                // 'medicine' => $final_report,
                'note' => $note,
                // 'advice' => $advice,
                'patientname' => $patientname,
                'doctorname' => $doctorname
            );
            if (empty($id)) {
                $this->api_model->insertPrescription($data, $this->hospitalID);
                $data['message'] = 'success';
                // $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->prescription_model->updatePrescription($id, $data);
                $data['message'] = 'success';
                // $this->session->set_flashdata('feedback', lang('updated'));
            }
    }
    
    public function getPatientList() {
       
        $patient_ion_id =$this->input->get('id');
        //echo $patient_ion_id.'sad';exit;
        $this->hospitalID = $this->getHospitalID($patient_ion_id);
       // print_r($this->hospitalID.'sad');exit;
        $this->db->where('hospital_id', $this->hospitalID);
        $patients = $this->db->get('patient')->result();
        
        echo json_encode($patients);
        //echo $this->hospitalID;
    }
    
    public function getDoctorList() {
        $patient_ion_id =$this->input->get('id');;
        $this->hospitalID = $this->getHospitalID($patient_ion_id);
        
        $this->db->where('hospital_id', $this->hospitalID);
        $doctors = $this->db->get('doctor')->result();
        
        echo json_encode($doctors);
        //echo $this->hospitalID;
    }
    
    public function getDoctorTimeSlop() {
        $id = $this->input->get('doctor_id');
        $date = $this->input->get('date');
        if(empty($date)) {
            $data['message'] = 'failed';
            echo json_encode($data);
        } else {
            $day = date('l', strtotime($date));
        
        $this->db->where('doctor', $id);
        $this->db->where('weekday', $day);
        $result = $this->db->get('time_slot')->result();
        echo json_encode($result);
        }
        
    }
    
    public function findPatientIonId($id) {
        $this->db->where('id', $id);
        return $this->db->get('patient')->row()->ion_user_id;
    }
    
    public function findDoctorIonId($id) {
        $this->db->where('id', $id);
        return $this->db->get('doctor')->row()->ion_user_id;
    }
    
    function paymentPaypal($data) {
        $this->db->where('hospital_id', $this->hospitalID);
        $this->db->where('name', 'Paypal');
        $paypal = $this->db->get('paymentGateway')->row();
        $gateway = Omnipay::create('PayPal_Pro');
        $gateway->setUsername($paypal->APIUsername);
        $gateway->setPassword($paypal->APIPassword);
        $gateway->setSignature($paypal->APISignature);
        if ($paypal->status == 'test') {
            $gateway->setTestMode(true); // here 'true' is for sandbox. Pass 'false' when go live
        } else {
            $gateway->setTestMode(false);
        }

        $arr_expiry = explode("/", $data['expire_date']);
        $cardholdername = explode(" ", $data['cardholdername']);
        $currency = $this->currencyCode();
        $formData = array(
            'firstName' => trim($cardholdername[0]),
            'lastName' => trim($cardholdername[1]),
            'number' => $data['card_number'],
            'expiryMonth' => trim($arr_expiry[0]),
            'expiryYear' => trim($arr_expiry[1]),
            'cvv' => $data['cvv']
        );
        

        try {

            // Send purchase request
            $response = $gateway->purchase([
                        'amount' => $data['deposited_amount'],
                        'currency' => $currency,
                        'card' => $formData
                    ])->send();


            // Process response
            if ($response->isSuccessful()) {
                    $date = time();
                    $data1 = array('patient' => $data['patient'],
                        'date' => $date,
                        'payment_id' => $data['payment_id'],
                        'deposited_amount' => $data['deposited_amount'],
                        'deposit_type' => 'Card',
                        'gateway' => 'PayPal',
                        'user' => $data['user'],
                        'hospital_id' => $this->hospitalID
                    );
                    $this->api_model->insertDeposit($data1, $this->hospitalID);
                    $data = 'successful';
                    echo json_encode($data);
            } else {
                // Payment failed
                //  echo "Payment failed. " . $response->getMessage();
                echo( $response->getMessage());
                $data = 'failed';
                echo json_encode($data);
            }
        } catch (Exception $e) {
            $data = 'failed';
            echo json_encode($data);
        }
    }
    
    function currencyCode() {
        $currency = $this->db->get('settings')->row()->currency;
        if ($currency == '$' || strtoupper($currency) == 'USD') {
            $currency = 'USD';
        }
        if ($currency == 'R' || strtoupper($currency) == 'ZAR') {
            $currency = 'ZAR';
        }
        if (strtoupper($currency) == 'TK' || strtoupper($currency) == 'BDT' || strtoupper($currency) == 'TAKA' || $currency == 'ট') {
            $currency = 'BDT';
        }
        if (strtoupper($currency) == 'CNY') {
            $currency = 'CNY';
        }
        if ($currency == '€' || strtoupper($currency) == 'EUR') {
            $currency = 'EUR';
        }
        if ($currency == '₹' || strtoupper($currency) == 'INR') {
            $currency = 'INR';
        }
        if (strtoupper($currency) == 'CNY') {
            $currency = 'CNY';
        }
        if (strtoupper($currency) == 'BRL' || $currency == 'R$') {
            $currency = 'BRL';
        }
        if (strtoupper($currency) == 'GBP' || $currency == '£') {
            $currency = 'GBP';
        }
        if (strtoupper($currency) == 'IDR' || $currency == 'Rp') {
            $currency = 'IDR';
        }
        if (strtoupper($currency) == 'NGN' || $currency == '₦') {
            $currency = 'NGN';
        }

        if (strtoupper($currency) == 'RS' || strtoupper($currency) == 'INR' || strtoupper($currency) == 'RUPEE') {
            $currency = 'INR';
        }
        if (strtoupper($currency) == 'AUD') {
            $currency = 'AUD';
        }
        if (strtoupper($currency) == 'CAD') {
            $currency = 'CAD';
        }
        return $currency;
    }

//signup doctor
public function addDoctor() {
    $id = $this->input->post('id');

    $name = $this->input->post('name');
    $password = $this->input->post('password');
    $email = $this->input->post('email');
    $address = $this->input->post('address');
    $phone = $this->input->post('phone');
    $department = $this->input->post('department');
    $profile = $this->input->post('profile');


    $validate_data = array('name' => $name, 'password' => $password, 'email' => $email);
    $this->form_validation->set_data($validate_data);
    $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    if (!empty($password)) {
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    }
    $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
    if ($this->form_validation->run() == FALSE) {
        $data = 'failed';
        echo json_encode($data);
    } else {

        $file_name = $_FILES['img_url']['name'];
        $file_name_pieces = explode('_', $file_name);
        $new_file_name = '';
        $count = 1;
        foreach ($file_name_pieces as $piece) {
            if ($count !== 1) {
                $piece = ucfirst($piece);
            }

            $new_file_name .= $piece;
            $count++;
        }
        $config = array(
            'file_name' => $new_file_name,
            'upload_path' => "./uploads/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => False,
            'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "1768",
            'max_width' => "2024"
        );

        $this->load->library('Upload', $config);
        $this->upload->initialize($config);

        if ($this->upload->do_upload('img_url')) {
            $path = $this->upload->data();
            $img_url = "uploads/" . $path['file_name'];
            $data = array();
            $data = array(
                'img_url' => $img_url,
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'phone' => $phone,
                'department' => $department,
                'profile' => $profile
            );
        } else {
            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'phone' => $phone,
                'department' => $department,
                'profile' => $profile
            );
        }
        $username = $this->input->post('name');
         $per = $this->input->post('permission');
        $permission = implode(',', $per);
        $additional_data = array(
            'permissions' => $permission
        );
       // echo '345adf';exit;
        if (empty($id)) {     // Adding New Doctor
            if ($this->ion_auth->email_check($email)) {
                $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
               // echo '345adf';exit;
                redirect('doctor/addNewView');
            } else {
                $dfg = 4;
                $this->ion_auth->register($username, $password, $email, $phone, $dfg, $additional_data);
                $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                $this->doctor_model->insertDoctor($data);
                $doctor_user_id = $this->db->get_where('doctor', array('email' => $email))->row()->id;
                $id_info = array('ion_user_id' => $ion_user_id);
                $this->doctor_model->updateDoctor($doctor_user_id, $id_info);
                $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);

                //sms
                $set['settings'] = $this->settings_model->getSettings();
                $autosms = $this->sms_model->getAutoSmsByType('doctor');
                $message = $autosms->message;
                $to = $phone;
                $name1 = explode(' ', $name);
                if (!isset($name1[1])) {
                    $name1[1] = null;
                }
                $data1 = array(
                    'firstname' => $name1[0],
                    'lastname' => $name1[1],
                    'name' => $name,
                    'department' => $department,
                    'company' => $set['settings']->system_vendor
                );

                if ($autosms->status == 'Active') {
                    $messageprint = $this->parser->parse_string($message, $data1);
                    $data2[] = array($to => $messageprint);
                    $this->sms->sendSms($to, $message, $data2);
                }
                //end
                //email
                $autoemail = $this->email_model->getAutoEmailByType('doctor');
                if ($autoemail->status == 'Active') {
                    $emailSettings = $this->email_model->getEmailSettings();
                    $message1 = $autoemail->message;
                    $messageprint1 = $this->parser->parse_string($message1, $data1);
                    $this->email->from($emailSettings->admin_email);
                    $this->email->to($email);
                    $this->email->subject('Appointment confirmation');
                    $this->email->message($messageprint1);
                    $this->email->send();
                }
                //end
                $this->session->set_flashdata('feedback', lang('added'));
            }
        } else { // Updating Doctor
            $ion_user_id = $this->db->get_where('doctor', array('id' => $id))->row()->ion_user_id;
            if (empty($password)) {
                $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
            } else {
                $password = $this->ion_auth_model->hash_password($password);
            }
             $this->doctor_model->updateIonUserId($username, $email, $password, $phone, $ion_user_id, $permission);
            $this->doctor_model->updateDoctor($id, $data);
            $this->session->set_flashdata('feedback', lang('updated'));
        }
        // Loading View
        $data['message'] = "success";
        echo json_encode($data);
    }
}

public function addPatient() {
   
    $name = $this->input->post('name');
    $password = $this->input->post('password');
    $sms = $this->input->post('sms');
    $doctor = $this->input->post('doctor');
    $address = $this->input->post('address');
    $phone = $this->input->post('phone');
    $sex = $this->input->post('sex');
    $birthdate = $this->input->post('birthdate');
    $bloodgroup = $this->input->post('bloodgroup');
    $patient_id = $this->input->post('p_id');
    $email = $this->input->post('email');

    
    if (empty($patient_id)) {
        $patient_id = rand(10000, 1000000);
    }
    if ((empty($id))) {
        $add_date = date('m/d/y');
        $registration_time = time();
    } else {
        $add_date = $this->patient_model->getPatientById($id)->add_date;
        $registration_time = $this->patient_model->getPatientById($id)->registration_time;
    }
    $email = $this->input->post('email');
    if (empty($email)) {
        $email = $name . '@' . $phone . '.com';
    }


    $validate_data = array('name' => $name, 'password' => $password, 'email' => $email,'address' => $address, 'phone' => $phone,'sex' => $sex,'birthdate' => $birthdate,'bloodgroup' => $bloodgroup);
    $this->form_validation->set_data($validate_data);
    $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
    // Validating Password Field
    if (empty($id)) {
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[3]|max_length[100]|xss_clean');
    }
    // Validating Email Field
    $this->form_validation->set_rules('email', 'Email', 'trim|min_length[2]|max_length[100]|xss_clean');
    // Validating Doctor Field
    //   $this->form_validation->set_rules('doctor', 'Doctor', 'trim|min_length[1]|max_length[100]|xss_clean');
    // Validating Address Field   
    $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[2]|max_length[500]|xss_clean');
    // Validating Phone Field           
    $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[2]|max_length[50]|xss_clean');
    // Validating Email Field
    $this->form_validation->set_rules('sex', 'Sex', 'trim|min_length[2]|max_length[100]|xss_clean');
    // Validating Address Field   
    $this->form_validation->set_rules('birthdate', 'Birth Date', 'trim|min_length[2]|max_length[500]|xss_clean');
    // Validating Phone Field           
    $this->form_validation->set_rules('bloodgroup', 'Blood Group', 'trim|min_length[1]|max_length[10]|xss_clean');
 if ($this->form_validation->run() == FALSE) {
        $data = 'failed';
        echo json_encode($data);
    } else {
         

        $file_name = $_FILES['img_url']['name'];
        $file_name_pieces = explode('_', $file_name);
        $new_file_name = '';
        $count = 1;
        foreach ($file_name_pieces as $piece) {
            if ($count !== 1) {
                $piece = ucfirst($piece);
            }
            $new_file_name .= $piece;
            $count++;
        }
        $config = array(
            'file_name' => $new_file_name,
            'upload_path' => "./uploads/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => False,
            'max_size' => "10000000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "10000",
            'max_width' => "10000"
        );
        $this->load->library('Upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('img_url')) {
            $path = $this->upload->data();
            $img_url = "uploads/" . $path['file_name'];
            $data = array();
            $data = array(
                'patient_id' => $patient_id,
                'img_url' => $img_url,
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'doctor' => $doctor,
                'phone' => $phone,
                'sex' => $sex,
                'birthdate' => $birthdate,
                'bloodgroup' => $bloodgroup,
                'add_date' => $add_date,
                'registration_time' => $registration_time
            );
        } else {
            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'patient_id' => $patient_id,
                'name' => $name,
                'email' => $email,
                'doctor' => $doctor,
                'address' => $address,
                'phone' => $phone,
                'sex' => $sex,
                'birthdate' => $birthdate,
                'bloodgroup' => $bloodgroup,
                'add_date' => $add_date,
                'registration_time' => $registration_time
            );
        }

        $username = $this->input->post('name');
     /*   $per = $this->input->post('permission');
        $permission = implode(',', $per);
        $additional_data = array(
            'permissions' => $permission
        );*/
        if (empty($id)) {     // Adding New Patient
            if ($this->ion_auth->email_check($email)) {
              //  echo 'adsf';exit;

               // $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                redirect('patient/addNewView');
            } else {
                $dfg = 5;
                $this->ion_auth->register($username, $password, $email, $phone, $dfg);
                $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                $this->patient_model->insertPatient($data);
                $patient_user_id = $this->db->get_where('patient', array('email' => $email))->row()->id;
                $id_info = array('ion_user_id' => $ion_user_id);
                $this->patient_model->updatePatient($patient_user_id, $id_info);
                $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                //sms

                $set['settings'] = $this->settings_model->getSettings();
                $autosms = $this->sms_model->getAutoSmsByType('patient');
                $message = $autosms->message;
                $to = $phone;
                $name1 = explode(' ', $name);
                if (!isset($name1[1])) {
                    $name1[1] = null;
                }
                $data1 = array(
                    'firstname' => $name1[0],
                    'lastname' => $name1[1],
                    'name' => $name,
                    'doctor' => $doctor,
                    'company' => $set['settings']->system_vendor
                );
                //   if (!empty($sms)) {
                // $this->sms->sendSmsDuringPatientRegistration($patient_user_id);
                if ($autosms->status == 'Active') {
                    $messageprint = $this->parser->parse_string($message, $data1);
                    $data2[] = array($to => $messageprint);
                    $this->sms->sendSms($to, $message, $data2);
                }
                //end
                //  }
                //email

                $autoemail = $this->email_model->getAutoEmailByType('patient');
                if ($autoemail->status == 'Active') {
                    $emailSettings = $this->email_model->getEmailSettings();
                    $message1 = $autoemail->message;
                    $messageprint1 = $this->parser->parse_string($message1, $data1);
                    $this->email->from($emailSettings->admin_email);
                    $this->email->to($email);
                    $this->email->subject('Appointment confirmation');
                    $this->email->message($messageprint1);
                    $this->email->send();
                }
                //end
                $this->session->set_flashdata('feedback', lang('added'));
            }
            //    }
        } else { // Updating Patient
            $ion_user_id = $this->db->get_where('patient', array('id' => $id))->row()->ion_user_id;
            if (empty($password)) {
                $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
            } else {
                $password = $this->ion_auth_model->hash_password($password);
            }
              $this->patient_model->updateIonUser($username, $email, $password, $phone, $ion_user_id);
            $this->patient_model->updatePatient($id, $data);
            $this->session->set_flashdata('feedback', lang('updated'));
        }
        // Loading View
        $data['message'] = "success";
        echo json_encode($data);
    }
}
	//log the user in
    function checklogin()
	{

        $identity = $this->input->post('identity');
		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');

		if ($this->form_validation->run() == true)
		{
			$_SESSION['userinput'] = $this->input->post('identity');
			if(is_numeric($this->input->post('identity'))) {

				$checkPhone = $this->otpsms_model->checkPhoneNumber($this->input->post('identity'));
				if($checkPhone) {
                   

					//echo "<pre>"; print_r($checkPhone); exit;
					$_SESSION['login_methode'] = 'mobile';
					$number = '+91'.$this->input->post('identity');
					$dataOtp = rand ( 10000 , 99999 ); 
					//print_R( $checkPhone->hospital_ion_id);exit;
					$sms_gateway = $this->otpsms_model->getOTPSettings($checkPhone->hospital_ion_id);
					//echo "<pre>"; print_r($sms_gateway); exit;
					if (!empty($sms_gateway)) {
							$smsSettings = $this->otpsms_model->getSmsSettingsByGatewayName($checkPhone->hospital_ion_id,$sms_gateway->sms_gateway);
							//echo "<pre>"; print_r($smsSettings); exit;
							//Send SMS
                            
						if($smsSettings) {
							$to = $_SESSION['userinput'];
							$otp = $dataOtp." is your OTP. Use this to login in allohms.com";
							
							if ($smsSettings->name == 'Twilio') {
								$sid = $smsSettings->sid;
								$token = $smsSettings->token;
								$sendername = $smsSettings->sendernumber;
								//echo $number; exit;
								//$dataSms = ['phone' => $to, 'text' => $otp];
								if (!empty($sid) && !empty($token) && !empty($sendername)) {
                                   
									$client = new Client($sid, $token);
									$response = $client->messages->create(
														$number, // Text this number
														array(
													'from' => $sendername, // From a valid Twilio number
													'body' => $otp
														)
													);
									
								//	echo "<pre>"; print_r($response); exit;
									if($response->sid) {
										$updateOTP = $this->otpsms_model->updateOTP($dataOtp, 0);
                                         echo json_encode($dataOtp);
										//$this->_render_page('auth/otp');
									} else {
										$data['message'] = '<p> Cannot send OTP to this number. </p>';
										$data['identity'] = array('name' => 'identity',
											'id' => 'identity',
											'type' => 'text',
											'value' => $this->form_validation->set_value('identity'),
										);
										$data['password'] = array('name' => 'password',
											'id' => 'password',
											'type' => 'password',
										);
		
                                       // $data['message'] = "failed";
                                       echo json_encode($data);
										//$this->_render_page('auth/login', $data);
									}
								}
							} else {
								$data['message'] = '<p> Twilio OTP server settings not configured with this application. </p>';

								$data['identity'] = array('name' => 'identity',
									'id' => 'identity',
									'type' => 'text',
									'value' => $this->form_validation->set_value('identity'),
								);
								$data['password'] = array('name' => 'password',
									'id' => 'password',
									'type' => 'password',
								);

                                echo json_encode($data);
							}
						}
						//End
					} else {
                        $data['message'] =	$this->session->set_flashdata('feedback', lang('gatewany_not_selected'));
                        echo json_encode($data);
					}
				} else {
					$data['message'] = '<p> Phone Number not Exist. </p>';

					$data['identity'] = array('name' => 'identity',
						'id' => 'identity',
						'type' => 'text',
						'value' => $this->form_validation->set_value('identity'),
					);
					$data['password'] = array('name' => 'password',
						'id' => 'password',
						'type' => 'password',
					);

					echo json_encode($data);
				}
			} else {
                $data['message'] = "failed";
				//$_SESSION['login_methode'] = 'email';
				//$this->_render_page('auth/otp');
                echo json_encode($data);
			}
		}
		else
		{
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
			);

            $data['message'] = "failed";
            echo json_encode($data);
		}
	}

    public function campList() {
        $data = array();
        $result = $this->api_model->getCamps();
        if($result) 
        {
            $data['code'] = 200;
            $data['status'] = 'Success';
            $data['response'] = $result;
        } else {
            $data['code'] = 400;
            $data['status'] = 'Failed';
            $data['response'] = 'No records found.';
        }
        echo json_encode($data);
    }

    public function patientListByCamp() {
        $postdata = file_get_contents("php://input");
        $_POST = (array) json_decode($postdata);
        $id = $_POST['camp_id'];
        $data = array();
        $result = $this->api_model->getPatentsByCamp($id);
        if($result) 
        {
            $data['code'] = 200;
            $data['status'] = 'Success';
            $data['response'] = $result;
        } else {
            $data['code'] = 400;
            $data['status'] = 'Failed';
            $data['response'] = 'No records found.';
        }
        echo json_encode($data);
    }

    public function getDoctors() {
        $data = array();
        $result = $this->api_model->getDoctors();
        if($result) 
        {
            $data['code'] = 200;
            $data['status'] = 'Success';
            $data['response'] = $result;
        } else {
            $data['code'] = 400;
            $data['status'] = 'Failed';
            $data['response'] = 'No records found.';
        }
        echo json_encode($data);
    }

    public function getCheckupTemplates() {
        $data = array();
        $result = $this->api_model->getCheckupTemplates();
        if($result) 
        {
            $data['code'] = 200;
            $data['status'] = 'Success';
            $data['response'] = $result;
        } else {
            $data['code'] = 400;
            $data['status'] = 'Failed';
            $data['response'] = 'No records found.';
        }
        echo json_encode($data);
    }

    public function getFormFields() {
        $postdata = file_get_contents("php://input");
        $_POST = (array) json_decode($postdata);

        $data = array();
        $tempid = $this->input->post('tempid');
        $id = $this->input->post('id');
        $response = $this->checkup_model->getformFieldsById($tempid,$id);
        //echo "<pre>"; print_r($response); exit;
        if($id != '' && !empty($response)) {
            $data['response'] = $response;
            
        } else {
            $response1 = $this->checkup_model->getTemplateFields($tempid);
            $data['response'] = $response1;
        }
        $data['code'] = 200;
        $data['status'] = 'Success';
        echo json_encode($data);
    }

    public function patientList() {
        $data = array();
        $result = $this->api_model->getPatents();
        if($result) 
        {
            $data['code'] = 200;
            $data['status'] = 'Success';
            $data['response'] = $result;
        } else {
            $data['code'] = 400;
            $data['status'] = 'Failed';
            $data['response'] = 'No records found.';
        }
        echo json_encode($data);
    }

    public function getAllRisks() {
        $data = array();
        $result = $this->risk_model->getRisks();
        if($result) 
        {
            $data['code'] = 200;
            $data['status'] = 'Success';
            $data['response'] = $result;
        } else {
            $data['code'] = 400;
            $data['status'] = 'Failed';
            $data['response'] = 'No records found.';
        }
        echo json_encode($data);
    }

    public function getRisksByType() {
        $postdata = file_get_contents("php://input");
        $_POST = (array) json_decode($postdata);

        $data = array();
        $type = $this->input->post('type');
        $result = $this->api_model->getRisksByType($type);
        if($result) 
        {
            $data['code'] = 200;
            $data['status'] = 'Success';
            $data['response'] = $result;
        } else {
            $data['code'] = 400;
            $data['status'] = 'Failed';
            $data['response'] = 'No records found.';
        }
        echo json_encode($data);
    }

    public function getVitals() {
        $data = array();
        $result = $this->vitals_model->getVital();
        if($result) 
        {
            $data['code'] = 200;
            $data['status'] = 'Success';
            $data['response'] = $result;
        } else {
            $data['code'] = 400;
            $data['status'] = 'Failed';
            $data['response'] = 'No records found.';
        }
        echo json_encode($data);
    }

    public function getSymptoms() {
        $data = array();
        $result = $this->symptoms_model->getSymptom();
        if($result) 
        {
            $data['code'] = 200;
            $data['status'] = 'Success';
            $data['response'] = $result;
        } else {
            $data['code'] = 400;
            $data['status'] = 'Failed';
            $data['response'] = 'No records found.';
        }
        echo json_encode($data);
    }

    public function getTagedItems() {
        $data = array();
        $result = $this->api_model->getTagedItems();
        if($result) 
        {
            $data['code'] = 200;
            $data['status'] = 'Success';
            $data['response'] = $result;
        } else {
            $data['code'] = 400;
            $data['status'] = 'Failed';
            $data['response'] = 'No records found.';
        }
        echo json_encode($data);
    }

    public function getCheckupsByPatient() {
        $postdata = file_get_contents("php://input");
        $_POST = (array) json_decode($postdata);

        //echo "<pre>"; print_r($_POST); exit;
        $data = array();
        $result = $this->api_model->getCheckupsByPatient($_POST['patient_id'],$_POST['hospital_id']);
        if($result) 
        {
            $data['code'] = 200;
            $data['status'] = 'Success';
            $data['response'] = $result;
        } else {
            $data['code'] = 400;
            $data['status'] = 'Failed';
            $data['response'] = 'No records found.';
        }
        echo json_encode($data);
    }

    public function viewCheckup() {
        $postdata = file_get_contents("php://input");
        $_POST = (array) json_decode($postdata);

        $data = array();
        $id = $_POST['id'];
        if($id) {
            $result['temp'] = $this->api_model->getformTempById($id,$_POST['hospital_id']);
            $result['checkupTags'] = $this->patient_model->getCheckupTagsById($id);
            $result['fields'] = $this->patient_model->getformFieldsById($result['temp']->tid,$id);
            $patient_id = $result['temp']->pid;
            $result['risk'] = $this->checkup_model->getRiskById($id,$patient_id);
            $result['riskTags'] = $this->checkup_model->getRiskTagsById($id,$patient_id);
            $data['code'] = 200;
            $data['status'] = 'Success';
            $data['response'] = $result;
        } else {
            $data['code'] = 400;
            $data['status'] = 'Failed';
            $data['response'] = 'No records found.';
        }
        echo json_encode($data);
    }
    

    public function addNewPatientCamp() {
        $postdata = file_get_contents("php://input");
        $_POST = (array) json_decode($postdata);

        $resData = array();
        $cmpid = $this->input->post('campid');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $sms = $this->input->post('sms');
        $doctor = $this->input->post('doctor');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $sex = $this->input->post('sex');
        $birthdate = $this->input->post('birthdate');
        $bloodgroup = $this->input->post('bloodgroup');
        $patient_id = rand(10000, 1000000);
        $add_date = date('m/d/y');
        $registration_time = time();
        $email = $this->input->post('email');
        $hospital_id = $this->input->post('hospital_id');
        $imageUrl = $_POST['image'];
        unset($_POST['image']);
        unset($_POST['hospital_id']);
        if (empty($email)) {
            $email = $name . '@' . $phone . '.com';
        }

        if($imageUrl) {
            $image = str_replace('data:image/png;base64,', '', $imageUrl);
            $image = str_replace(' ', '+', $image);
            // Decode the Base64 encoded Image
            $imgdata = base64_decode($image);
            // Create Image path with Image name and Extension
            $file = './uploads/' . $patient_id . '.jpg';
            // Save Image in the Image Directory
            $success = file_put_contents($file, $imgdata);
            $img_url = "uploads/" . $patient_id . '.jpg';
            $data = array();
            $data = array(
                'patient_id' => $patient_id,
                'img_url' => $img_url,
                'name' => $name,
                'email' => $email,
                'address' => $address,
                'doctor' => $doctor,
                'phone' => $phone,
                'sex' => $sex,
                'birthdate' => $birthdate,
                'bloodgroup' => $bloodgroup,
                'add_date' => $add_date,
                'registration_time' => $registration_time,
                'camp_id' => $cmpid
            );
        } else {
            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'patient_id' => $patient_id,
                'name' => $name,
                'email' => $email,
                'doctor' => $doctor,
                'address' => $address,
                'phone' => $phone,
                'sex' => $sex,
                'birthdate' => $birthdate,
                'bloodgroup' => $bloodgroup,
                'add_date' => $add_date,
                'registration_time' => $registration_time,
                'camp_id' => $cmpid
            );
        }

        $username = $this->input->post('name');
        
        if ($this->ion_auth->email_check($email)) {
            $resData['code'] = 400;
            $resData['status'] = 'Failed';
            $resData['response'] = 'Email already exist.';
        } else {
            $dfg = 5;
            $this->ion_auth->register($username, $password, $email, $phone, $dfg);
            $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
            $this->patient_model->insertPatient($data);
            $patient_user_id = $this->db->get_where('patient', array('email' => $email))->row()->id;
            $id_info = array('ion_user_id' => $ion_user_id,'hospital_id' => $hospital_id);
            $this->patient_model->updatePatient($patient_user_id, $id_info);
            $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $hospital_id);
            $this->ion_auth->updateSerialId('patient', $ion_user_id,$hospital_id);
            //sms
            $set['settings'] = $this->settings_model->getSettings();
            $autosms = $this->sms_model->getAutoSmsByType('patient');
            $message = $autosms->message;
            $to = $phone;
            $name1 = explode(' ', $name);
            if (!isset($name1[1])) {
                $name1[1] = null;
            }
            $data1 = array(
                'firstname' => $name1[0],
                'lastname' => $name1[1],
                'name' => $name,
                'doctor' => $doctor,
                'company' => $set['settings']->system_vendor
            );
            //   if (!empty($sms)) {
            // $this->sms->sendSmsDuringPatientRegistration($patient_user_id);
            if ($autosms->status == 'Active') {
                $messageprint = $this->parser->parse_string($message, $data1);
                $data2[] = array($to => $messageprint);
                $this->sms->sendSms($to, $message, $data2);
            }
            //end
            //  }
            //email

            $autoemail = $this->email_model->getAutoEmailByType('patient');
            if ($autoemail->status == 'Active') {
                $emailSettings = $this->email_model->getEmailSettings();
                $message1 = $autoemail->message;
                $messageprint1 = $this->parser->parse_string($message1, $data1);
                $this->email->from($emailSettings->admin_email);
                $this->email->to($email);
                $this->email->subject('Appointment confirmation');
                $this->email->message($messageprint1);
                $this->email->send();
            }
            
            //Add Checkup
            $checkup = array();
            $checkup['patient_id'] = $patient_user_id;
            $checkup['form_id'] = $_POST['form_id'];
            $checkup['hospital_id'] = $hospital_id;
            
            $temp_id = $this->checkup_model->insertTemplate('checkup',$checkup);
            foreach($_POST as $key => $val) {
                $notInFields = array('campid', 'doctor', 'name', 'email', 'password', 'address', 'phone', 'sex', 'birthdate', 'bloodgroup', 'sms', 'id', 'p_id', 'form_id', 'submit', 'tags_3', 'patient_id');
                //if($key != 'id' && $key != 'patient_id' && $key != 'form_id' && $key != 'submit' && $key != 'tags_3') {
                if (!in_array($key, $notInFields)) {
                    if(is_array($_POST[$key])) {
                        $imp = implode(',',$_POST[$key]);
                        $val = $imp;
                    }
                    $insert = array();
                    $insert['checkup_id'] = $temp_id;
                    $insert['field_id'] = $key;
                    $insert['field_values'] = $val;
                    $tf = $this->checkup_model->insertTemplate('checkup_datas',$insert);
                }
            }
            if(!empty($_POST['tags_3'])) {
                $getTagId = $this->checkup_model->getTagId($_POST['tags_3']);
                $insert = array();
                $insert['checkup_id'] = $temp_id;
                $insert['tags'] = $getTagId;
                $tf = $this->checkup_model->insertTemplate('checkup_tags',$insert);
            }
            //pre($_POST['tags_4']);
            if(!empty($_POST['tags_4'])) {
                $getTagId = $this->checkup_model->getRiskId($_POST['tags_4']);
                $insert = array();
                $insert['checkup_id'] = $temp_id;
                $insert['patient_id'] = $patient_user_id;
                $insert['risk'] = $getTagId;
                $insert['type'] = $_POST['risk_type'];
                $insert['note'] = $_POST['note'];
                $tf = $this->checkup_model->insertTemplate('patient_risk',$insert);
            }
            $resData['code'] = 200;
            $resData['status'] = 'Success';
            $resData['response'] = "Patient Created Successfully.";
        }
        echo json_encode($resData);
    }

    public function add_new_checkup() {
        $postdata = file_get_contents("php://input");
        $_POST = (array) json_decode($postdata);

        //echo $id; exit;
        if($this->input->post()) {
            //echo "<pre>"; print_r($_POST); exit;
            if($_POST['id']) {
                //echo "<pre>"; print_r($_POST); exit;
                $id = $_POST['id'];
                $checkup['patient_id'] = $_POST['patient_id'];
                $checkup['form_id'] = $_POST['form_id'];
                $checkup['hospital_id'] = $_POST['hospital_id'];
                $this->checkup_model->updateCheckup($id,$checkup);
                $this->checkup_model->deleteCheckupDatas($id);
                
                foreach($_POST as $key => $val) {
                    if($key != 'id' && $key != 'patient_id' && $key != 'form_id' && $key != 'submit' && $key != 'hospital_id' && $key != 'tags_3' && $key != 'tag_4' && $key != 'note' && $key != 'risk_type') {
                        if(is_array($_POST[$key])) {
                            $imp = implode(',',$_POST[$key]);
                            $val = $imp;
                        }
                        $insert = array();
                        $insert['checkup_id'] = $id;
                        $insert['field_id'] = $key;
                        $insert['field_values'] = $val;
                        $tf = $this->checkup_model->insertTemplate('checkup_datas',$insert);
                    }
                }
                if(!empty($_POST['tags_3'])) {
                    $getTagId = $this->checkup_model->getTagId($_POST['tags_3']);
                    $this->checkup_model->delete_checkup_tags($id);
                    $insert = array();
                    $insert['checkup_id'] = $id;
                    $insert['tags'] = $getTagId;
                    $tf = $this->checkup_model->insertTemplate('checkup_tags',$insert);
                }
                if(!empty($_POST['tags_4'])) {
                    $getTagId = $this->checkup_model->getRiskId($_POST['tags_4']);
                    $insert = array();
                    $insert['checkup_id'] = $id;
                    $insert['patient_id'] = $_POST['patient_id'];
                    $insert['risk'] = $getTagId;
                    $insert['type'] = $_POST['risk_type'];
                    $insert['note'] = $_POST['note'];
                    $tf = $this->checkup_model->updateTemplate('patient_risk',$insert);
                }
                $resData['code'] = 200;
                $resData['status'] = 'Success';
                $resData['response'] = "Checkup Updated Successfully.";
            } else {
                //echo "<pre>"; print_r($_POST); exit;
                $checkup['patient_id'] = $_POST['patient_id'];
                $checkup['form_id'] = $_POST['form_id'];
                $checkup['hospital_id'] = $_POST['hospital_id'];
                
                $temp_id = $this->checkup_model->insertTemplate('checkup',$checkup);
                foreach($_POST as $key => $val) {
                    if($key != 'id' && $key != 'patient_id' && $key != 'form_id' && $key != 'submit' && $key != 'tags_3' && $key != 'hospital_id' && $key != 'tag_4' && $key != 'note' && $key != 'risk_type') {
                        if(is_array($_POST[$key])) {
                            $imp = implode(',',$_POST[$key]);
                            $val = $imp;
                        }
                        $insert = array();
                        $insert['checkup_id'] = $temp_id;
                        $insert['field_id'] = $key;
                        $insert['field_values'] = $val;
                        $tf = $this->checkup_model->insertTemplate('checkup_datas',$insert);
                    }
                }
                if(!empty($_POST['tags_3'])) {
                    $getTagId = $this->checkup_model->getTagId($_POST['tags_3']);
                    $insert = array();
                    $insert['checkup_id'] = $temp_id;
                    $insert['tags'] = $getTagId;
                    $tf = $this->checkup_model->insertTemplate('checkup_tags',$insert);
                }
                
                if(!empty($_POST['tags_4'])) {
                    $getTagId = $this->checkup_model->getRiskId($_POST['tags_4']);
                    $insert = array();
                    $insert['checkup_id'] = $temp_id;
                    $insert['patient_id'] = $_POST['patient_id'];
                    $insert['risk'] = $getTagId;
                    $insert['type'] = $_POST['risk_type'];
                    $insert['note'] = $_POST['note'];
                    $tf = $this->checkup_model->insertTemplate('patient_risk',$insert);
                }
                $resData['code'] = 200;
                $resData['status'] = 'Success';
                $resData['response'] = "Checkup Added Successfully.";
            }
            //echo "<pre>"; print_r($_POST); exit;
            echo json_encode($resData);
        }
        
    }

    public function checkup_delete() {
        $postdata = file_get_contents("php://input");
        $_POST = (array) json_decode($postdata);
        
        $resData = array();
        $id = $_POST['id'];
        $this->checkup_model->deleteCheckup($id);
        $this->checkup_model->delete_checkup_tags($id);
        $resData['code'] = 200;
        $resData['status'] = 'Success';
        $resData['response'] = "Checkup Deleted Successfully.";
        echo json_encode($resData);
    }

}
