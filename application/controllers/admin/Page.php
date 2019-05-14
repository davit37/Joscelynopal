<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
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
            'title' => 'Page'
        );
    }
    
    public function index() {
        //Data
        $data = $this->data;
        
        //Data User
        $data['results'] = $this->Model_crud->select('page');

        $data['load_view'] = 'admin/page/page_list';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function add() {
        //Data
        $data = $this->data;

        $data['load_view'] = 'admin/page/page_add';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function save() {
        $title = $this->input->post('title');
        $image = $this->input->post('image');
        $position_menu = $this->input->post('position_menu');
        $description = htmlentities($this->input->post('description'));
        $label_menu = $this->input->post('label_menu');
        $slug = $this->input->post('slug');
        $sort_order = $this->input->post('sort_order');
        $slug = url_title($slug, 'dash', TRUE);
        //Message
        $error = False;
        if ((strlen(trim($title)) < 1) || (strlen(trim($title)) > 255)) {
            $this->session->set_userdata('title_error', 'Title must be between 1 and 255 characters!');
            $error = TRUE;
        }
        if($error) {
            redirect('admin/page/add');
        }

        if (empty($slug)) {
            $slug = url_title($title, 'dash', TRUE);
        }
        $check_duplicate_product      = $this->Model_crud->check_duplicate('product', array("slug" => $slug));
        $check_duplicate_page         = $this->Model_crud->check_duplicate('page', array("slug" => $slug));
        if ($check_duplicate_product && $check_duplicate_page) {
            $this->session->set_userdata('slug_error', TRUE);
            redirect('admin/page/edit/'.$page_id);
        }
        
        $data_insert = array(
            'image' => $image,
            'title' => $title,
            'label_menu' => $label_menu,
            'description' => $description,
            'position_menu' => $position_menu,
            'sort_order' => $sort_order,
            'slug' => $slug,
            'date_added' => date('c')
        );
        
        //Notification
        $ex_ins = $this->Model_crud->insert('page', $data_insert);
        if ($ex_ins) {
            $this->session->set_userdata('page_success', 'Success: You have modified page!');
        } else {
            $this->session->set_userdata('page_error', 'Error: Please try again!');
        }

        redirect('admin/page');

    }
    
    public function delete() {
        //Data
        $data = $this->data;
        
        $checkbox = $this->input->post('selected');

        for ($i = 0; $i < count($checkbox); $i++) {
            $ex_del = $this->Model_crud->delete('page', array("page_id" => $checkbox[$i]));
        }

        //notification
        if ($ex_del) {
            $this->session->set_userdata('page_success', 'Success: You have modified page!');
        } else {
            $this->session->set_userdata('page_error', 'Error: Please try again!');
        }

        redirect('admin/page');
    }
    
    public function edit($seg1 = '') {
        //Data
        $data = $this->data;
        
        $page_id = $seg1;
        $data['result'] = $this->Model_crud->select_where('page', array("page_id" => $page_id));

        $data['load_view'] = 'admin/page/page_edit';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function update() {
        //Data
        $data = $this->data;
        
        $page_id = $this->input->post('page_id');
        $title = $this->input->post('title');
        $label_menu = $this->input->post('label_menu');
        $image = $this->input->post('image');
        $description = html_entity_decode($this->input->post('description'));
        $position_menu = $this->input->post('position_menu');
        $sort_order = $this->input->post('sort_order');
        $slug = $this->input->post('slug');
        $slug = url_title($slug, 'dash', TRUE);

        if (empty($title)) {
            $this->session->set_userdata('title_error', TRUE);
            redirect('admin/page/edit/' . $page_id);
        }
        
        if (empty($slug)) {
            $slug = url_title($title, 'dash', TRUE);
        }
        $check_duplicate_product      = $this->Model_crud->check_duplicate('product', array("slug" => $slug));
        $check_duplicate_page         = $this->Model_crud->check_duplicate('page', array("slug" => $slug));
        if ($check_duplicate_product && $check_duplicate_page) {
            $this->session->set_userdata('slug_error', TRUE);
            redirect('admin/page/edit/'.$page_id);
        }

        $data_update = array(
            "image" => $image,
            "title" => $title,
            "label_menu" => $label_menu,
            "description" => $description,
            "position_menu" => $position_menu,
            "sort_order" => $sort_order,
            "slug" => $slug,
            "date_modified" => date("c")
        );
        
        //Update Data Product
        $ex_upd = $this->Model_crud->update('page', $data_update, array("page_id" => $page_id));
        
        //notification
        if ($ex_upd) {
            $this->session->set_userdata('page_success', 'Success: You have modified page!');
        } else {
            $this->session->set_userdata('page_error', 'Error: Please try again!');
        }

        redirect('admin/page');
    }
}