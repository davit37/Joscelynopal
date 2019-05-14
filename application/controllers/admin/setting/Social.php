<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Social extends CI_Controller {
    
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
            'title' => 'Social Media'
        );
    }
    
    public function index() {
        
        //Data
        $data = $this->data;
        
        $data['fb'] = $this->Model_crud->select_where('setting', array('setting_id'=>21));
        $data['tw'] = $this->Model_crud->select_where('setting', array('setting_id'=>22));
        $data['ig'] = $this->Model_crud->select_where('setting', array('setting_id'=>23));
        
        $data['load_view'] = 'admin/setting/social_edit';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function update() {
        
        $fb = $this->input->post('fb');
        $tw = $this->input->post('tw');
        $ig = $this->input->post('ig');
        
        $data_update1 = array('value' => $fb);
        $data_update2 = array('value' => $tw);
        $data_update3 = array('value' => $ig);
        
        //notification
        $ex_upd = $this->Model_crud->update('setting', $data_update1, array("setting_id" => 21));
        $ex_upd = $this->Model_crud->update('setting', $data_update2, array("setting_id" => 22));
        $ex_upd = $this->Model_crud->update('setting', $data_update3, array("setting_id" => 23));
        
        if ($ex_upd) {
            $this->session->set_userdata('notif_success', 'Success: You have modified social media!');
        } else {
            $this->session->set_userdata('notif_error', 'Error: Please try again!');
        }

        redirect('admin/setting/social');
    }
}