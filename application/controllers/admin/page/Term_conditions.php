<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Term_conditions extends CI_Controller {
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
            'title' => 'Term & Conditions'
        );
    }
    
    public function index() {
        //Data
        $data = $this->data;
        
        //Data Contact
        $data['term'] = $this->Model_crud->select_where('page', array('slug'=>'term-conditions'));
        
        $data['load_view'] = 'admin/page/term_conditions/term_conditions_edit';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function update() {
        
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        
        $data_update = array(
            "title" => $title,
            "description" => $description,
            "date_modified" => date("c")
        );
        
        //notification
        $ex_upd = $this->Model_crud->update('page', $data_update, array("page_id" => 4));
        
        if ($ex_upd) {
            $this->session->set_userdata('term_success', 'Success: You have modified page term & conditions!');
        } else {
            $this->session->set_userdata('term_error', 'Error: Please try again!');
        }

        redirect('admin/page/term-conditions');
    }
}