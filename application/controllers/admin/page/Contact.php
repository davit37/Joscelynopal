<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
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
            'title' => 'Contact'
        );
    }
    
    public function index() {
        //Data
        $data = $this->data;
        
        //Data Contact
        $data['contact'] = $this->Model_crud->select_where('page', array('slug'=>'contact'));
        
        $data['load_view'] = 'admin/page/contact/contact_edit';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function update() {
        
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $image = $this->input->post('image');
        
        $data_update = array(
            "title" => $title,
            "description" => $description,
            "image" => $image,
            "date_modified" => date("c")
        );
        
        //notification
        $ex_upd = $this->Model_crud->update('page', $data_update, array("page_id" => 3));
        
        if ($ex_upd) {
            $this->session->set_userdata('contact_success', 'Success: You have modified page contact!');
        } else {
            $this->session->set_userdata('contact_error', 'Error: Please try again!');
        }

        redirect('admin/page/contact');
    }
}