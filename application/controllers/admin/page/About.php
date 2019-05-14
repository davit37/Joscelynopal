<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
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
            'title' => 'About'
        );
    }
    
    public function index() {
        //Data
        $data = $this->data;
        
        //Data About
        $data['about'] = $this->Model_crud->select_where('page', array('slug'=>'about'));
        
        $data['load_view'] = 'admin/page/about/about_edit';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function update() {
        
        $title1 = $this->input->post('title1');
        $description1 = $this->input->post('description1');
        $image1 = $this->input->post('image1');
        $title2 = $this->input->post('title2');
        $description2 = $this->input->post('description2');
        $image2 = $this->input->post('image2');

        $data_update1 = array(
            "title" => $title1,
            "description" => $description1,
            "image" => $image1,
            "date_modified" => date("c")
        );
        $data_update2 = array(
            "title" => $title2,
            "description" => $description2,
            "image" => $image2,
            "date_modified" => date("c")
        );
        
        //notification
        $ex_upd = $this->Model_crud->update('page', $data_update1, array("page_id" => 1));
        $ex_upd = $this->Model_crud->update('page', $data_update2, array("page_id" => 2));
        
        if ($ex_upd) {
            $this->session->set_userdata('about_success', 'Success: You have modified page about!');
        } else {
            $this->session->set_userdata('about_error', 'Error: Please try again!');
        }

        redirect('admin/page/about');
    }
}