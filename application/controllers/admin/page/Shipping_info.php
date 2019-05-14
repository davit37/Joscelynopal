<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping_info extends CI_Controller {
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
            'title' => 'Shipping Info'
        );
    }
    
    public function index() {
        //Data
        $data = $this->data;
        
        //Data Contact
        $data['shipping'] = $this->Model_crud->select_where('page', array('slug'=>'shipping-info'));
        
        $data['load_view'] = 'admin/page/shipping_info/shipping_info_edit';
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
        $ex_upd = $this->Model_crud->update('page', $data_update, array("page_id" => 5));
        
        if ($ex_upd) {
            $this->session->set_userdata('shipping_success', 'Success: You have modified page shipping info!');
        } else {
            $this->session->set_userdata('shipping_error', 'Error: Please try again!');
        }

        redirect('admin/page/shipping-info');
    }
}