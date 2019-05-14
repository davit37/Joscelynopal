<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paypal extends CI_Controller {
    function __construct() {
        parent::__construct();

        // check if logged in
        if (!$this->session->has_userdata('logged_in')) {
            redirect('admin/login');
        }

        //load Model
        $this->load->model('Model_crud');

        //Data
        $this->data = array(
            'title' => 'Paypal'
        );
    }
    
    public function index() {
        //Data
        $data = $this->data;
        
        //Data Paypal
        $result = $this->Model_crud->select_where('setting', array('code'=>'paypal'));
        
        foreach ($result as $row) {
            switch ($row['title']) {
                case 'Paypal':
                    $data['module'] = $row['status'];
                    break;
                case 'Business Email': 
                    $data['business_email'] = $row['value'];
                    break;
                case 'Notify Url':
                    $data['notify_url'] = $row['value'];
                    break;
                case 'Return Url':
                    $data['return_url'] = $row['value'];
                    break;
                case 'Cancel Url':
                    $data['cancel_url'] = $row['value'];
                    break;
                case 'Currency Code':
                    $data['currency_code'] = $row['value'];
                    break;
                case 'Checkout Logo':
                    $data['checkout_logo'] = $row['value'];
                    break;
                case 'Test Mode':
                    $data['test_mode'] = $row['status'];
                    break;
                case 'Debug Email':
                    $data['debug_email'] = $row['value'];
                    break;
            }
        }
        
        $data['load_view'] = 'admin/setting/payment/paypal_edit';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function update() {
        
        $status = $this->input->post('status');
        
        $business_email = $this->input->post('business_email');
        $notify_url = $this->input->post('notify_url');
        $return_url = $this->input->post('return_url');
        $cancel_url = $this->input->post('cancel_url');
        $currency_code = $this->input->post('currency_code');
        $checkout_logo = $this->input->post('checkout_logo');
        $test = $this->input->post('test');
        $debug_email = $this->input->post('debug_email');

        $data_status = array("status" => $status);
        $data_business = array("value" => $business_email);
        $data_notify = array("value" => $notify_url);
        $data_return = array("value" => $return_url);
        $data_cancel = array("value" => $cancel_url);
        $data_currency = array("value" => $currency_code);
        $data_logo = array("value" => $checkout_logo);
        $data_test = array("status" => $test);
        $data_debug = array("value" => $debug_email);
        
        //notification
        $ex_upd = $this->Model_crud->update('setting', $data_status, array("setting_id" => 2));
        $ex_upd = $this->Model_crud->update('setting', $data_business, array("setting_id" => 3));
        $ex_upd = $this->Model_crud->update('setting', $data_notify, array("setting_id" => 4));
        $ex_upd = $this->Model_crud->update('setting', $data_return, array("setting_id" => 5));
        $ex_upd = $this->Model_crud->update('setting', $data_cancel, array("setting_id" => 6));
        $ex_upd = $this->Model_crud->update('setting', $data_currency, array("setting_id" => 7));
        $ex_upd = $this->Model_crud->update('setting', $data_logo, array("setting_id" => 8));
        $ex_upd = $this->Model_crud->update('setting', $data_test, array("setting_id" => 9));
        $ex_upd = $this->Model_crud->update('setting', $data_debug, array("setting_id" => 10));
        
        if ($ex_upd) {
            $this->session->set_userdata('notif_success', 'Success: You have modified paypal!');
        } else {
            $this->session->set_userdata('notif_error', 'Error: Please try again!');
        }

        redirect('admin/setting/payment/paypal');
    }
}