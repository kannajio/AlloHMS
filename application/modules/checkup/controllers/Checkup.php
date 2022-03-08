<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Checkup extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('checkup_model');
        $this->load->model('vitals_model');
        $this->load->model('symptoms_model');
        $this->load->model('formtemplates_model');

       $permissions_check = $this->settings_model->modules();
       //echo "<pre>"; print_r($permissions_check); exit;
        if (!$this->ion_auth->in_group(array('admin','Nurse', 'Laboratorist', 'Doctor','Receptionist')) && !in_array("Checkup", $permissions_check)) {
            redirect('home/permission');
        }
    }

    public function index() {
        $data['checkups'] = $this->checkup_model->getCheckupList();
        $data['permissions'] = $this->db->get('permission_features')->result();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('checkup', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function getCheckupsByPatient($id) {
        $result = $this->checkup_model->getCheckupsByPatient($id);
        return $result;
    }

    public function add_new($id = '') {
        //echo $id; exit;
        if($this->input->post()) {
            //echo json_encode($_POST,true);
            //echo "<pre>"; print_r($_POST); exit;
            if($_POST['id']) {
                //echo "11111111";
                //echo $id;
                //echo "<pre>"; print_r($_POST); exit;
                $checkup['patient_id'] = $_POST['patient_id'];
                $checkup['form_id'] = $_POST['form_id'];
                $checkup['hospital_id'] = $this->session->userdata('hospital_id');
                $this->checkup_model->updateCheckup($id,$checkup);
                $this->checkup_model->deleteCheckupDatas($id);
                
                foreach($_POST as $key => $val) {
                    if($key != 'id' && $key != 'patient_id' && $key != 'form_id' && $key != 'submit' && $key != 'hospital_id' && $key != 'tags_3' && $key != 'tag_4' && $key != 'note' && $key != 'type') {
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
                    $insert['type'] = $_POST['type'];
                    $insert['note'] = $_POST['note'];
                    $tf = $this->checkup_model->updateTemplate('patient_risk',$insert);
                }
                $this->session->set_flashdata('feedback', 'Checkup Updated Successfully');
                redirect('checkup');
            } else {
                
                //echo "<pre>"; print_r($_POST); exit;
                $checkup['patient_id'] = $_POST['patient_id'];
                $checkup['form_id'] = $_POST['form_id'];
                $checkup['hospital_id'] = $this->session->userdata('hospital_id');
                
                $temp_id = $this->checkup_model->insertTemplate('checkup',$checkup);
                foreach($_POST as $key => $val) {
                    if($key != 'id' && $key != 'patient_id' && $key != 'form_id' && $key != 'submit' && $key != 'hospital_id' && $key != 'tags_3' && $key != 'tag_4' && $key != 'note' && $key != 'type') {
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
                    $insert['type'] = $_POST['type'];
                    $insert['note'] = $_POST['note'];
                    $tf = $this->checkup_model->insertTemplate('patient_risk',$insert);
                }
                $this->session->set_flashdata('feedback', 'Checkup Added Successfully');
                redirect('checkup');
            }
            //echo "<pre>"; print_r($_POST); exit;
        }
        if($id) {
            $data['temp'] = $this->checkup_model->getformTempById($id);
            $patient_id = $data['temp']->pid;
            $data['checkupTags'] = $this->checkup_model->getCheckupTagsById($id);
            $data['fields'] = $this->checkup_model->getformFieldsById($data['temp']->tid,$id);
            $data['risk'] = $this->checkup_model->getRiskById($id,$patient_id);
            $data['riskTags'] = $this->checkup_model->getRiskTagsById($id,$patient_id);
        }
        //echo "<pre>"; print_r($data['fields']); exit;
        $data['vitals'] = $this->checkup_model->getVitalandSymptoms();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new_checkup', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function get_taged() {
        $data = $this->checkup_model->getTagedItems();
        //echo "<pre>"; print_r($data); exit;
        echo json_encode($data);
        //echo '[{"id":"14","label":"tagonly","value":"tagonly"}]';
        //echo '[ { "id": "1", "label": "Red-crested Pochard", "value": "Red-crested Pochard" }, { "id": "2", "label": "Sandwich Tern", "value": "Sandwich Tern" }, { "id": "Saxicola rubetra", "label": "Whinchat", "value": "Whinchat" }, { "id": "Saxicola rubicola", "label": "European Stonechat", "value": "European Stonechat" }, { "id": "Lanius senator", "label": "Woodchat Shrike", "value": "Woodchat Shrike" }, { "id": "Coccothraustes coccothraustes", "label": "Hawfinch", "value": "Hawfinch" }, { "id": "Ficedula hypoleuca", "label": "Eurasian Pied Flycatcher", "value": "Eurasian Pied Flycatcher" }, { "id": "Sitta europaea", "label": "Eurasian Nuthatch", "value": "Eurasian Nuthatch" }, { "id": "Pyrrhula pyrrhula", "label": "Eurasian Bullfinch", "value": "Eurasian Bullfinch" }, { "id": "Muscicapa striata", "label": "Spotted Flycatcher", "value": "Spotted Flycatcher" }, { "id": "Carduelis chloris", "label": "European Greenfinch", "value": "3" }, { "id": "Carduelis carduelis", "label": "European Goldfinch", "value": "4" } ]';
    }

    public function setrtype() {
        $_SESSION['rtype'] = $_POST['rtype'];
        echo '1';
        exit;
    }

    public function get_risks() {
        $data = $this->checkup_model->getRisks();
        //echo "<pre>"; print_r($data); exit;
        echo json_encode($data);
        //echo '[{"id":"14","label":"tagonly","value":"tagonly"}]';
        //echo '[ { "id": "1", "label": "Red-crested Pochard", "value": "Red-crested Pochard" }, { "id": "2", "label": "Sandwich Tern", "value": "Sandwich Tern" }, { "id": "Saxicola rubetra", "label": "Whinchat", "value": "Whinchat" }, { "id": "Saxicola rubicola", "label": "European Stonechat", "value": "European Stonechat" }, { "id": "Lanius senator", "label": "Woodchat Shrike", "value": "Woodchat Shrike" }, { "id": "Coccothraustes coccothraustes", "label": "Hawfinch", "value": "Hawfinch" }, { "id": "Ficedula hypoleuca", "label": "Eurasian Pied Flycatcher", "value": "Eurasian Pied Flycatcher" }, { "id": "Sitta europaea", "label": "Eurasian Nuthatch", "value": "Eurasian Nuthatch" }, { "id": "Pyrrhula pyrrhula", "label": "Eurasian Bullfinch", "value": "Eurasian Bullfinch" }, { "id": "Muscicapa striata", "label": "Spotted Flycatcher", "value": "Spotted Flycatcher" }, { "id": "Carduelis chloris", "label": "European Greenfinch", "value": "3" }, { "id": "Carduelis carduelis", "label": "European Goldfinch", "value": "4" } ]';
    }

    public function getPatientinfoWithAddNewOption() {
    // Search term
            $searchTerm = $this->input->post('searchTerm');
    
    // Get users
            $response = $this->checkup_model->getPatientinfoWithAddNewOption($searchTerm);
    
            echo json_encode($response);
    }

    public function getTemplateOption() {
    // Search term
            $searchTerm = $this->input->post('searchTerm');
    
    // Get users
            $response = $this->checkup_model->getTemplateOption($searchTerm);
    
            echo json_encode($response);
    }

    public function getFormFields() {
        $tempid = $this->input->post('tempid');
        $id = $this->input->post('id');
        $response = $this->checkup_model->getformFieldsById($tempid,$id);
        //echo "<pre>"; print_r($response); exit;
        if($id != '' && !empty($response)) {
            $html_vital = $html_symptom = '';
            // Initialize Array with fetched data
            $data = array();
            $v = 0;
            $s = 0;
            foreach ($response as $vs) {
                if($vs['category'] == 'vital') {
                    $html_vital .= '<div class="form-group col-md-6"><label for="exampleInputEmail1">'.$vs["name"].' ('.$vs["unit"].')</label>';
                    if($vs["input_type"] == 'text' || $vs["input_type"] == 'number') {
                        $html_vital .= '<input class="form-control" type="'.$vs["field_type"].'" name="'.$vs["field_id"].'" value="'.$vs["field_values"].'">';
                    }
                    if($vs["input_type"] == 'textarea') {
                        $html_vital .= '<textarea class="form-control" name="'.$vs["field_id"].'" >'.$vs["field_values"].'</textarea>';
                    }
                    $html_vital .= '</div>';
                    $v++;
                } else {
                    $html_symptom .= '<div class="form-group col-md-12"><label for="exampleInputEmail1">'.$vs["name"].'</label>';
                    if($vs["input_type"] == 'text' || $vs["input_type"] == 'number') {
                        $html_symptom .= '<input class="form-control" type="'.$vs["input_type"].'" name="'.$vs["field_id"].'" value="'.$vs["field_values"].'">';
                    }
                    if($vs["input_type"] == 'textarea') {
                        $html_symptom .= '<textarea class="form-control" name="'.$vs["field_id"].'" value="'.$vs["field_values"].'"></textarea>';
                    }
                    if($vs["input_type"] == 'checkbox') {
                        $expCheck = explode(',',$vs["input_options"]);
                        $expval = explode(',',$vs["field_values"]);
                        // $html_symptom .= '<select name="'.$vs["field_id"].'[]" class="form-control">';
                        // foreach($expCheck as $ch) {
                        //     $html_symptom .= '<option value="'.$ch.'">'.$ch.'</option>';
                        // }
                        // $html_symptom .= '</select>';
                        $html_symptom .= '<br>';
                        foreach($expCheck as $ch) {
                            if(in_array($ch,$expval)) {
                                $checked = 'checked';
                            } else {
                                $checked = '';
                            }
                            $html_symptom .= '<label class="checkbox-inline"><input type="checkbox" '.$checked.' name="'.$vs["field_id"].'[]" value="'.$ch.'">'.$ch.'</label>';
                        }
                    }
                    if($vs["input_type"] == 'radio') {
                        $expCheck = explode(',',$vs["input_options"]);
                        $expval = explode(',',$vs["field_values"]);

                        $html_symptom .= '<br>';
                        foreach($expCheck as $ch) {
                            if(in_array($ch,$expval)) {
                                $checked = 'checked';
                            } else {
                                $checked = '';
                            }
                            $html_symptom .= '<label class="radio-inline"><input type="radio" '.$checked.' name="'.$vs["field_id"].'" value="'.$ch.'">'.$ch.'</label>';
                        }
                    }
                    if($vs["input_type"] == 'selectbox') {
                        $expCheck = explode(',',$vs["input_options"]);
                        $expval = explode(',',$vs["field_values"]);
                        
                        $html_symptom .= '<select name="'.$vs["field_id"].'" class="form-control" style="width:50%">';
                        foreach($expCheck as $ch) {
                            if(in_array($ch,$expval)) {
                                $checked = 'selected';
                            } else {
                                $checked = '';
                            }
                            $html_symptom .= '<option value="'.$ch.'" '.$checked.' >'.$ch.'</option>';
                        }
                        $html_symptom .= '</select>';
                    }
                    $html_symptom .= '</div>';
                    $s++;
                }
            }
            if($v > 0) {
                $html .= '<div class="col-lg-12">
                <h4>Vitals</h4> <hr>'.$html_vital.'</div>';
            }
            if($s > 0) {
                $html .= '<div class="col-lg-12">
                <h4>Symptoms</h4> <hr>'.$html_symptom.'</div>';
            }
            
        } else {
            $response1 = $this->checkup_model->getTemplateFields($tempid);
            $html_vital = $html_symptom = '';
            // Initialize Array with fetched data
            $data = array();
            $v = 0;
            $s = 0;
            foreach ($response1 as $vs) {
                if($vs['category'] == 'vital') {
                    $html_vital .= '<div class="form-group col-md-6"><label for="exampleInputEmail1">'.$vs["name"].' ('.$vs["unit"].')</label>';
                    if($vs["input_type"] == 'text' || $vs["input_type"] == 'number') {
                        $html_vital .= '<input class="form-control" type="'.$vs["input_type"].'" name="'.$vs["field_id"].'" value="">';
                    }
                    if($vs["input_type"] == 'textarea') {
                        $html_vital .= '<textarea class="form-control" name="'.$vs["field_id"].'" value=""></textarea>';
                    }
                    $html_vital .= '</div>';
                    $v++;
                } else {
                    $html_symptom .= '<div class="form-group col-md-12"><label for="exampleInputEmail1">'.$vs["name"].'</label>';
                    if($vs["input_type"] == 'text' || $vs["input_type"] == 'number') {
                        $html_symptom .= '<input class="form-control" type="'.$vs["input_type"].'" name="'.$vs["field_id"].'" value="">';
                    }
                    if($vs["input_type"] == 'textarea') {
                        $html_symptom .= '<textarea class="form-control" name="'.$vs["field_id"].'" value=""></textarea>';
                    }
                    if($vs["input_type"] == 'checkbox') {
                        $expCheck = explode(',',$vs["input_options"]);
                        // $html_symptom .= '<select name="'.$vs["field_id"].'[]" class="form-control">';
                        // foreach($expCheck as $ch) {
                        //     $html_symptom .= '<option value="'.$ch.'">'.$ch.'</option>';
                        // }
                        // $html_symptom .= '</select>';
                        $html_symptom .= '<br>';
                        foreach($expCheck as $ch) {
                            $html_symptom .= '<label class="checkbox-inline"><input type="checkbox" name="'.$vs["field_id"].'[]" value="'.$ch.'">'.$ch.'</label>';
                        }
                    }
                    if($vs["input_type"] == 'radio') {
                        $expCheck = explode(',',$vs["input_options"]);
                        
                        $html_symptom .= '<br>';
                        foreach($expCheck as $ch) {
                            $html_symptom .= '<label class="radio-inline"><input type="radio" name="'.$vs["field_id"].'" value="'.$ch.'">'.$ch.'</label>';
                        }
                    }
                    if($vs["input_type"] == 'selectbox') {
                        $expCheck = explode(',',$vs["input_options"]);
                        $html_symptom .= '<select name="'.$vs["field_id"].'" class="form-control" style="width:50%">';
                        foreach($expCheck as $ch) {
                            $html_symptom .= '<option value="'.$ch.'">'.$ch.'</option>';
                        }
                        $html_symptom .= '</select>';
                    }
                    $html_symptom .= '</div>';
                    $s++;
                }
            }
            if($v > 0) {
                $html .= '<div class="col-lg-12">
                <h4>Vitals</h4> <hr>'.$html_vital.'</div>';
            }
            if($s > 0) {
                $html .= '<div class="col-lg-12">
                <h4>Symptoms</h4> <hr>'.$html_symptom.'</div>';
            }
            $html .= '';
        }
        echo $html;
        exit;
        //echo json_encode($data);
    }

    public function checkup_delete() {
        $id = $_GET['id'];
        $this->checkup_model->deleteCheckup($id);
        $this->checkup_model->delete_checkup_tags($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('checkup');
    }

    // public function getvitals123() {
    //     $searchTerm = $this->input->post('searchTerm');
    //     $vitals = $this->checkup_model->getVitalandSymptoms($searchTerm);
    //     $data = array();
    //     foreach ($vitals as $vs) {
    //         $data[] = array("id" => $vs->id, "text" => $vs->name);
    //     }
    //     return $data;
    // }

    
    

    /**VITALS */
    public function vitals() {

        $data['vitals'] = $this->vitals_model->getVital();
        $data['permissions'] = $this->db->get('permission_features')->result();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('vitals', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewVital() {
        //echo "<pre>"; print_r($_POST); exit;
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $unit = $this->input->post('unit');
        $status = $this->input->post('status');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field
        
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("checkup/vitals/editVital?id=$id");
            } else {
                $data['permissions'] = $this->db->get('permission_features')->result();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_vitals', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $checkVitals = $this->vitals_model->checkVitals($name, $id);
            if($checkVitals) {
                $this->session->set_flashdata('errormsg', 'Vital name already exist');
                // Loading View
                redirect('checkup/vitals');
                exit;
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
                    'unit' => $unit,
                    'status' => $status,
                    'input_type' => $_POST['input_type'],
                    'category' => 'vital',
                    'hospital_id' => $this->session->userdata('hospital_id')
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'name' => $name,
                    'unit' => $unit,
                    'status' => $status,
                    'input_type' => $_POST['input_type'],
                    'category' => 'vital',
                    'hospital_id' => $this->session->userdata('hospital_id')
                );
            }

            if (empty($id)) {     // Adding New Notice
                $this->vitals_model->insertVital($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating Notice
                $this->vitals_model->updateVital($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('checkup/vitals');
        }
    }

    function getVital() {
        $data['vitals'] = $this->vitals_model->getVital();
        $this->load->view('vitals', $data);
    }

    function editVital() {
        $data = array();
        $id = $this->input->get('id');
        $data['vitals'] = $this->vitals_model->getVitalById($id);
        $data['permissions'] = $this->db->get('permission_features')->result();
        $data['accounts_permissions']  = $this->vitals_model->getVitalByIonUserIdFromUsers($data['vitals']->ion_user_id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_vitals', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editVitalByJason() {
        $id = $this->input->get('id');
        
        $data['vitals'] = $this->vitals_model->getVitalById($id);
        $all_permissions = $this->db->get('permission_features')->result();
        $accounts_permission = $this->vitals_model->getVitalByIonUserIdFromUsers($data['vitals']->ion_user_id)->permissions;
       $permissions = explode(',', $accounts_permission);
       //echo "<pre>"; print_r($accounts_permission); exit;
       $option='<label for="exampleInputEmail1">'. lang('module_permission') .' </label><br>';
       foreach ($all_permissions as $all){
            if ($all->feature == 'Dashboard' || $all->feature == 'Human Resource' || $all->feature == 'Email' || $all->feature == 'Payroll') {
           $option .='<div class="col-md-6">';
           if(in_array($all->feature , $permissions)){
           $option .='<input type="checkbox" name="permission[]" value="' . $all->feature . '" checked/> <label for="exampleInputEmail1">' . $all->feature  . '</label><br>';
           }else{
                $option .='<input type="checkbox" name="permission[]" value="' . $all->feature . '"/> <label for="exampleInputEmail1">' . $all->feature  . '</label><br>';
             }
              $option .='</div>';
           }
       }
           $data['option']=$option;
        echo json_encode($data);
    }

    function delete_vital() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('vital_symptoms', array('id' => $id))->row();
        $path = $user_data->img_url;
        chmod($oldPicture, 0644);
        if (!empty($path)) {
            unlink($path);
        }
        $this->vitals_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('checkup/vitals');
    }

    /**SYMPTOMS */
    public function symptoms() {

        $data['symptoms'] = $this->symptoms_model->getSymptom();
        $data['permissions'] = $this->db->get('permission_features')->result();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('symptoms', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewSymptom() {
//echo "<pre>"; print_r($_POST); exit;
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $status = $this->input->post('status');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field
        
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("checkup/symptoms/editSymptom?id=$id");
            } else {
                $data['permissions'] = $this->db->get('permission_features')->result();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $checkVitals = $this->symptoms_model->checkSymptom($name, $id);
            if($checkVitals) {
                $this->session->set_flashdata('errormsg', 'Symptom name already exist');
                // Loading View
                redirect('checkup/symptoms');
                exit;
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
                    'status' => $status,
                    'category' => 'symptom',
                    'hospital_id' => $this->session->userdata('hospital_id'),
                    'input_type' => $_POST['input_type'],
                    'input_options' => $_POST['input_options']
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'name' => $name,
                    'status' => $status,
                    'category' => 'symptom',
                    'hospital_id' => $this->session->userdata('hospital_id'),
                    'input_type' => $_POST['input_type'],
                    'input_options' => $_POST['input_options']
                );
                
            }

            if (empty($id)) {     // Adding New Notice
                $this->symptoms_model->insertSymptom($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating Notice
                $this->symptoms_model->updateSymptom($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('checkup/symptoms');
        }
    }

    function getSymptom() {
        $data['symptoms'] = $this->symptoms_model->getSymptom();
        $this->load->view('symptoms', $data);
    }

    function editSymptom() {
        $data = array();
        $id = $this->input->get('id');
        $data['symptoms'] = $this->symptoms_model->getSymptomById($id);
        $data['permissions'] = $this->db->get('permission_features')->result();
        $data['accounts_permissions']  = $this->symptoms_model->getSymptomByIonUserIdFromUsers($data['symptoms']->ion_user_id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editSymptomByJason() {
        $id = $this->input->get('id');
        $data['symptoms'] = $this->symptoms_model->getSymptomById($id);
        
         $all_permissions = $this->db->get('permission_features')->result();
        $accounts_permission = $this->symptoms_model->getSymptomByIonUserIdFromUsers($data['symptoms']->ion_user_id)->permissions;
       $permissions = explode(',', $accounts_permission);
       //echo "<pre>"; print_r($permissions); exit;
       $option='<label for="exampleInputEmail1">'. lang('module_permission') .' </label><br>';
       foreach ($all_permissions as $all){
            if ($all->feature == 'Dashboard' || $all->feature == 'Human Resource' || $all->feature == 'Email' || $all->feature == 'Payroll') {
           $option .='<div class="col-md-6">';
           if(in_array($all->feature , $permissions)){
           $option .='<input type="checkbox" name="permission[]" value="' . $all->feature . '" checked/> <label for="exampleInputEmail1">' . $all->feature  . '</label><br>';
           }else{
                $option .='<input type="checkbox" name="permission[]" value="' . $all->feature . '"/> <label for="exampleInputEmail1">' . $all->feature  . '</label><br>';
             }
              $option .='</div>';
           }
       }
           $data['option']=$option;
        echo json_encode($data);
    }

    function delete_symptom() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('vital_symptoms', array('id' => $id))->row();
        $path = $user_data->img_url;
        chmod($oldPicture, 0644);
        if (!empty($path)) {
            unlink($path);
        }
        $this->symptoms_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('checkup/symptoms');
    }

    public function formtemplates() {
        $data['templates'] = $this->formtemplates_model->getTemplates();
        $data['permissions'] = $this->db->get('permission_features')->result();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('form_template', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function add_new_template($id = '') {
        //echo $id; exit;
        if($this->input->post()) {
            $checkVitals = $this->formtemplates_model->checkTemplate($_POST['name'], $_POST['id']);
            if($checkVitals) {
                $this->session->set_flashdata('errormsg', 'Template name already exist');
                // Loading View
                redirect('checkup/add_new_template/'.$id);
                exit;
            } 
            if($_POST['id']) {
                //echo "11111111";
                // echo $id;
                 //echo "<pre>"; print_r($_POST); exit;
                $name['name'] = $_POST['name'];
                $name['status'] = $_POST['status'];
                $this->formtemplates_model->updateTemplate($id,$name);
                $this->formtemplates_model->deleteTemplateFields($id);
                $i=0;
                foreach($_POST['vitals'] as $val) {
                    $checkVitals = $this->formtemplates_model->checkTemplateFields($id, $val);
                    if($checkVitals == 0) {
                        $insert = array();
                        if($val) {
                            $insert['template_id'] = $id;
                            $insert['field_id'] = $val;
                            if($val) {
                                $tf = $this->formtemplates_model->insertTemplate('template_fields',$insert);
                            }
                        }
                    }
                    $i++;
                }
                $this->session->set_flashdata('feedback', 'Template Updated Successfully');
                redirect('checkup/formtemplates');
            } else {
                //echo "<pre>"; print_r($_POST); exit;
                $name['name'] = $_POST['name'];
                $name['hospital_id'] = $this->session->userdata('hospital_id');
                $temp_id = $this->formtemplates_model->insertTemplate('form_templates',$name);
                $i=0;
                foreach($_POST['vitals'] as $val) {
                    $checkVitals = $this->formtemplates_model->checkTemplateFields($temp_id, $val);
                    if($checkVitals == 0) {
                        $insert = array();
                        if($val) {
                            $insert['template_id'] = $temp_id;
                            $insert['field_id'] = $val;
                            if($val) {
                                $tf = $this->formtemplates_model->insertTemplate('template_fields',$insert);
                            }
                        }
                    }
                }
                $this->session->set_flashdata('feedback', 'Template Created Successfully');
                redirect('checkup/formtemplates');
            }
            //echo "<pre>"; print_r($_POST); exit;
        }
        if($id) {
            $data['temp'] = $this->formtemplates_model->getformTempById($id);
            $data['fields'] = $this->formtemplates_model->getformFieldsById($id);
        }
        //echo "<pre>"; print_r($data); exit;
        $data['vitals'] = $this->formtemplates_model->getVitalandSymptoms();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new_template', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function getvitals() {
        $searchTerm = $this->input->post('searchTerm');
        $vitals = $this->formtemplates_model->getVitalandSymptoms($searchTerm);
        $data = array();
        foreach ($vitals as $vs) {
            $data[] = array("id" => $vs->id, "text" => $vs->name);
        }
        return $data;
    }

    
    public function getaddfields() {
        $data = $this->formtemplates_model->getVitalandSymptoms();
        
        $html = '';
            $html .= '<div style="height:40px; clear:both;" class="productdiv" id="'.$_POST['length'].'"><div class="col-xs-6 col-md-6">
            <select name="vitals[]" class="form-control selectpicker" data-live-search="true" ><option value="">--Select--</option>';
            foreach($data as $val) {
                    $html .= '<option value="'.$val->id.'">'.$val->name.'</option>';
            } 
            $html .= '</select>';
            $html .= '</div>';
                $html .= '<a href="javascript:void(0);" class="remove_button" title="Remove field" style="position:relative; top:8px; left:15px"><i class="fa fa-trash"></i></a>
            </div>';
            
            echo $html;
        exit;
    }

    public function form_delete() {
        $id = $_GET['id'];
        $this->formtemplates_model->deleteFormtemplate($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('checkup/formtemplates');
    }

    public function viewCheckup() {
        $id = $_GET['id'];
        //echo $id; exit;
        if($id) {
            $data['temp'] = $this->checkup_model->getformTempById($id);
            $data['checkupTags'] = $this->checkup_model->getCheckupTagsById($id);
            $data['fields'] = $this->checkup_model->getformFieldsById($data['temp']->tid,$id);
        }
        //echo "<pre>"; print_r($data['temp']->tname); exit;
        $data['vitals'] = $this->checkup_model->getVitalandSymptoms();

        $html = '';
        $html .= '<div class="col-lg-12">';
        $html .= '<label for="exampleInputEmail1">'. lang('patient') .'</label> : <span style="padding:5px;">'.$data['temp']->pname.'</span></div>';
        if($data['fields']) {
            $v = 0;
            $s = 0;
            $html_vital = $html_symptom = '';
            
            foreach($data['fields'] as $vs) {
                if($vs["category"]) {
                    if($vs["field_values"]) {
                        if($vs['category'] == 'vital') {
                            $html_vital .= '<div class="form-group col-md-12"><label for="exampleInputEmail1">'.$vs["name"].'</label> :';
                            $html_vital .= '<span style="padding:5px;">'.$vs["field_values"].'</span>';
                            $html_vital .= ' ('.$vs["unit"].')</div>';
                            $v++;
                        } else {
                            $html_symptom .= '<div class="form-group col-md-12"><label for="exampleInputEmail1">'.$vs["name"].'</label> :';
                            $html_symptom .= '<span style="padding:5px;">'.$vs["field_values"].'</span>';
                            $html_symptom .= '</div>';
                            $s++;
                        }
                    }
                }
            }
            if($v > 0) {
                $html .= '<div class="col-lg-12">
                <h5>Vitals</h5> <hr style="margin:5px;">'.$html_vital.'</div>';
            }
            if($s > 0) {
                $html .= '<div class="col-lg-12">
                <h5>Symptoms</h5> <hr style="margin:5px;">'.$html_symptom.'</div>';
            }
        }
        if($data['checkupTags']) {
            $html .= '<div class="col-lg-12"><h5>Other Symptoms</h5> <hr style="margin:5px;"><div class="form-group col-md-12"><span style="padding:5px;">'.str_replace(',',', ',$data['checkupTags']).'</span></div></div>';
        }
        $res = array();
        $res['header'] = $data['temp']->tname;
        $res['html'] = $html;
        echo json_encode($res);
        //echo "<pre>"; print_r($data['temp']); exit;
    }
        
}

/* End of file vital.php */
/* Location: ./application/modules/vital/controllers/vital.php */
