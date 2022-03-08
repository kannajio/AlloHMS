<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
use Twilio\Rest\Client;
class Encounter extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('appointment/appointment_model');
        $this->load->model('patient/patient_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('auth/otpsms_model');
        $this->load->model('encounter_model');
        
        
        $this->load->model('settings/settings_model');
        $data['settings'] = $this->settings_model->getSettings();
        $permissions_check = $this->settings_model->modules();
        //echo "<pre>"; print_r($permissions_check); exit;
        //  if (!$this->ion_auth->in_group(array('admin','superadmin','human_resource')) && !in_array("Payroll", $permissions_check)) {
        //     redirect('home/permission');
        // }
    }

    public function index() {
        redirect('payroll/ip');
    }

    function ip() {
        $data = array();
        $bytes = random_bytes(4);
        $data['payroll_id'] = strtoupper(bin2hex($bytes)); 
        $data['settings'] = $this->settings_model->getSettings();
        
        //echo "<pre>"; print_r($data['s.no']); exit;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('ip', $data);
        $this->load->view('home/footer');
    }

    
    function getEmployee() {
        $data = $this->encounter_model->getEmployee($_GET['roll']);
        $html = '<option value="">Select Employee</option>';
        foreach($data as $val) {
            $html .= '<option value="'.$val['id'].'">'.$val['username'].'</option>';
        }
        $result['data'] = $html;
        echo json_encode($result);
        //echo "<pre>"; print_r($data); exit;
    }

    public function addIp() {
        $id = $this->input->post('id');
        $data = $this->input->post();
        //echo "<pre>"; print_r($data); exit;
        if($data) {
            if($data['patient'] == 'add_new') {
                $this->session->set_flashdata('feedback', 'Please select Patient');
                redirect('encounter/ip');
            }
            $checkDate = $this->encounter_model->getdata($id);
            $dataInsert['patient_id'] = $data['patient'];
            // $dataInsert['bed'] = $data['bed'];
            if (empty($checkDate)) {
                $checkDupli = $this->encounter_model->checkDuplicate($data['patient']);
                //echo "<pre>"; print_r($checkDate); exit;
                if($checkDupli) {
                    $this->session->set_flashdata('feedback', 'Patient already exist.');
                } else {
                    $this->encounter_model->insertIP($dataInsert);
                    $this->session->set_flashdata('feedback', lang('added'));
                }
            } else {
                $checkDupli = $this->encounter_model->checkDuplicateId($data['patient'], $id);
                //echo "<pre>"; print_r($checkDate); exit;
                if($checkDupli) {
                    $this->session->set_flashdata('feedback', 'Patient already exist.');
                } else {
                    $this->encounter_model->updateIP($id, $dataInsert);
                    $this->session->set_flashdata('feedback', lang('updated'));
                }
            }
            redirect('encounter/ip');
        }
    }


    function editIpByJason() {
        
        $id = $this->input->get('id');
        $data['encounter'] = $this->encounter_model->getEncounterById($id);
        
        $data['patient'] = $this->encounter_model->getPatientById($data['encounter']->patient_id);
        //echo "<pre>"; print_r($data['patient']); exit;
        echo json_encode($data);
    }
    
    function getIpList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $_REQUEST['search']['value'];
        //echo "<pre>"; print_r($_SESSION); exit;
        if ($limit == -1) {
            if (!empty($search)) {
                $data['encounter'] = $this->encounter_model->getEncounterBysearch($search);
            } else {
                $data['encounter'] = $this->encounter_model->getEncounter();
            }
        } else {
            if (!empty($search)) {
                $data['encounter'] = $this->encounter_model->getEncounterByLimitBySearch($limit, $start, $search);
            } else {
                $data['encounter'] = $this->encounter_model->getEncounterByLimit($limit, $start);
            }
        }
        
        //echo $this->db->last_query();
        //exit;
        //  $data['appointments'] = $this->appointment_model->getAppointment();
        $i = 0;
        foreach ($data['encounter'] as $encounter) {
            $i = $i + 1;
            // $load = '<button type="button" class="btn btn-info btn-xs btn_width load" data-toggle="modal" data-id="' . $medicine->id . '">' . lang('load') . '</button>';
            $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $encounter->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</button>';

            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="encounter/delete_ip?id=' . $encounter->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
            $info[] = array(
                $encounter->patientid,
                $encounter->username,
                $encounter->bed_id,
                $option1 . ' ' . $option2
                    //  $options2
            );
            
        }

        if (!empty($data['encounter'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('in_patient')->num_rows(),
                "recordsFiltered" => $this->db->get('in_patient')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

    function delete_ip() {

        if($_GET['id']) {
            $this->encounter_model->deleteIp($_GET['id']);
            $this->session->set_flashdata('feedback', lang('deleted'));
            redirect('encounter/ip');
        }
    }

    function op() {
        $data = array();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
        
        //echo "<pre>"; print_r($data['s.no']); exit;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('op', $data);
        $this->load->view('home/footer');
    }

    function getOpList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        
        if ($limit == -1) {
            if (!empty($search)) {
                $data['appointments'] = $this->encounter_model->getAppointmentBysearch($search);
            } else {
                $data['appointments'] = $this->encounter_model->getAppointment();
            }
        } else {
            if (!empty($search)) {
                $data['appointments'] = $this->encounter_model->getAppointmentByLimitBySearch($limit, $start, $search);
            } else {
                $data['appointments'] = $this->encounter_model->getAppointmentByLimit($limit, $start);
            }
        }
        
        

        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        foreach ($data['appointments'] as $appointment) {
            //$i = $i + 1;
            $disabled = "";
            if($appointment->token) {
                $disabled = "disabled";
            }
            $option2 = '<div style="display:flex"><a class="btn btn-success btn-xs btn_width edit-tag" '.$disabled.' href="encounter/checkin?id=' . $appointment->id . '" onclick="return confirm(\'Are you sure you want to Check-in this Patient?\');">Check-in</a>';
            $option2 .= '<select class="form-control change-status" onchange="changeAppointStatus('.$appointment->id.',this.value);"><option value="Confirmed">Confirmed</option><option Value="Treated">Treated</option><option value="Cancelled">Cancelled</option></select></div>';
            $patientdetails = $this->patient_model->getPatientById($appointment->patient);
            if (!empty($patientdetails)) {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $patientdetails->name . '</a>';
            } else {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $appointment->patientname . '</a>';
            }
            $doctordetails = $this->doctor_model->getDoctorById($appointment->doctor);
            if (!empty($doctordetails)) {
                $doctorname = $doctordetails->name;
            } else {
                $doctorname = $appointment->doctorname;
            }


            $info[] = array(
                $appointment->id,
                $appointment->serial_id,
                $patientname,
                $doctorname,
                $appointment->token,
                $appointment->status,
                $option2
            );
            $i = $i + 1;
        }
        //echo "<pre>"; print_r($info); exit;
        if ($i !== 0) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $i,
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

    public function checkin() {
        //$resCnt = $this->encounter_model->getAllAppointmentCount();
        $resCnt = $this->encounter_model->getCheckinCount();
        //echo "<pre>"; print_r($resCnt); exit;
        if($resCnt) {
            $cnt = ($resCnt[0]->token+1);
        } else {
            $cnt = 100;
        }
        // exit;
        $data = array();
        $data['appointment_id'] = $_GET['id'];
        $data['token'] = $cnt;
        $data['hospital_id'] = $this->session->userdata('hospital_id');
        $result = $this->encounter_model->insertOp($data);
        if($result) {
            $checkPhone = $this->encounter_model->checkPhoneNumber($_GET['id']);
            //echo "<pre>"; print_r($checkPhone); exit;
            if($checkPhone) {
                
                $number = '+91'.$checkPhone->phone;
                $dataOtp = $cnt; 
                
                $sms_gateway = $this->encounter_model->getOTPSettings($this->session->userdata('hospital_id'));
                //echo "<pre>"; print_r($sms_gateway); exit;
                if (!empty($sms_gateway)) {
                        $smsSettings = $this->encounter_model->getSmsSettingsByGatewayName($data['hospital_id'],$sms_gateway->sms_gateway);
                        //echo "<pre>"; print_r($smsSettings); exit;
                        //Send SMS
                    if($smsSettings) {
                        $to = $_SESSION['userinput'];
                        $otp = $dataOtp." is your Token Number.";
                        
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
                                //echo $response->sid;
                                //echo "<pre>"; print_r($response); exit;
                                if($response->sid) {
                                    $this->session->set_flashdata('feedback', 'Token generated Successfully.');
                                } else {
                                    $this->session->set_flashdata('feedback', 'Cannot send OTP to this number.');
                                    redirect('encounter/op');
                                }
                            }
                        } else {
                            $this->session->set_flashdata('feedback', 'Twilio OTP server settings not configured with this application.');
                            redirect('encounter/op');
                        }
                    }
                    //End
                } else {
                    $this->session->set_flashdata('feedback', lang('gatewany_not_selected'));
                    redirect('encounter/op');
                }
            }
            redirect('encounter/op');
        } else {
            $this->session->set_flashdata('feedback', 'Failed to generate Token.');
            redirect('encounter/op');
        }
    }

    function updatestatus() {
        $id = $_GET['id'];
        $dataInsert = array();
        $dataInsert['status'] = $_GET['status'];
        $this->encounter_model->updateStatus($id, $dataInsert);
        return true;
    }

}

/* End of file pharmacy.php */
/* Location: ./application/modules/pharmacy/controllers/pharmacy.php */