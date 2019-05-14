<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
            'title' => 'Users'
        );
    }

    public function index() {
        //Data
        $data = $this->data;

        //Data User
        $data['results'] = $this->Model_crud->select('users');

        $data['load_view'] = 'admin/user/user_list';
        $this->load->view('admin/template/backend', $data);
    }

    public function add() {
        //Data
        $data = $this->data;

        $data['load_view'] = 'admin/user/user_add';
        $this->load->view('admin/template/backend', $data);
    }

    public function save() {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $confirm = $this->input->post('confirm');

        //Message
        $error = False;
        if ((strlen(trim($username)) < 1) || (strlen(trim($username)) > 32)) {
            $this->session->set_userdata('username_error', 'Username must be between 1 and 32 characters!');
            $error = TRUE;
        }
        if ((strlen($email) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
            $this->session->set_userdata('email_error', 'E-Mail Address does not appear to be valid!');
            $error = TRUE;
        }
        if ((strlen($password) < 4) || (strlen($password) > 20)) {
            $this->session->set_userdata('password_error', 'Password must be between 4 and 20 characters!');
            $error = TRUE;
        }
        if ($confirm != $password) {
            $this->session->set_userdata('confirm_error', 'Password confirmation does not match password!');
            $error = TRUE;
        }
        
        if($error) {
            redirect('admin/user/add');
        }
        
        //Check Duplicate Email
        $check_dp = $this->Model_crud->total_row_where('users', array('username'=>$username));
        if($check_dp > 0) {
            $this->session->set_userdata('error', 'Username already used!');
            redirect('admin/user/add');
        }
        $check_dp = $this->Model_crud->total_row_where('users', array('user_email'=>$email));
        if($check_dp > 0) {
            $this->session->set_userdata('error', 'E-Mail Address already used!');
            redirect('admin/user/add');
        }
        
        $data_insert = array(
            'username' => $username,
            'user_email' => $email,
            'user_pass' => crypt($password, '$2a$07$padajodadhaihiw1oihlknkxnc8718e01eu0suc9862853uyvjheqvwd'),
            'user_date' => date('c')
        );

        //Notification
        $ex_ins = $this->Model_crud->insert('users', $data_insert);
        if ($ex_ins) {
            $this->session->set_userdata('user_success', 'Success: You have modified user!');
        } else {
            $this->session->set_userdata('user_error', 'Error: Please try again!');
        }

        redirect('admin/user');
    }
    
    public function edit($seg1 = '') {
        //Data
        $data = $this->data;
        
        $user_id = $seg1;
        
        //Data User
        $data['user'] = $this->Model_crud->select_where('users', array('user_id'=>$user_id));
        
        $data['load_view'] = 'admin/user/user_edit';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function update() {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $confirm = $this->input->post('confirm');
        $user_id = $this->input->post('user_id');

        //Message
        $error = False;
        if ((strlen(trim($username)) < 1) || (strlen(trim($username)) > 32)) {
            $this->session->set_userdata('username_error', 'Username must be between 1 and 32 characters!');
            $error = TRUE;
        }
        if ((strlen($email) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
            $this->session->set_userdata('email_error', 'E-Mail Address does not appear to be valid!');
            $error = TRUE;
        }
        if (strlen($password) > 4) {
            if ($confirm != $password) {
                $this->session->set_userdata('confirm_error', 'Password confirmation does not match password!');
                $error = TRUE;
            }
        }
        
        if($error) {
            redirect('admin/user/edit/'.$user_id);
        }
        
        //Data Update
        $data_update = array(
            "username" => $username,
            "user_email" => $email
        );

        //Notification
        $ex_upd = $this->Model_crud->update('users', $data_update, array("user_id"=>$user_id));
        if($password != '') {
            $data_pass = array(
                'user_pass' => crypt($password, '$2a$07$padajodadhaihiw1oihlknkxnc8718e01eu0suc9862853uyvjheqvwd')
            );
            $ex_upd = $this->Model_crud->update('users', $data_pass, array("user_email"=>$email));
        }
        if ($ex_upd) {
            $this->session->set_userdata('user_success', 'Success: You have modified user!');
        } else {
            $this->session->set_userdata('user_error', 'Error: Please try again!');
        }

        redirect('admin/user');
    }
    
    public function delete() {
        //Data
        $data = $this->data;
        
        $checkbox = $this->input->post('selected');

        for ($i = 0; $i < count($checkbox); $i++) {
            $ex_del = $this->Model_crud->delete('users', array("user_id" => $checkbox[$i]));
        }

        //notification
        if ($ex_del) {
            $this->session->set_userdata('user_success', 'Success: You have modified User!');
        } else {
            $this->session->set_userdata('user_error', 'Error: Please try again!');
        }

        redirect('admin/user');
    }
}
