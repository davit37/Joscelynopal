<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('Model_crud');
        
        //Data
        $this->data = array(
            'title' => 'Login'
        );
    }

    public function frontpage(){
        redirect(base_url('admin/login'));
        exit;
    }

    public function index() {
        // check if logged in
        if ($this->session->has_userdata('logged_in')) {
            redirect('admin/dashboard');
        }
        
        //Data
        $data = $this->data;
        $data['error_warning'] = '';

        //View
        $data['load_view'] = 'admin/page_login';
        $this->load->view('admin/template/backend', $data);
    }

    public function signin() {
        // check if logged in
        if ($this->session->has_userdata('logged_in')) {
            redirect('admin/dashboard');
        }
        
        //validation
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            //message
            $this->session->set_userdata('error_warning', 'No match for Username and/or Password.');
                    
            redirect('admin/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $result = $this->Model_crud->select_where('users', array('username'=>$username));
            
            // attempt to login
            if ($result) {
                $pass = crypt($password, '$2a$07$padajodadhaihiw1oihlknkxnc8718e01eu0suc9862853uyvjheqvwd');
                
                if($pass == $result[0]['user_pass']) {
                    $this->session->set_userdata('user', $username);
                    $this->session->set_userdata('logged_in', true);
                    
                    // UPDATE TOKEN
                    $data_update = array(
                        'token' => bin2hex(openssl_random_pseudo_bytes(16)), //generate a random token
                    );
                    $this->session->set_userdata('token', $data_update['token']);
                    
                    $ex_upd = $this->Model_crud->update('users', $data_update, array('user_id'=>$result[0]['user_id']));
                    
                    redirect('admin/dashboard');
                } else {
                    $this->session->set_userdata('error_warning', 'No match for Username and/or Password.');
                    redirect('admin/login');
                }
                
            } else {
                //message
                $this->session->set_userdata('error_warning', 'No match for Username and/or Password.');
                redirect('admin/login');
            }
        }
    }

    public function logout() {
        // logout
        //$this->session->sess_destroy();
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('token');
        $this->session->unset_userdata('query_where');
        $this->session->unset_userdata('admin_cart');
        
        redirect('admin/login');
    }

}
