<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payroll extends MX_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('payroll_model');
        
        $this->load->model('settings/settings_model');
        $data['settings'] = $this->settings_model->getSettings();
        $permissions_check = $this->settings_model->modules();
        //echo "<pre>"; print_r($permissions_check); exit;
        //  if (!$this->ion_auth->in_group(array('admin','superadmin','human_resource')) && !in_array("Payroll", $permissions_check)) {
        //     redirect('home/permission');
        // }
    }

    public function index() {
        
        redirect('payroll/home');
    }

    function home() {
        $data = array();
        $bytes = random_bytes(4);
        $data['payroll_id'] = strtoupper(bin2hex($bytes)); 
        $data['settings'] = $this->settings_model->getSettings();
        $sno = $this->payroll_model->getsno();
        if($sno) {
            $data['sno'] = $sno->id+1;
        } else {
            $data['sno'] = 1;
        }
        //echo "<pre>"; print_r($data['s.no']); exit;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('payroll', $data);
        $this->load->view('home/footer');
    }

    function mypayroll() {
        $data = array();
        $bytes = random_bytes(4);
        $data['payroll_id'] = strtoupper(bin2hex($bytes)); 
        $data['settings'] = $this->settings_model->getSettings();
        $sno = $this->payroll_model->getsno();
        if($sno) {
            $data['sno'] = $sno->id+1;
        } else {
            $data['sno'] = 1;
        }
        //echo "<pre>"; print_r($data['s.no']); exit;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('mypayroll', $data);
        $this->load->view('home/footer');
    }

    function getEmployee() {
        $data = $this->payroll_model->getEmployee($_GET['roll']);
        $html = '<option value="">Select Employee</option>';
        foreach($data as $val) {
            $html .= '<option value="'.$val['id'].'">'.$val['username'].'</option>';
        }
        $result['data'] = $html;
        echo json_encode($result);
        //echo "<pre>"; print_r($data); exit;
    }

    public function addPayroll() {
        $id = $this->input->post('id');
        $data = $this->input->post();
        
        if($data) {
            $checkDate = $this->payroll_model->getdata($id);
            unset($data['submit']);
            $monthNum  = $data['month'];
            $data['month_name'] = date('F', mktime(0, 0, 0, $monthNum, 10));
            if (empty($checkDate)) {
                //echo "<pre>"; print_r($checkDate); exit;
                $this->payroll_model->insertPayroll($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->payroll_model->updatePayroll($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('payroll');
        }
    }

    public function payment() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->pharmacy_model->getPayment();
        // $data['payments'] = $this->pharmacy_model->getPaymentByPageNumber($page_number);


        $data['pagee_number'] = $page_number;
        $data['p_n'] = '0';

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/payment', $data);
        $this->load->view('home/footer'); // just the header file
    }


    //purchase
    public function purchase() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['settings'] = $this->settings_model->getSettings();
      //  $data['payments'] = $this->pharmacy_model->getPurchase();
        // $data['payments'] = $this->pharmacy_model->getPaymentByPageNumber($page_number);


        $data['pagee_number'] = $page_number;
        $data['p_n'] = '0';

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/purchase', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function paymentByPageNumber() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['payments'] = $this->pharmacy_model->getPaymentByPageNumber($page_number);
        $data['pagee_number'] = $page_number;
        $data['p_n'] = $page_number;
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/payment', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPaymentView() {
        $data = array();
        $data['discount_type'] = $this->pharmacy_model->getDiscountType();
        $data['settings'] = $this->settings_model->getSettings();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/add_payment_view', $data);
        $this->load->view('home/footer'); // just the header file
    }


    public function addPurchaseView() {
     //   $data = array();
     //   $data['discount_type'] = $this->pharmacy_model->getDiscountType();
        $data['settings'] = $this->settings_model->getSettings();
      //  $data['medicines'] = $this->medicine_model->getMedicine();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/add_purchase_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPaymentViewDebug() {
        $data = array();
        $data['discount_type'] = $this->pharmacy_model->getDiscountType();
        $data['settings'] = $this->settings_model->getSettings();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/add_payment_view_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function getMedicineByKeyJason() {
        $key = $this->input->get('keyword');
        $medicines = $this->medicine_model->getMedicineByKeyForPos($key);

        $data[] = array();
        $lists = array();
        $options = array();
        $selected = array();
        foreach ($medicines as $medicine) {
            if ($medicine->quantity > 0) {
                $lists[] = '<li class="ooppttiioonn ms-elem-selectable" data-id="' . $medicine->id . '" data-s_price="' . (float) $medicine->s_price . '" data-m_name="' . $medicine->name . '" data-c_name="' . trim($medicine->company) . '" id="' . $medicine->id . '-selectable"><span>' . $medicine->name . '</span></li>';
                $options[] = '<option class="ooppttiioonn" data-id="' . $medicine->id . '" data-s_price="' . (float) $medicine->s_price . '" data-m_name="' . $medicine->name . '" data-c_name="' . trim($medicine->company) . '" value="' . $medicine->id . '">' . $medicine->name . '</option>';
                $selected[] = '<li class="ooppttiioonn ms-elem-selection" data-id="' . $medicine->id . '" data-s_price="' . (float) $medicine->s_price . '"data-m_name="' . $medicine->name . '"data-c_name="' . trim($medicine->company) . '" id="' . $medicine->id . '-selection" style="display: none;"><span> ' . $medicine->name . '  </span></li>';
            }
        }
        $data['ltst'] = $lists;
        $data['opp'] = $options;
        $data['slt'] = $selected;

        $lists = NULL;
        $options = NULL;
        $selected = NULL;

        echo json_encode($data);
    }

    function searchPayment() {
        $page_number = $this->input->get('page_number');
        if (empty($page_number)) {
            $page_number = 0;
        }
        $data['p_n'] = $page_number;
        $key = $this->input->get('key');
        $data['payments'] = $this->pharmacy_model->getPaymentByKey($page_number, $key);
        $data['settings'] = $this->settings_model->getSettings();
        $data['pagee_number'] = $page_number;
        $data['key'] = $key;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/payment', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addPayment() {
        $id = $this->input->post('id');
        $item_selected = array();
        $quantity = array();
        $item_selected = $this->input->post('medicine_id');
        $quantity = $this->input->post('quantity');

        if (empty($item_selected)) {
            $this->session->set_flashdata('feedback', lang('select_an_item'));
            redirect('finance/pharmacy/addPaymentView');
        } else {
            $item_quantity_array = array();
            $item_quantity_array = array_combine($item_selected, $quantity);
        }
        foreach ($item_quantity_array as $key => $value) {
            $current_medicine = $this->db->get_where('medicine', array('id' => $key))->row();
            $unit_price = $current_medicine->s_price;
            $cost = $current_medicine->price;
            $current_stock = (string) $current_medicine->quantity;
            $qty = $value;
            if ($current_stock < $qty) {
                $this->session->set_flashdata('quantity_check', 'Unsufficient Quantity selected for Medicine ' . $current_medicine->name);
                redirect('pharmacy/addPaymentView');
            }
            $item_price[] = $unit_price * $value;
            $category_name[] = $key . '*' . $unit_price . '*' . $qty . '*' . $cost;
        }

        $category_name = implode(',', $category_name);

        $patient = $this->input->post('patient');
        $date = time();
        $discount = $this->input->post('discount');
        $amount_received = $this->input->post('amount_received');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Price Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Price Field
        $this->form_validation->set_rules('discount', 'Discount', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo 'form validate noe nai re';
            // redirect('accountant/add_new'); 
        } else {
            $amount = array_sum($item_price);
            $sub_total = $amount;
            $discount_type = $this->pharmacy_model->getDiscountType();

            if ($discount_type == 'flat') {
                $flat_discount = $discount;
                $gross_total = $sub_total - $flat_discount;
            } else {
                $flat_discount = $amount * ($discount / 100);
                $gross_total = $sub_total - $flat_discount;
            }

            $data = array();
            if (empty($id)) {
                $data = array(
                    'category_name' => $category_name,
                    'patient' => $patient,
                    'date' => $date,
                    'amount' => $sub_total,
                    'discount' => $discount,
                    'flat_discount' => $flat_discount,
                    'gross_total' => $gross_total,
                    'amount_received' => $amount_received,
                    'status' => 'unpaid',
                );
                $this->pharmacy_model->insertPayment($data);
                $inserted_id = $this->db->insert_id();
                foreach ($item_quantity_array as $key => $value) {
                    $previous_qty = $this->db->get_where('medicine', array('id' => $key))->row()->quantity;
                    $new_qty = $previous_qty - $value;
                    $this->db->where('id', $key);
                    $this->db->update('medicine', array('quantity' => $new_qty));
                }
                $this->session->set_flashdata('feedback', lang('added'));
                redirect("finance/pharmacy/invoice?id=" . "$inserted_id");
            } else {
                $data = array(
                    'category_name' => $category_name,
                    'patient' => $patient,
                    'amount' => $sub_total,
                    'discount' => $discount,
                    'flat_discount' => $flat_discount,
                    'gross_total' => $gross_total,
                    'amount_received' => $amount_received,
                );

                $original_sale = $this->pharmacy_model->getPaymentById($id);
                $original_sale_quantity = array();
                $original_sale_quantity = explode(',', $original_sale->category_name);
                $o_s_value[] = array();
                foreach ($item_quantity_array as $key => $value) {
                    $previous_qty = $this->db->get_where('medicine', array('id' => $key))->row()->quantity;
                    foreach ($original_sale_quantity as $osq_key => $osq_value) {
                        $o_s_value = explode('*', $osq_value);
                        if ($o_s_value[0] == $key) {
                            $previous_qty1 = $previous_qty + $o_s_value[2];
                            $new_qty = $previous_qty1 - $value;
                            $this->db->where('id', $key);
                            $this->db->update('medicine', array('quantity' => $new_qty));
                        }
                    }
                }
                $this->pharmacy_model->updatePayment($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
                redirect("finance/pharmacy/invoice?id=" . "$id");
            }
        }
    }

    function editPayment() {
        if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Pharmacist'))) {
            $data = array();
            $data['discount_type'] = $this->pharmacy_model->getDiscountType();
            $data['settings'] = $this->settings_model->getSettings();
            $data['medicines'] = $this->medicine_model->getMedicine();
            $id = $this->input->get('id');
            $data['payment'] = $this->pharmacy_model->getPaymentById($id);
            
            if($data['payment']->hospital_id != $this->session->userdata('hospital_id')){
                redirect('home/permission');
            }
            
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('pharmacy/add_payment_view', $data);
            $this->load->view('home/footer'); // just the footer file
        }
    }

    function delete() {
        if ($this->ion_auth->in_group('admin')) {
            $id = $this->input->get('id');
            
            $payment_details = $this->pharmacy_model->getPaymentById($id);
            if($payment_details->hospital_id != $this->session->userdata('hospital_id')){
                redirect('home/permission');
            }
            
            $category_name = $this->pharmacy_model->getPaymentById($id)->category_name;
            $all_product_details = array();
            $all_product_details = explode(',', $category_name);

            foreach ($all_product_details as $key => $value) {
                $product_details = array();
                $product_details = explode('*', $value);
                $product_id = $product_details[0];
                $qty = $product_details[2];
                $previous_qty = $this->medicine_model->getMedicineById($product_details[0])->quantity;
                $new_qty = $previous_qty + $qty;
                $data = array();
                $data = array('quantity' => $new_qty);
                $this->medicine_model->updateMedicine($product_id, $data);
            }

            $this->pharmacy_model->deletePayment($id);
            $this->session->set_flashdata('feedback', lang('deleted'));
            redirect('finance/pharmacy/payment');
        }
    }

    public function expense() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['expenses'] = $this->pharmacy_model->getExpense();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/expense', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseView() {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->pharmacy_model->getExpenseCategory();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/add_expense_view', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpense() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $date = time();
        $amount = $this->input->post('amount');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Generic Name Field
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Company Name Field
        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $data['categories'] = $this->pharmacy_model->getExpenseCategory();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('add_expense_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            if (empty($id)) {
                $data = array(
                    'category' => $category,
                    'date' => $date,
                    'amount' => $amount
                );
            } else {
                $data = array(
                    'category' => $category,
                    'amount' => $amount
                );
            }
            if (empty($id)) {
                $this->pharmacy_model->insertExpense($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->pharmacy_model->updateExpense($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('finance/pharmacy/expense');
        }
    }

    function editExpense() {
        $data = array();
        $data['categories'] = $this->pharmacy_model->getExpenseCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $id = $this->input->get('id');
        $data['expense'] = $this->pharmacy_model->getExpenseById($id);
        
        if($data['expense']->hospital_id != $this->session->userdata('hospital_id')){
            redirect('home/permission');
        }
        
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/add_expense_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function deleteExpense() {
        $id = $this->input->get('id');
        
        $data['expense'] = $this->pharmacy_model->getExpenseById($id);        
        if($data['expense']->hospital_id != $this->session->userdata('hospital_id')){
            redirect('home/permission');
        }
        
        $this->pharmacy_model->deleteExpense($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('finance/pharmacy/expense');
    }

    public function expenseCategory() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->pharmacy_model->getExpenseCategory();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/expense_category', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseCategoryView() {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/add_expense_category');
        $this->load->view('home/footer'); // just the header file
    }

    public function addExpenseCategory() {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $data['settings'] = $this->settings_model->getSettings();
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('pharmacy/add_expense_category');
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array('category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->pharmacy_model->insertExpenseCategory($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->pharmacy_model->updateExpenseCategory($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('finance/pharmacy/expenseCategory');
        }
    }

    function editExpenseCategory() {
        $data = array();
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['category'] = $this->pharmacy_model->getExpenseCategoryById($id);
               
        if($data['category']->hospital_id != $this->session->userdata('hospital_id')){
            redirect('home/permission');
        }
        
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/add_expense_category', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function deleteExpenseCategory() {
        $id = $this->input->get('id');
        
        $data['category'] = $this->pharmacy_model->getExpenseCategoryById($id);              
        if($data['category']->hospital_id != $this->session->userdata('hospital_id')){
            redirect('home/permission');
        }
        
        $this->pharmacy_model->deleteExpenseCategory($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('finance/pharmacy/expenseCategory');
    }

    function invoice() {
        $id = $this->input->get('id');        
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->pharmacy_model->getDiscountType();
        $data['payment'] = $this->pharmacy_model->getPaymentById($id);
        if($data['payment']->hospital_id != $this->session->userdata('hospital_id')){
            redirect('home/permission');
        }
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/invoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function printInvoice() {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->pharmacy_model->getDiscountType();
        $data['payment'] = $this->pharmacy_model->getPaymentById($id);
        if($data['payment']->hospital_id != $this->session->userdata('hospital_id')){
            redirect('home/permission');
        }
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/print_invoice', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function amountReceived() {
        $id = $this->input->post('id');
        $amount_received = $this->input->post('amount_received');
        $previous_amount_received = $this->db->get_where('pharmacy_payment', array('id' => $id))->row()->amount_received;
        $amount_received = $amount_received + $previous_amount_received;
        $data = array();
        $data = array('amount_received' => $amount_received);
        $this->pharmacy_model->amountReceived($id, $data);
        redirect('finance/pharmacy/invoice?id=' . $id);
    }

    function amountReceivedFromPT() {
        $id = $this->input->post('id');
        $amount_received = $this->input->post('amount_received');
        $payments = $this->pharmacy_model->getPaymentByPatientId($id);
        foreach ($payments as $payment) {
            if ($payment->gross_total != $payment->amount_received) {
                $due_balance = $payment->gross_total - $payment->amount_received;
                if ($amount_received <= $due_balance) {
                    $data = array();
                    $new_amount_received = $amount_received + $payment->amount_received;
                    $data = array('amount_received' => $new_amount_received);
                    $this->pharmacy_model->amountReceived($payment->id, $data);
                    break;
                } else {
                    $data = array();
                    $new_amount_received = $due_balance + $payment->amount_received;
                    $data = array('amount_received' => $new_amount_received);
                    $this->pharmacy_model->amountReceived($payment->id, $data);
                    $amount_received = $amount_received - $due_balance;
                }
            }
        }
        redirect('finance/pharmacy/invoicePatientTotal?id=' . $id);
    }

    function todaySales() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->pharmacy_model->getPaymentByDate($today, $today_last);

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/today_sales', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function todayExpense() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $hour = 0;
        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 24 * 60 * 60;
        $data['settings'] = $this->settings_model->getSettings();
        $data['expenses'] = $this->pharmacy_model->getExpenseByDate($today, $today_last);

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/today_expenses', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function todayNetCash() {
        $data['today_sales_amount'] = $this->pharmacy_model->todaySalesAmount();
        $data['today_expenses_amount'] = $this->pharmacy_model->todayExpensesAmount();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/today_net_cash', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function salesPerMonth() {

        $payments = $this->pharmacy_model->getPayment();
        foreach ($payments as $payment) {
            $date = $payment->date;
            $month = date('m', $date);
            $year = date('y', $date);
            if ($month = '01') {
                
            }
        }
    }

    function financialReport() {
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 24 * 60 * 60;
        }
        $data = array();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['expense_categories'] = $this->pharmacy_model->getExpenseCategory();


        // if(empty($date_from)&&empty($date_to)) {
        //    $data['payments']=$this->pharmacy_model->get_payment();
        //     $data['ot_payments']=$this->pharmacy_model->get_ot_payment();
        //     $data['expenses']=$this->pharmacy_model->get_expense();
        // }
        // else{

        $data['payments'] = $this->pharmacy_model->getPaymentByDate($date_from, $date_to);
        $data['expenses'] = $this->pharmacy_model->getExpenseByDate($date_from, $date_to);
        // } 
        $data['from'] = $this->input->post('date_from');
        $data['to'] = $this->input->post('date_to');
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/financial_report', $data);
        $this->load->view('home/footer'); // just the footer fi
    }

    function getPaymentList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['payments'] = $this->pharmacy_model->getPaymentBysearch($search);
            } else {
                $data['payments'] = $this->pharmacy_model->getPayment();
            }
        } else {
            if (!empty($search)) {
                $data['payments'] = $this->pharmacy_model->getPaymentByLimitBySearch($limit, $start, $search);
            } else {
                $data['payments'] = $this->pharmacy_model->getPaymentByLimit($limit, $start);
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        $option1 = '';
        $option2 = '';
        $option3 = '';
        foreach ($data['payments'] as $payment) {
            //$i = $i + 1;
            $settings = $this->settings_model->getSettings();
            if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) {
                $option1 = '<a class="btn btn-info btn-xs editbutton" href="finance/pharmacy/editPayment?id=' . $payment->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }
            if ($this->ion_auth->in_group('admin')) {
                $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="finance/pharmacy/delete?id=' . $payment->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            }
            $option3 = '<a class="btn btn-xs green" style="color: #fff;" href="finance/pharmacy/invoice?id=' . $payment->id . '"><i class="fa fa-file-invoice"></i> ' . lang('invoice') . '</a>';
            $options4 = '<a class="btn btn-info btn-xs invoicebutton" title="' . lang('print') . '" style="color: #fff;" href="finance/pharmacy/printInvoice?id=' . $payment->id . '"target="_blank"> <i class="fa fa-print"></i> ' . lang('print') . '</a>';
            if (!empty($payment->flat_discount)) {
                $discount = number_format($payment->flat_discount, 2, '.', ',');
            } else {
                $discount = '0';
            }
            $info[] = array(
                $payment->id,
                date('d/m/y', $payment->date + 11 * 60 * 60),
                $settings->currency . '' . number_format($payment->amount, 2, '.', ','),
                $settings->currency . '' . $discount,
                $settings->currency . '' . number_format($payment->gross_total, 2, '.', ','),
                $option1 . ' ' . $option3 . ' ' . $options4 . ' ' . $option2
            );
            $i = $i + 1;
        }

        if ($data['payments']) {
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

    function previousInvoice() {
        $id = $this->input->get('id');
        $data1 = $this->pharmacy_model->getFirstRowPaymentById();
        if ($id == $data1->id) {
            $data = $this->pharmacy_model->getLastRowPaymentById();
            redirect('finance/pharmacy/invoice?id=' . $data->id);
        } else {
            for ($id1 = $id - 1; $id1 >= $data1->id; $id1--) {

                $data = $this->pharmacy_model->getPreviousPaymentById($id1);
                if (!empty($data)) {
                    redirect('finance/pharmacy/invoice?id=' . $data->id);
                    break;
                } elseif ($id1 == $data1->id) {
                    $data = $this->pharmacy_model->getLastRowPaymentById();
                    redirect('finance/pharmacy/invoice?id=' . $data->id);
                } else {
                    continue;
                }
            }
        }
    }

    function nextInvoice() {
        $id = $this->input->get('id');


        $data1 = $this->pharmacy_model->getLastRowPaymentById();


        //$id1 = $id + 1;
        if ($id == $data1->id) {
            $data = $this->pharmacy_model->getFirstRowPaymentById();
            redirect('finance/pharmacy/invoice?id=' . $data->id);
        } else {
            for ($id1 = $id + 1; $id1 <= $data1->id; $id1++) {

                $data = $this->pharmacy_model->getNextPaymentById($id1);


                if (!empty($data)) {
                    redirect('finance/pharmacy/invoice?id=' . $data->id);
                    break;
                } elseif ($id1 == $data1->id) {
                    $data = $this->pharmacy_model->getFirstRowPaymentById();
                    redirect('finance/pharmacy/invoice?id=' . $data->id);
                } else {
                    continue;
                }
            }
        }
    }

    function daily() {
        $data = array();
        $year = $this->input->get('year');
        $month = $this->input->get('month');

        if (empty($year)) {
            $year = date('Y');
        }
        if (empty($month)) {
            $month = date('m');
        }

        $first_minute = mktime(0, 0, 0, $month, 1, $year);
        $last_minute = mktime(23, 59, 59, $month, date("t", $first_minute), $year);

        $payments = $this->pharmacy_model->getPaymentByDate($first_minute, $last_minute);
        $all_payments = array();
        foreach ($payments as $payment) {
            $date = date('D d-m-y', $payment->date);
            if (array_key_exists($date, $all_payments)) {
                $all_payments[$date] = $all_payments[$date] + $payment->gross_total;
            } else {
                $all_payments[$date] = $payment->gross_total;
            }
        }

        $data['year'] = $year;
        $data['month'] = $month;
        $data['first_minute'] = $first_minute;
        $data['last_minute'] = $last_minute;
        $data['all_payments'] = $all_payments;

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/daily', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function dailyExpense() {
        $data = array();
        $year = $this->input->get('year');
        $month = $this->input->get('month');

        if (empty($year)) {
            $year = date('Y');
        }
        if (empty($month)) {
            $month = date('m');
        }

        $first_minute = mktime(0, 0, 0, $month, 1, $year);
        $last_minute = mktime(23, 59, 59, $month, date("t", $first_minute), $year);

        $expenses = $this->pharmacy_model->getExpenseByDate($first_minute, $last_minute);
        $all_expenses = array();
        foreach ($expenses as $expense) {
            $date = date('D d-m-y', $expense->date);
            if (array_key_exists($date, $all_expenses)) {
                $all_expenses[$date] = $all_expenses[$date] + $expense->amount;
            } else {
                $all_expenses[$date] = $expense->amount;
            }
        }

        $data['year'] = $year;
        $data['month'] = $month;
        $data['first_minute'] = $first_minute;
        $data['last_minute'] = $last_minute;
        $data['all_expenses'] = $all_expenses;



        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/daily_expense', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function monthly() {
        $data = array();
        $year = $this->input->get('year');

        if (empty($year)) {
            $year = date('Y');
        }


        $first_minute = mktime(0, 0, 0, 1, 1, $year);
        $last_minute = mktime(23, 59, 59, 12, 31, $year);

        $payments = $this->pharmacy_model->getPaymentByDate($first_minute, $last_minute);
        $all_payments = array();
        foreach ($payments as $payment) {
            $month = date('m-Y', $payment->date);
            if (array_key_exists($month, $all_payments)) {
                $all_payments[$month] = $all_payments[$month] + $payment->gross_total;
            } else {
                $all_payments[$month] = $payment->gross_total;
            }
        }

        $data['year'] = $year;
        $data['first_minute'] = $first_minute;
        $data['last_minute'] = $last_minute;
        $data['all_payments'] = $all_payments;

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/monthly', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function monthlyExpense() {
        $data = array();
        $year = $this->input->get('year');

        if (empty($year)) {
            $year = date('Y');
        }


        $first_minute = mktime(0, 0, 0, 1, 1, $year);
        $last_minute = mktime(23, 59, 59, 12, 31, $year);

        $expenses = $this->pharmacy_model->getExpenseByDate($first_minute, $last_minute);
        $all_expenses = array();
        foreach ($expenses as $expense) {
            $month = date('m-Y', $expense->date);
            if (array_key_exists($month, $all_expenses)) {
                $all_expenses[$month] = $all_expenses[$month] + $expense->amount;
            } else {
                $all_expenses[$month] = $expense->amount;
            }
        }

        $data['year'] = $year;
        $data['first_minute'] = $first_minute;
        $data['last_minute'] = $last_minute;
        $data['all_expenses'] = $all_expenses;

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pharmacy/monthly_expense', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function productlist()
    {
        $query = $this->input->get('query');
        
        $getProduct = $this->pharmacy_model->getProduct($query);



        echo json_encode($getProduct);
        
    

    }

    function editPayrollByJason() {
        $id = $this->input->get('id');
        $data['payrolls'] = $this->payroll_model->getPayrollById($id);
        $res = $this->payroll_model->getEmployee($data['payrolls']->role);
        $html = '<option value="">Select Employee</option>';
        foreach($res as $val) {
            $selected = '';
            if($val['id'] == $data['payrolls']->emp_id) {
                $selected = 'selected';
            }
            $html .= '<option value="'.$val['id'].'" '.$selected.'>'.$val['username'].'</option>';
        }
        $data['payrolls']->html = $html;
        //echo "<pre>"; print_r($data['payrolls']); exit;
        echo json_encode($data);
    }
    function getMyPayrollList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $_REQUEST['search']['value'];
        //echo "<pre>"; print_r($_SESSION); exit;
        if ($limit == -1) {
            if (!empty($search)) {
                $data['payrolls'] = $this->payroll_model->getMyPayrollBysearch($search);
            } else {
                $data['payrolls'] = $this->payroll_model->getMyPayroll();
            }
        } else {
            if (!empty($search)) {
                $data['payrolls'] = $this->payroll_model->getMyPayrollByLimitBySearch($limit, $start, $search);
            } else {
                $data['payrolls'] = $this->payroll_model->getMyPayrollByLimit($limit, $start);
            }
        }
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // //echo $this->db->last_query();
        // exit;
        //  $data['appointments'] = $this->appointment_model->getAppointment();
        $i = 0;
        foreach ($data['payrolls'] as $payroll) {
            $i = $i + 1;
            $settings = $this->settings_model->getSettings();
            
            // $load = '<button type="button" class="btn btn-info btn-xs btn_width load" data-toggle="modal" data-id="' . $medicine->id . '">' . lang('load') . '</button>';
            $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $payroll->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</button>';

            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="payroll/delete_payroll?id=' . $payroll->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
            
            $info[] = array(
                $payroll->id,
                '<a href="#" class="viewbutton" data-toggle="modal" data-id="' . $payroll->id . '">'.$payroll->payroll_id.'</a>',
                $payroll->username,
                $payroll->month_name,
                $payroll->year,
                $payroll->net,
                $payroll->status
                    //  $options2
            );
        }

        if (!empty($data['payrolls'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('payroll')->num_rows(),
                "recordsFiltered" => $this->db->get('payroll')->num_rows(),
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

    function getPayrollList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $_REQUEST['search']['value'];
        //echo "<pre>"; print_r($_SESSION); exit;
        if ($limit == -1) {
            if (!empty($search)) {
                $data['payrolls'] = $this->payroll_model->getPayrollBysearch($search);
            } else {
                $data['payrolls'] = $this->payroll_model->getPayroll();
            }
        } else {
            if (!empty($search)) {
                $data['payrolls'] = $this->payroll_model->getPayrollByLimitBySearch($limit, $start, $search);
            } else {
                $data['payrolls'] = $this->payroll_model->getPayrollByLimit($limit, $start);
            }
        }
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // //echo $this->db->last_query();
        // exit;
        //  $data['appointments'] = $this->appointment_model->getAppointment();
        $i = 0;
        foreach ($data['payrolls'] as $payroll) {
            $i = $i + 1;
            $settings = $this->settings_model->getSettings();
            
            // $load = '<button type="button" class="btn btn-info btn-xs btn_width load" data-toggle="modal" data-id="' . $medicine->id . '">' . lang('load') . '</button>';
            $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $payroll->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</button>';

            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="payroll/delete_payroll?id=' . $payroll->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
            if ($this->ion_auth->in_group(array('admin','Accountant','superadmin','human_resource'))) { 
                $info[] = array(
                    $payroll->id,
                    '<a href="#" class="viewbutton" data-toggle="modal" data-id="' . $payroll->id . '">'.$payroll->payroll_id.'</a>',
                    $payroll->username,
                    $payroll->month_name,
                    $payroll->year,
                    $payroll->net,
                    $payroll->status,
                    $option1 . ' ' . $option2
                        //  $options2
                );
            } else {
                $info[] = array(
                    $payroll->id,
                    '<a href="#" class="viewbutton" data-toggle="modal" data-id="' . $payroll->id . '">'.$payroll->payroll_id.'</a>',
                    $payroll->username,
                    $payroll->month_name,
                    $payroll->year,
                    $payroll->net,
                    $payroll->status
                        //  $options2
                );
            }
        }

        if (!empty($data['payrolls'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('payroll')->num_rows(),
                "recordsFiltered" => $this->db->get('payroll')->num_rows(),
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


    public function addPurchase() {
        $id = $this->input->post('id');
        $product = $this->input->post('product');
        $seller = $this->input->post('seller');
        $qty = $this->input->post('qty');
        $purchase_price = $this->input->post('purchase_price');
        $mrp = $this->input->post('mrp');
        $m_date = $this->input->post('m_date');
        $e_date = $this->input->post('e_date');
        $p_date = $this->input->post('p_date');
        $generic = $this->input->post('g_name');
        $p_name = $this->input->post('p_name');
        $m_company = $this->input->post('m_company');
        //$min_stock = $this->input->post('min_stock');
        //$e_date = $this->input->post('e_date');
        // if ((empty($id))) {
        //     $add_date = date('m/d/y');
        // } else {
        //     $add_date = $this->db->get_where('medicine', array('id' => $id))->row()->add_date;
        // }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('product', 'product', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Category Field
        $this->form_validation->set_rules('seller', 'seller', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Purchase Price Field
        $this->form_validation->set_rules('qty', 'qty', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Store Box Field
        $this->form_validation->set_rules('purchase_price', 'purchase_price', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Selling Price Field
        $this->form_validation->set_rules('mrp', 'mrp', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Quantity Field
        $this->form_validation->set_rules('m_date', 'm_date', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Generic Name Field
        $this->form_validation->set_rules('e_date', 'e_date', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Company Name Field
        $this->form_validation->set_rules('p_date', 'p_date', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Effects Field
        $this->form_validation->set_rules('g_name', 'g_name', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Expire Date Field
        // $this->form_validation->set_rules('e_date', 'Expire Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        $this->form_validation->set_rules('p_name', 'p_name', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        $this->form_validation->set_rules('m_company', 'm_company', 'trim|required|min_length[1]|max_length[100]|xss_clean');



        if ($this->form_validation->run() == FALSE) {
            $data = array();
            
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data); // just the header file
            $this->load->view('finance/pharmacy/add_purchase_view', $data);
            $this->load->view('home/footer'); // just the header file
        } else {
            $data = array();
            $data = array('product' => $product,
                'seller' => $seller,
                'quantity' => $qty,
                'p_price' => $purchase_price,
                'mrp' => $mrp,
                'm_date' => $m_date,
                'e_date' => $e_date,
                'p_date' => $p_date,
                'generic' => $generic,
                'pat_name' => $p_name,
                'company' => $m_company,
            );
            if (empty($id)) {
                $this->pharmacy_model->insertPurchase($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->pharmacy_model->updatePurchase($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('finance/pharmacy/purchase');
        }
    }

    function delete_payroll() {

        if($_GET['id']) {
            $this->payroll_model->deletePayroll($_GET['id']);
            $this->session->set_flashdata('feedback', lang('deleted'));
            redirect('payroll');
        }
    }

}

/* End of file pharmacy.php */
/* Location: ./application/modules/pharmacy/controllers/pharmacy.php */