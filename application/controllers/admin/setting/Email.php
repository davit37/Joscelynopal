<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {
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
            'title' => 'Email'
        );
    }
    
    public function index() {
        
        //Data
        $data = $this->data;
        
        $data['contact_email'] = $this->Model_crud->select_where('setting', array('setting_id'=>11));
        
        $data['load_view'] = 'admin/setting/email_edit';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function update() {
        
        $contact_email = $this->input->post('contact_email');
        
        $data_contact = array(
            'value' => $contact_email
        );
        
        //notification
        $ex_upd = $this->Model_crud->update('setting', $data_contact, array("setting_id" => 11));
        
        if ($ex_upd) {
            $this->session->set_userdata('notif_success', 'Success: You have modified email!');
        } else {
            $this->session->set_userdata('notif_error', 'Error: Please try again!');
        }

        redirect('admin/setting/email');
    }
}