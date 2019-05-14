<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends CI_Controller {
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
            'title' => 'Maintenance'
        );
    }
    
    public function index() {
        
        //Data
        $data = $this->data;
        
        $get = $this->Model_crud->select_where('setting', array('setting_id'=>26));
        $maintenance_status = '';
        if(!empty($get[0]) && $get[0]['value'] == '1'){
            $maintenance_status = 'checked';
        }
        $data['check_maintenance'] = $maintenance_status;


        $data['load_view'] = 'admin/setting/maintenance_edit';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function update() {
        
        $maintenance = $this->input->post('maintenance', true);
        
        //Set value
        $set_value = '1';
        if($maintenance == ''){
            $set_value = '0';
        }
        $data_update = array('value' => $set_value);
        
        //notification
        $ex_upd = $this->Model_crud->update('setting', $data_update, array("setting_id" => 26));
        
        if ($ex_upd) {
            $this->session->set_userdata('notif_success', 'Success: You have modified maintenance status!');
        } else {
            $this->session->set_userdata('notif_error', 'Error: Please try again!');
        }

        redirect('admin/setting/maintenance');
    }
}