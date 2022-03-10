<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Camp extends MX_Controller {

    function __construct() {
        parent::__construct();
        unset($_SESSION['rtype']);
        $this->load->model('camp_model');
        $this->load->model('patient/patient_model');
        $this->load->model('donor/donor_model');
        $this->load->model('checkup/checkup_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('bed/bed_model');
        $this->load->model('lab/lab_model');
        $this->load->model('finance/finance_model');
        $this->load->model('finance/pharmacy_model');
        $this->load->model('sms/sms_model');
        $this->load->module('sms');
        $this->load->model('prescription/prescription_model');
        require APPPATH . 'third_party/stripe/stripe-php/init.php';
        $this->load->model('medicine/medicine_model');
        $this->load->model('doctor/doctor_model');
        $this->load->module('paypal');
        $permissions_check = $this->settings_model->modules();
        if (!$this->ion_auth->in_group(array('admin', 'Accountant', 'Doctor', 'Receptionist', 'Nurse', 'Laboratorist', 'Patient'))) {
            redirect('home/permission');
        }
        
    }

    public function index() {
        $data['camps'] = $this->camp_model->getCamps();
        $data['permissions'] = $this->db->get('permission_features')->result();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('camp', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewCamp() {
        //echo "<pre>"; print_r($_POST); exit;
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $date = date('Y-m-d', strtotime($this->input->post('date')));
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
                'camp_name' => $name,
                'address' => $address,
                'phone' => $phone,
                'camp_date' => $date,
                'hospital_id' => $this->session->userdata('hospital_id')
            );
        } else {
            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'camp_name' => $name,
                'address' => $address,
                'phone' => $phone,
                'camp_date' => $date,
                'hospital_id' => $this->session->userdata('hospital_id')
            );
        }

        if (empty($id)) {     // Adding New Notice
            //echo "<pre>"; print_r($data); exit;
            $this->camp_model->insertCamp($data);
            $this->session->set_flashdata('feedback', lang('added'));
        } else { // Updating Notice
            //echo "<pre>"; print_r($data); exit;
            $this->camp_model->updateCamp($id, $data);
            $this->session->set_flashdata('feedback', lang('updated'));
        }
        // Loading View
        redirect('camp');
    }

    function editcampByJason() {
        $id = $this->input->get('id');
        
        $data['camp'] = $this->camp_model->getCampById($id);
        
        echo json_encode($data);
    }

    function delete_camp() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('camp', array('id' => $id))->row();
        $path = $user_data->img_url;
        chmod($oldPicture, 0644);
        if (!empty($path)) {
            unlink($path);
        }
        $this->camp_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('camp');
    }

    public function patientList($id,$type='') {
        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['groups'] = $this->donor_model->getBloodBank();
        $data['settings'] = $this->settings_model->getSettings();
        $data['campid'] = $id;
        $data['camp'] = $this->camp_model->getCampById($id);
        if($type) {
            $data['type'] = $type;
        }
        
        //echo "<pre>"; print_r($data['camp']); exit;
       // $data['permissions'] = $this->db->get('permission_features')->result();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('patient', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function campDetails($id) {
        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }
        $data['campid'] = $id;
        $data['camp'] = $this->camp_model->getCampById($id);
        //$patients = $this->patient_model->getPatient($id);
        $data['risks'] = $this->camp_model->getRiskById($id);
        //echo "<pre>"; print_r($data); exit;
       // $data['permissions'] = $this->db->get('permission_features')->result();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('camp_dashboard', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewPatient($campid = '') {
//echo $id;
        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }
        
        //echo "<pre>"; print_r($_POST); exit;
        $id = $this->input->post('id');
        $cmpid = $this->input->post('campid');


        if (empty($id)) {
            $limit = $this->patient_model->getLimit();
            if ($limit <= 0) {
                $this->session->set_flashdata('feedback', lang('patient_limit_exceed'));
                redirect('camp/patientList/'.$campid);
            }
        }


        
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



        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
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
        //$this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[2]|max_length[50]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('sex', 'Sex', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('birthdate', 'Birth Date', 'trim|min_length[2]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('bloodgroup', 'Blood Group', 'trim|min_length[1]|max_length[10]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
                $data = array();
                $data['setval'] = 'setval';
                $data['permissions'] = $this->db->get('permission_features')->result();
                $data['doctors'] = $this->doctor_model->getDoctor();
                $data['groups'] = $this->donor_model->getBloodBank();
                $data['campid'] = $campid;
                $data['camp'] = $this->camp_model->getCampById($campid);
                //echo "<pre>"; print_r($data['camp']); exit;
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
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
         /*   $per = $this->input->post('permission');
            $permission = implode(',', $per);
            $additional_data = array(
                'permissions' => $permission
            );*/
            if ($this->ion_auth->email_check($email)) {
                $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                redirect('camp/patientList/'.$cmpid);
            } else {
                $dfg = 5;
                $this->ion_auth->register($username, $password, $email, $phone, $dfg);
                $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                $this->patient_model->insertPatient($data);
                $patient_user_id = $this->db->get_where('patient', array('email' => $email))->row()->id;
                $id_info = array('ion_user_id' => $ion_user_id);
                $this->patient_model->updatePatient($patient_user_id, $id_info);
                $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                $this->ion_auth->updateSerialId('patient', $ion_user_id,$this->hospital_id);
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
                $checkup['hospital_id'] = $this->session->userdata('hospital_id');
                
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
                    $insert['type'] = $_POST['type'];
                    $insert['note'] = $_POST['note'];
                    $tf = $this->checkup_model->insertTemplate('patient_risk',$insert);
                }


                //end

                $this->session->set_flashdata('feedback', lang('added'));
            }
                //    }
            
            // Loading View
            redirect('camp/patientList/'.$cmpid);
        }
    }
    
        
}

/* End of file vital.php */
/* Location: ./application/modules/vital/controllers/vital.php */
