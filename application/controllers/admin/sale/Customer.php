<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
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
            'title' => 'Customer'
        );
    }
    
    public function index() {
        //Data
        $data = $this->data;
        
        $config["base_url"] = base_url('admin/sale/customer/page');
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
        
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
        $query = "SELECT * FROM `customer` LIMIT ".(($page - 1) * $config['per_page']).", ".$config["per_page"];
        $data['results'] = $this->Model_crud->select_query($query);
        $config["total_rows"] = $this->Model_crud->total_row('customer');
        $this->pagination->initialize($config);
        
        $data['url_customer'] = base_url('admin/sale/customer/sort/customer/asc/' . $page);
        $data['url_email'] = base_url('admin/sale/customer/sort/email/asc/' . $page);
        $data['url_ip'] = base_url('admin/sale/customer/sort/ip/asc/' . $page);
        $data['url_date_added'] = base_url('admin/sale/customer/sort/date_added/asc/' . $page);
        $data['class_customer'] = '';
        $data['class_email'] = '';
        $data['class_ip'] = '';
        $data['class_date_added'] = '';
        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;
        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);
        $data['total_result'] = $config["total_rows"];
        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);
        $data["links"] = $this->pagination->create_links();
        
        $data['load_view'] = 'admin/sale/customer/customer_list';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function page() {
        //Data
        $data = $this->data;
        
        $config["base_url"] = base_url('admin/sale/customer/page');
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
        
        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
        $query = "SELECT * FROM `customer` LIMIT ".(($page - 1) * $config['per_page']).", ".$config["per_page"];
        $data['results'] = $this->Model_crud->select_query($query);
        $config["total_rows"] = $this->Model_crud->total_row('customer');
        $this->pagination->initialize($config);
        
        $data['url_customer'] = base_url('admin/sale/customer/sort/customer/asc/' . $page);
        $data['url_email'] = base_url('admin/sale/customer/sort/email/asc/' . $page);
        $data['url_ip'] = base_url('admin/sale/customer/sort/ip/asc/' . $page);
        $data['url_date_added'] = base_url('admin/sale/customer/sort/date_added/asc/' . $page);
        $data['class_customer'] = '';
        $data['class_email'] = '';
        $data['class_ip'] = '';
        $data['class_date_added'] = '';
        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;
        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);
        $data['total_result'] = $config["total_rows"];
        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);
        $data["links"] = $this->pagination->create_links();
        
        $data['load_view'] = 'admin/sale/customer/customer_list';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function autocomplete($seg1 = '', $seg2 = '') {
        $json = array();
        $limit = 5;
        
        switch ($seg1) {
            case 'customer':
                $like = "CONCAT(firstname, ' ', lastname)";
                $like_by = $seg2;
                $results = $this->Model_crud->select_like_limit('customer', array("$like" => $like_by), $limit);

                foreach ($results as $result) {
                    $json[] = array(
                        'customer_id' => $result['customer_id'],
                        'name' => $result['firstname'].' '.$result['lastname']
                    );
                }
                break;
                
            case 'email':
                $like = "email";
                $like_by = $seg2;
                $results = $this->Model_crud->select_like_limit('customer', array("$like" => $like_by), $limit);
                
                foreach ($results as $result) {
                    $json[] = array(
                        'customer_id' => $result['customer_id'],
                        'email' => $result['email']
                    );
                }
                break;

        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }
    
    public function add() {
        //Data
        $data = $this->data;
        
        //Country
        $data['countries'] = $this->Model_crud->select('country');

        //First Selected Zone
        $data['zones'] = $this->Model_crud->select_where('zone', array('country_id' => 100));
        
        $data['load_view'] = 'admin/sale/customer/customer_add';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function save() {
        //validation
        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fax', 'Fax', 'trim|xss_clean');
        $this->form_validation->set_rules('company', 'Company', 'trim|xss_clean');
        $this->form_validation->set_rules('address_1', 'Address 1', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address_2', 'Address 2', 'trim|xss_clean');
        $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
        $this->form_validation->set_rules('postcode', 'Post Code', 'trim|required|xss_clean');
        $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('zone_id', 'Zone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('confirm', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('newsletter', 'Newsletter', 'trim|xss_clean');

        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $email = $this->input->post('email');
        $telephone = $this->input->post('telephone');
        $fax = $this->input->post('fax');
        $company = $this->input->post('company');
        $address_1 = $this->input->post('address_1');
        $address_2 = $this->input->post('address_2');
        $city = $this->input->post('city');
        $postcode = $this->input->post('postcode');
        $country_id = $this->input->post('country_id');
        $zone_id = $this->input->post('zone_id');
        $password = $this->input->post('password');
        $confirm = $this->input->post('confirm');
        $newsletter = $this->input->post('newsletter');

        if ($this->form_validation->run() == FALSE) {
            //message
            if ((strlen(trim($firstname)) < 1) || (strlen(trim($firstname)) > 32)) {
                $this->session->set_userdata('error_firstname', 'First Name must be between 1 and 32 characters!');
            }
            if ((strlen(trim($lastname)) < 1) || (strlen(trim($lastname)) > 32)) {
                $this->session->set_userdata('error_lastname', 'Last Name must be between 1 and 32 characters!');
            }
            if ((strlen($email) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
                $this->session->set_userdata('error_email', 'E-Mail Address does not appear to be valid!');
            }
            if ((strlen($telephone) < 3) || (strlen($telephone) > 32)) {
                $this->session->set_userdata('error_telephone', 'Telephone must be between 3 and 32 characters!');
            }
            if ((strlen(trim($address_1)) < 3) || (strlen(trim($address_1)) > 128)) {
                $this->session->set_userdata('error_address_1', 'Address 1 must be between 3 and 128 characters!');
            }
            if ((strlen(trim($city)) < 2) || (strlen(trim($city)) > 128)) {
                $this->session->set_userdata('error_city', 'City must be between 2 and 128 characters!');
            }
            if ((strlen(trim($postcode)) < 2 || strlen(trim($postcode)) > 10)) {
                $this->session->set_userdata('error_postcode', 'Postcode must be between 2 and 10 characters!');
            }
            if ($country_id == '') {
                $this->session->set_userdata('error_country_id', 'Please select a country!');
            }
            if ($zone_id == '') {
                $this->session->set_userdata('error_zone_id', 'Please select a region / state!');
            }
            if ((strlen($password) < 4) || (strlen($password) > 20)) {
                $this->session->set_userdata('error_password', 'Password must be between 4 and 20 characters!');
            }
            if ($confirm != $password) {
                $this->session->set_userdata('error_confirm', 'Password confirmation does not match password!');
            }
            
            //Repopulating Data
            $this->session->set_userdata('value_firstname', $firstname);
            $this->session->set_userdata('value_lastname', $lastname);
            $this->session->set_userdata('value_email', $email);
            $this->session->set_userdata('value_telephone', $telephone);
            $this->session->set_userdata('value_fax', $fax);
            $this->session->set_userdata('value_company', $company);
            $this->session->set_userdata('value_address_1', $address_1);
            $this->session->set_userdata('value_address_2', $address_2);
            $this->session->set_userdata('value_city', $city);
            $this->session->set_userdata('value_postcode', $postcode);
            redirect('admin/sale/customer/add');
        } else {
            //Check Duplicate Email
            $check_dp = $this->Model_crud->total_row_where('customer', array('email'=>$email));
            if($check_dp > 0) {
                $this->session->set_userdata('error_email', 'E-Mail Address already used!');
                redirect('admin/sale/customer/add');
            }
            
            $data_insert = array(
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email,
                "telephone" => $telephone,
                "fax" => $fax,
                "company" => $company,
                "address_1" => $address_1,
                "address_2" => $address_2,
                "city" => $city,
                "postcode" => $postcode,
                "country_id" => $country_id,
                "zone_id" => $zone_id,
                "password" => crypt($password, '$2a$07$padajodadhaihiw1oihlknkxnc8718e01eu0suc9862853uyvjheqvwd'),
                "newsletter" => $newsletter,
                "ip" => $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']),
                "status" => 1,
                "approved" => 1,
                "date_added" => date("c")
            );
            
            $ex_ins = $this->Model_crud->insert('customer', $data_insert);
            $customer_id = $this->Model_crud->inserted_id();
            
            //Insert to table subscriber
            if($ex_ins) {
                if($newsletter == 1) {
                    $status = 'subscribe';
                } else {
                    $status = 'unsubscribe';
                }
                
                $data_insert = array(
                    "customer_id" => $customer_id,
                    "email" => $email,
                    "status" => $status,
                    "date_added" => date('c')
                );
                
                $this->Model_crud->insert('subscribe', $data_insert);
            }
            
            $this->session->set_userdata('customer_success', 'Success: You have modified order!');
            
            redirect('admin/sale/customer');
        }
    }
    
    public function filter($seg1 = '', $seg2 = '') {
        //Data
        $data = $this->data;
        
        $customer = $this->input->post('filter_name');
        $email = $this->input->post('filter_email');
        $ip = $this->input->post('filter_ip');
        $date_added = $this->input->post('filter_date_added');

        $query_where = array();
        if ($customer != '') {
            $query_where[] = "CONCAT(firstname, ' ', lastname) LIKE '%$customer%'";
        }
        if ($email != '') {
            $query_where[] = "email LIKE '%$email%'";
        }
        if ($ip != '') {
            $query_where[] = "ip LIKE '%$ip%'";
        }
        if ($date_added != '') {
            $date_added = date("Y-m-d H:i:s", strtotime($date_added));
            $query_where[] = "date_added = '$date_added'";
        }
        if (count($query_where) > 0) {
            $this->session->set_userdata('query_where', $query_where);
        }

        $query = "select * from `customer`";
        if ($this->session->userdata('query_where')) {
            for ($i = 0; $i < count($this->session->userdata('query_where')); $i++) {
                if ($i == 0) {
                    $query .= " WHERE " . $this->session->userdata['query_where'][$i];
                } else {
                    $query .= " AND " . $this->session->userdata['query_where'][$i];
                }
            }
        }
        
        //Sort
        $sort_by = $seg2;

        switch ($seg1) {
            case 'customer':
                $sort = "CONCAT(firstname, ' ', lastname)";
                $sort_seg1 = 'customer';
                break;
            case 'email':
                $sort = 'email';
                $sort_seg1 = 'email';
                break;
            case 'ip':
                $sort = 'ip';
                $sort_seg1 = 'ip';
                break;
            case 'date_added':
                $sort = 'date_added';
                $sort_seg1 = 'date_added';
                break;
            default :
                $sort = 'date_added';
                $sort_seg1 = 'date_added';
        }
        if (empty($sort_by)) {
            $sort_by = 'asc';
        }
        
        $config["base_url"] = base_url('admin/sale/customer/filter/'.$sort_seg1.'/'.$sort_by);
        $config["total_rows"] = $this->Model_crud->total_row_query($query);
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
        
        $page = ($this->uri->segment(7)) ? $this->uri->segment(7) : 1;
        $query .= " ORDER BY $sort $sort_by LIMIT ".(($page - 1) * $config['per_page']).", ".$config["per_page"];
        $data['results'] = $this->Model_crud->select_query($query);
        $this->pagination->initialize($config);
        
        if ($sort_by == 'asc') {
            $reverse_sort = 'desc';
        } else {
            $reverse_sort = 'asc';
        }
        
        $data['url_customer'] = base_url('admin/sale/customer/filter/customer/asc/' . $page);
        $data['url_email'] = base_url('admin/sale/customer/filter/email/asc/' . $page);
        $data['url_ip'] = base_url('admin/sale/customer/filter/ip/asc/' . $page);
        $data['url_date_added'] = base_url('admin/sale/order/filter/date_added/asc/' . $page);
        $data['class_customer'] = '';
        $data['class_email'] = '';
        $data['class_ip'] = '';
        $data['class_date_added'] = '';
       
        switch ($seg1) {
            case 'customer':
                $data['url_customer'] = base_url('admin/sale/customer/filter/customer/' . $reverse_sort . '/' . $page);
                $data['class_customer'] = $sort_by;
                break;
            case 'email':
                $data['url_email'] = base_url('admin/sale/customer/filter/email/' . $reverse_sort . '/' . $page);
                $data['class_email'] = $sort_by;
                break;
            case 'ip':
                $data['url_total'] = base_url('admin/sale/customer/filter/ip/' . $reverse_sort . '/' . $page);
                $data['class_total'] = $sort_by;
                break;
            case 'date_added':
                $data['url_date_added'] = base_url('admin/sale/customer/sort/date_added/' . $reverse_sort . '/' . $page);
                $data['class_date_added'] = $sort_by;
                break;
        }
        
        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;
        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);
        $data['total_result'] = $config["total_rows"];
        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);
        $data["links"] = $this->pagination->create_links();

        $data['load_view'] = 'admin/sale/customer/customer_list';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function edit($seg1 = '') {
        //Data
        $data = $this->data;
        
        $customer_id = $seg1;
        
        //Customer ID
        $data['customer_id'] = $customer_id;
        
        //Customer
        $data['customer'] = $this->Model_crud->select_where('customer',array('customer_id'=>$customer_id));
        
        //Country
        $data['countries'] = $this->Model_crud->select('country');
        
        //Zone
        $data['zones'] = $this->Model_crud->select_where('zone',array('country_id'=>$data['customer'][0]['country_id']));
        
        //View
        $data['load_view'] = 'admin/sale/customer/customer_edit';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function country($seg1 = '') {
        $json = array();
        $county_id = $seg1;

        $results = $this->Model_crud->select_where('zone', array("country_id" => $county_id));

        foreach ($results as $result) {
            $json[] = array(
                'zone_id' => $result['zone_id'],
                'name' => $result['name']
            );
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }
    
    public function update() {
        //validation
        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|xss_clean');
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('telephone', 'Telephone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fax', 'Fax', 'trim|xss_clean');
        $this->form_validation->set_rules('company', 'Company', 'trim|xss_clean');
        $this->form_validation->set_rules('address_1', 'Address 1', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address_2', 'Address 2', 'trim|xss_clean');
        $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
        $this->form_validation->set_rules('postcode', 'Post Code', 'trim|required|xss_clean');
        $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('zone_id', 'Zone', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean');
        $this->form_validation->set_rules('confirm', 'Password Confirmation', 'matches[password]');
        $this->form_validation->set_rules('newsletter', 'Newsletter', 'trim|xss_clean');

        $customer_id = $this->input->post('customer_id');
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $email = $this->input->post('email');
        $telephone = $this->input->post('telephone');
        $fax = $this->input->post('fax');
        $company = $this->input->post('company');
        $address_1 = $this->input->post('address_1');
        $address_2 = $this->input->post('address_2');
        $city = $this->input->post('city');
        $postcode = $this->input->post('postcode');
        $country_id = $this->input->post('country_id');
        $zone_id = $this->input->post('zone_id');
        $password = $this->input->post('password');
        $confirm = $this->input->post('confirm');
        $newsletter = $this->input->post('newsletter');

        if ($this->form_validation->run() == FALSE) {
            //message
            if ((strlen(trim($firstname)) < 1) || (strlen(trim($firstname)) > 32)) {
                $this->session->set_userdata('error_firstname', 'First Name must be between 1 and 32 characters!');
            }
            if ((strlen(trim($lastname)) < 1) || (strlen(trim($lastname)) > 32)) {
                $this->session->set_userdata('error_lastname', 'Last Name must be between 1 and 32 characters!');
            }
            if ((strlen($email) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
                $this->session->set_userdata('error_email', 'E-Mail Address does not appear to be valid!');
            }
            if ((strlen($telephone) < 3) || (strlen($telephone) > 32)) {
                $this->session->set_userdata('error_telephone', 'Telephone must be between 3 and 32 characters!');
            }
            if ((strlen(trim($address_1)) < 3) || (strlen(trim($address_1)) > 128)) {
                $this->session->set_userdata('error_address_1', 'Address 1 must be between 3 and 128 characters!');
            }
            if ((strlen(trim($city)) < 2) || (strlen(trim($city)) > 128)) {
                $this->session->set_userdata('error_city', 'City must be between 2 and 128 characters!');
            }
            if ((strlen(trim($postcode)) < 2 || strlen(trim($postcode)) > 10)) {
                $this->session->set_userdata('error_postcode', 'Postcode must be between 2 and 10 characters!');
            }
            if ($country_id == '') {
                $this->session->set_userdata('error_country_id', 'Please select a country!');
            }
            if ($zone_id == '') {
                $this->session->set_userdata('error_zone_id', 'Please select a region / state!');
            }
            if ($confirm != $password) {
                $this->session->set_userdata('error_confirm', 'Password confirmation does not match password!');
            }
            
            redirect('admin/sale/customer/edit/'.$customer_id);
        } else {
            //Check Duplicate Email
            $old_cus_data = $this->Model_crud->select_where('customer', array('customer_id'=>$customer_id));
            if($email != $old_cus_data[0]['email']){
                $check_dp = $this->Model_crud->total_row_where('customer', array('email'=>$email));
                if($check_dp > 0) {
                    $this->session->set_userdata('error_email', 'E-Mail Address already used!');
                    redirect('admin/sale/customer/edit/'.$customer_id);
                }
            }
            
            if($password != '') {
                $data_update = array(
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "email" => $email,
                    "telephone" => $telephone,
                    "fax" => $fax,
                    "company" => $company,
                    "address_1" => $address_1,
                    "address_2" => $address_2,
                    "city" => $city,
                    "postcode" => $postcode,
                    "country_id" => $country_id,
                    "zone_id" => $zone_id,
                    "password" => crypt($password, '$2a$07$padajodadhaihiw1oihlknkxnc8718e01eu0suc9862853uyvjheqvwd'),
                    "newsletter" => $newsletter,
                    "date_modified" => date("c")
                );
            } else {
                $data_update = array(
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "email" => $email,
                    "telephone" => $telephone,
                    "fax" => $fax,
                    "company" => $company,
                    "address_1" => $address_1,
                    "address_2" => $address_2,
                    "city" => $city,
                    "postcode" => $postcode,
                    "country_id" => $country_id,
                    "zone_id" => $zone_id,
                    "newsletter" => $newsletter,
                    "date_modified" => date("c")
                );
            }
            
            $ex_upd = $this->Model_crud->update('customer', $data_update, array('customer_id'=>$customer_id));
            
            //Update to table subscriber
            if($ex_upd) {
                if($newsletter == 1) {
                    $status = 'subscribe';
                } else {
                    $status = 'unsubscribe';
                }
                $data_update = array(
                    "email" => $email,
                    "status" => $status,
                    "date_modified" => date('c')
                );
                
                $this->Model_crud->update('subscribe', $data_update, array('customer_id'=>$customer_id));
            }
            
            $this->session->set_userdata('customer_success', 'Success: You have modified order!');
            
            redirect('admin/sale/customer');
        }
    }
    
    public function delete() {
        //Data
        $data = $this->data;
        
        $checkbox = $this->input->post('selected');

        for ($i = 0; $i < count($checkbox); $i++) {
            $ex_del = $this->Model_crud->delete('customer', array("customer_id" => $checkbox[$i]));
            $ex_del = $this->Model_crud->delete('subscribe', array("customer_id" => $checkbox[$i]));
        }

        //notification
        if ($ex_del) {
            $this->session->set_userdata('customer_success', TRUE);
        } else {
            $this->session->set_userdata('customer_error', TRUE);
        }

        redirect('admin/sale/customer');
    }
}