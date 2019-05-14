<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    function __construct() {
        parent::__construct();

        // check if logged in
        if (!$this->session->has_userdata('logged_in')) {
            redirect('admin/login');
        }

        //load Model
        $this->load->model('Model_crud');
        $this->load->library('pagination');

        //Data
        $this->data = array(
            'title' => 'Categories'
        );
    }

    function index() {
        //Data
        $data = $this->data;

        $config["base_url"] = base_url('admin/catalog/category/page');
        $config["total_rows"] = $this->Model_crud->total_row('category');
        $config["per_page"] = 10;
        $config["uri_segment"] = 5;
        $config['use_page_numbers'] = TRUE;

        //customize
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['first_link'] = '|&lt;';
        $config['last_link'] = '&gt;|';
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
        $data["results"] = $this->Model_crud->sort_no_order('category', (($page - 1) * $config['per_page']), $config["per_page"]);
        $data["links"] = $this->pagination->create_links();
        $data['url_name'] = base_url('admin/catalog/category/sort/name/asc/' . $page);
        $data['url_order'] = base_url('admin/catalog/category/sort/sort_order/asc/' . $page);
        $data['class_name'] = '';
        $data['class_order'] = '';
        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;
        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);
        $data['total_result'] = $config["total_rows"];
        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);

        $data['load_view'] = 'admin/catalog/category/category_list';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function page() {
        //Data
        $data = $this->data;

        $config["base_url"] = base_url('admin/catalog/category/page');
        $config["total_rows"] = $this->Model_crud->total_row('category');
        $config["per_page"] = 10;
        $config["uri_segment"] = 5;
        $config['use_page_numbers'] = TRUE;

        //customize
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['first_link'] = '|&lt;';
        $config['last_link'] = '&gt;|';
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
        $data["results"] = $this->Model_crud->sort_no_order('category', (($page - 1) * $config['per_page']), $config["per_page"]);
        $data["links"] = $this->pagination->create_links();
        $data['url_name'] = base_url('admin/catalog/category/sort/name/asc/' . $page);
        $data['url_order'] = base_url('admin/catalog/category/sort/sort_order/asc/' . $page);
        $data['class_name'] = '';
        $data['class_order'] = '';
        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;
        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);
        $data['total_result'] = $config["total_rows"];
        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);

        $data['load_view'] = 'admin/catalog/category/category_list';
        $this->load->view('admin/template/backend', $data);
    }

    public function add() {
        //Data
        $data = $this->data;

        $data['load_view'] = 'admin/catalog/category/category_add';
        $this->load->view('admin/template/backend', $data);
    }

    public function save() {
        $name = $this->input->post('category_name');
        $description = $this->input->post('category_description');
        $sort_order = $this->input->post('sort_order');
        $status = $this->input->post('status');
        $slug = $this->input->post('slug');

        if (empty($name)) {
            $this->session->set_userdata('category_error', TRUE);
            redirect('admin/catalog/category/add');
        }
        if (empty($slug)) {
            $slug = url_title($name, 'dash', TRUE);
        }
        $check_duplicate = $this->Model_crud->check_duplicate('category', array("slug" => $slug));
        if ($check_duplicate) {
            $this->session->set_userdata('slug_error', TRUE);
            redirect('admin/catalog/category/add');
        }

        $data_insert = array(
            "name" => $name,
            "description" => $description,
            "sort_order" => $sort_order,
            "status" => $status,
            "slug" => $slug,
            "date_added" => date("c")
        );

        //notification
        $ex_ins = $this->Model_crud->insert('category', $data_insert);
        if ($ex_ins) {
            $this->session->set_userdata('category_success', TRUE);
        } else {
            $this->session->set_userdata('category_error', TRUE);
        }

        redirect('admin/catalog/category');
    }

    public function edit($seg1 = '') {
        //Data
        $data = $this->data;
        
        $category_id = $seg1;
        $data['result'] = $this->Model_crud->select_where('category', array("category_id" => $category_id));

        $data['load_view'] = 'admin/catalog/category/category_edit';
        $this->load->view('admin/template/backend', $data);
    }

    public function update() {
        //Data
        $data = $this->data;
        
        $category_id = $this->input->post('category_id');
        $name = $this->input->post('category_name');
        $description = $this->input->post('category_description');
        $sort_order = $this->input->post('sort_order');
        $status = $this->input->post('status');
        $slug = $this->input->post('slug');
        $prev_slug = $this->input->post('prev_slug');

        if (empty($name)) {
            $this->session->set_userdata('category_error', TRUE);
            redirect('admin/catalog/category/add');
        }
        if ($prev_slug != $slug) {
            if (empty($slug)) {
                $slug = url_title($name, 'dash', TRUE);
            }
            $check_duplicate = $this->Model_crud->check_duplicate('category', array("slug" => $slug));
            if ($check_duplicate) {
                $this->session->set_userdata('slug_error', TRUE);
                redirect('admin/catalog/category/edit/' . $category_id);
            }
        }

        $data_update = array(
            "name" => $name,
            "description" => $description,
            "sort_order" => $sort_order,
            "status" => $status,
            "slug" => $slug,
            "date_modified" => date("c")
        );
        //notification
        $ex_upd = $this->Model_crud->update('category', $data_update, array("category_id" => $category_id));
        if ($ex_upd) {
            $this->session->set_userdata('category_success', TRUE);
        } else {
            $this->session->set_userdata('category_error', TRUE);
        }

        redirect('admin/catalog/category');
    }

    public function delete() {
        //Data
        $data = $this->data;
        
        $checkbox = $this->input->post('selected');

        for ($i = 0; $i < count($checkbox); $i++) {
            $ex_del = $this->Model_crud->delete('category', array("category_id" => $checkbox[$i]));
        }

        //notification
        if ($ex_del) {
            $this->session->set_userdata('category_success', TRUE);
        } else {
            $this->session->set_userdata('category_error', TRUE);
        }

        redirect('admin/catalog/category');
    }

    public function sort($seg1 = '', $seg2 = '') {
        //Data
        $data = $this->data;
        
        $sort = $seg1;
        $sort_by = $seg2;
        
        if (empty($sort)) {
            $sort = 'name';
        }
        if (empty($sort_by)) {
            $sort_by = 'asc';
        }

        $config["base_url"] = base_url('admin/catalog/category/sort/' . $sort . '/' . $sort_by);
        $config["total_rows"] = $this->Model_crud->total_row('category');
        $config["per_page"] = 10;
        $config["uri_segment"] = 7;
        $config['use_page_numbers'] = TRUE;

        //customize
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['first_link'] = '|&lt;';
        $config['last_link'] = '&gt;|';
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(7)) ? $this->uri->segment(7) : 1;
        $data["results"] = $this->Model_crud->sort('category', $sort, $sort_by, (($page - 1) * $config['per_page']), $config["per_page"]);
        $data["links"] = $this->pagination->create_links();

        if ($sort_by == 'asc') {
            $reverse_sort = 'desc';
        } else {
            $reverse_sort = 'asc';
        }

        $data['url_name'] = base_url('admin/catalog/category/sort/name/asc/' . $page);
        $data['url_order'] = base_url('admin/catalog/category/sort/sort_order/asc/' . $page);
        $data['class_name'] = '';
        $data['class_order'] = '';

        if ($sort == 'name') {
            $data['url_name'] = base_url('admin/catalog/category/sort/name/' . $reverse_sort . '/' . $page);
            $data['class_name'] = $sort_by;
        } elseif ($sort == 'sort_order') {
            $data['url_order'] = base_url('admin/catalog/category/sort/sort_order/' . $reverse_sort . '/' . $page);
            $data['class_order'] = $sort_by;
        }
        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;
        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);
        $data['total_result'] = $config["total_rows"];
        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);

        $data['load_view'] = 'admin/catalog/category/category_list';
        $this->load->view('admin/template/backend', $data);
    }

}
