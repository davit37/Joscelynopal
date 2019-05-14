<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends CI_Controller {
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
            'title' => 'Bank Transfer'
        );
    }
    
    public function index() {
        //Data
        $data = $this->data;
        
        //Data Bank
        $data['result'] = $this->Model_crud->select_where('setting', array('setting_id'=>1));
        
        $data['load_view'] = 'admin/setting/payment/bank_edit';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function update() {
        
        $description = $this->input->post('description');
        $status = $this->input->post('status');

        $data_update = array(
            "value" => $description,
            "status" => $status
        );
        
        //notification
        $ex_upd = $this->Model_crud->update('setting', $data_update, array("setting_id" => 1));
        
        if ($ex_upd) {
            $this->session->set_userdata('notif_success', 'Success: You have modified payment bank transfer!');
        } else {
            $this->session->set_userdata('notif_error', 'Error: Please try again!');
        }

        redirect('admin/setting/payment/bank');
    }
}