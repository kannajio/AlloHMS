<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accountant extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('accountant_model');

        $permissions_check = $this->settings_model->modules();
        if (!$this->ion_auth->in_group(array('admin')) && !in_array("Accountant", $permissions_check) &&  !in_array("Human Resource", $permissions_check)) {
            redirect('home/permission');
        }
    }

    public function index() {

        $data['accountants'] = $this->accountant_model->getAccountant();
        $data['permissions'] = $this->db->get('permission_features')->result();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('accountant', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $data['permissions'] = $this->db->get('permission_features')->result();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[500]|xss_clean');
        // Validating Phone Field           
        //$this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("accountant/editAccountant?id=$id");
            } else {
                $data['permissions'] = $this->db->get('permission_features')->result();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
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
                    'phone' => $phone
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone
                );
            }

            $username = $this->input->post('name');
            $per = $this->input->post('permission');
            $permission = implode(',', $per);
            $additional_data = array(
                'permissions' => $permission
            );
            if (empty($id)) {     // Adding New Accountant
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                    redirect('accountant');
                } else {
                    $dfg = 3;
                    $this->ion_auth->register($username, $password, $email, $phone, $dfg,$additional_data);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->accountant_model->insertAccountant($data);
                    $accountant_user_id = $this->db->get_where('accountant', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->accountant_model->updateAccountant($accountant_user_id, $id_info);
                    $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                    $this->ion_auth->updateSerialId('accountant', $ion_user_id,$this->hospital_id);
                    $this->session->set_flashdata('feedback', lang('added'));
                }
            } else { // Updating Accountant
                $ion_user_id = $this->db->get_where('accountant', array('id' => $id))->row()->ion_user_id;
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
               $this->accountant_model->updateIonUserId($username, $email, $password, $phone, $ion_user_id, $permission);
                $this->accountant_model->updateAccountant($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('accountant');
        }
    }

    function getAccountant() {
        $data['accountants'] = $this->accountant_model->getAccountant();
        $this->load->view('accountant', $data);
    }

    function editAccountant() {
        $data = array();
        $id = $this->input->get('id');
        $data['accountant'] = $this->accountant_model->getAccountantById($id);
         $data['permissions'] = $this->db->get('permission_features')->result();
          $data['accounts_permissions']  = $this->accountant_model->getAccountantByIonUserIdFromUsers($data['accountant']->ion_user_id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editAccountantByJason() {
        $id = $this->input->get('id');
        $data['accountant'] = $this->accountant_model->getAccountantById($id);
         $all_permissions = $this->db->get('permission_features')->result();
        $accounts_permission = $this->accountant_model->getAccountantByIonUserIdFromUsers($data['accountant']->ion_user_id)->permissions;
       $permissions = explode(',', $accounts_permission);
       $option='<label for="exampleInputEmail1">'. lang('module_permission') .' </label><br>';
       foreach ($all_permissions as $all){
            if ($all->feature == 'Dashboard' || $all->feature == 'Patient' || $all->feature == 'Finance' || $all->feature == 'Report' || $all->feature == 'Email') {
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

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('accountant', array('id' => $id))->row();
        $path = $user_data->img_url;
        chmod($oldPicture, 0644);
        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->accountant_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('accountant');
    }

}

/* End of file accountant.php */
/* Location: ./application/modules/accountant/controllers/accountant.php */
