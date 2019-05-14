<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Slideshow extends CI_Controller {
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
            'title' => 'Slideshow'
        );
    }
    
    public function index() {
        //Data
        $data = $this->data;
        
        //Data User
        $data['results'] = $this->Model_crud->select('slideshow');

        $data['load_view'] = 'admin/slideshow/slideshow_list';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function add() {
        //Data
        $data = $this->data;

        $data['load_view'] = 'admin/slideshow/slideshow_add';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function save() {
        $title = $this->input->post('title');
        $image = $this->input->post('image');
        $link = $this->input->post('link');
        $sort_order = $this->input->post('sort_order');

        //Message
        $error = False;
        if ((strlen(trim($title)) < 1) || (strlen(trim($title)) > 255)) {
            $this->session->set_userdata('title_error', 'Title must be between 1 and 255 characters!');
            $error = TRUE;
        }
        if($error) {
            redirect('admin/slideshow/add');
        }
        
        $data_insert = array(
            'image' => $image,
            'title' => $title,
            'link' => $link,
            'sort_order' => $sort_order,
            'date_added' => date('c')
        );
        
        //Notification
        $ex_ins = $this->Model_crud->insert('slideshow', $data_insert);
        if ($ex_ins) {
            $this->session->set_userdata('slideshow_success', 'Success: You have modified slideshow!');
        } else {
            $this->session->set_userdata('slideshow_error', 'Error: Please try again!');
        }

        redirect('admin/slideshow');
    }
    
    public function delete() {
        //Data
        $data = $this->data;
        
        $checkbox = $this->input->post('selected');

        for ($i = 0; $i < count($checkbox); $i++) {
            $ex_del = $this->Model_crud->delete('slideshow', array("slideshow_id" => $checkbox[$i]));
        }

        //notification
        if ($ex_del) {
            $this->session->set_userdata('slideshow_success', 'Success: You have modified slideshow!');
        } else {
            $this->session->set_userdata('slideshow_error', 'Error: Please try again!');
        }

        redirect('admin/slideshow');
    }
    
    public function edit($seg1 = '') {
        //Data
        $data = $this->data;
        
        $slideshow_id = $seg1;
        $data['result'] = $this->Model_crud->select_where('slideshow', array("slideshow_id" => $slideshow_id));

        $data['load_view'] = 'admin/slideshow/slideshow_edit';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function update() {
        //Data
        $data = $this->data;
        
        $slideshow_id = $this->input->post('slideshow_id');
        $title = $this->input->post('title');
        $image = $this->input->post('image');
        $link = $this->input->post('link');
        $sort_order = $this->input->post('sort_order');
        
        if (empty($title)) {
            $this->session->set_userdata('title_error', TRUE);
            redirect('admin/slideshow/edit/' . $slideshow_id);
        }
        
        $data_update = array(
            "image" => $image,
            "title" => $title,
            "link" => $link,
            "sort_order" => $sort_order,
            "date_modified" => date("c")
        );
        
        //Update Data Product
        $ex_upd = $this->Model_crud->update('slideshow', $data_update, array("slideshow_id" => $slideshow_id));
        
        //notification
        if ($ex_upd) {
            $this->session->set_userdata('slideshow_success', 'Success: You have modified slideshow!');
        } else {
            $this->session->set_userdata('slideshow_error', 'Error: Please try again!');
        }

        redirect('admin/slideshow');
    }
}