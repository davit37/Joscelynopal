<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {
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
            'title' => 'Store'
        );
    }
    
    public function index() {
        
        //Data
        $data = $this->data;
        
        $data['store_name'] = $this->Model_crud->select_where('setting', array('setting_id'=>17));
        $data['store_address'] = $this->Model_crud->select_where('setting', array('setting_id'=>18));
        $data['store_email'] = $this->Model_crud->select_where('setting', array('setting_id'=>19));
        $data['store_telephone'] = $this->Model_crud->select_where('setting', array('setting_id'=>20));
        
        $data['load_view'] = 'admin/setting/store_edit';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function update() {
        
        $store_name = $this->input->post('store_name');
        $store_address = $this->input->post('store_address');
        $store_email = $this->input->post('store_email');
        $store_telephone = $this->input->post('store_telephone');
        
        //message
        $error = False;
        if ((strlen(trim($store_name)) < 1) || (strlen(trim($store_name)) > 32)) {
            $this->session->set_userdata('error_name', 'Store name must be between 1 and 32 characters!');
            $error = TRUE;
        }
        if ((strlen(trim($store_address)) < 1) || (strlen(trim($store_address)) > 255)) {
            $this->session->set_userdata('error_address', 'Store address must be between 1 and 255 characters!');
            $error = TRUE;
        }
        if ((strlen($store_email) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $store_email)) {
            $this->session->set_userdata('error_email', 'Store E-Mail address does not appear to be valid!');
            $error = TRUE;
        }
        if ((strlen($store_telephone) < 3) || (strlen($store_telephone) > 32)) {
            $this->session->set_userdata('error_telephone', 'Store telephone must be between 3 and 32 characters!');
            $error = TRUE;
        }

        if($error) {
            redirect('admin/setting/store');
        }
        
        $data_update1 = array('value' => $store_name);
        $data_update2 = array('value' => $store_address);
        $data_update3 = array('value' => $store_email);
        $data_update4 = array('value' => $store_telephone);
        
        //notification
        $ex_upd = $this->Model_crud->update('setting', $data_update1, array("setting_id" => 17));
        $ex_upd = $this->Model_crud->update('setting', $data_update2, array("setting_id" => 18));
        $ex_upd = $this->Model_crud->update('setting', $data_update3, array("setting_id" => 19));
        $ex_upd = $this->Model_crud->update('setting', $data_update4, array("setting_id" => 20));
        
        if ($ex_upd) {
            $this->session->set_userdata('notif_success', 'Success: You have modified store!');
        } else {
            $this->session->set_userdata('notif_error', 'Error: Please try again!');
        }

        redirect('admin/setting/store');
    }
}