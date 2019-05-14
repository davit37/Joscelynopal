<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotten extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        // load the library
        $this->load->model('Model_crud');
        
        //Data
        $this->data = array(
            'title' => 'Forgot Password'
        );
    }

    public function index() {
        //Data
        $data = $this->data;
        
        $data['title'] = 'Forgot Your Password?';
        
        //View
        $data['load_view'] = 'admin/page_forgotten';
        $this->load->view('admin/template/backend', $data);
    }

    public function reset() {
        $email = $this->input->post('email');

        //Message
        if ((strlen($email) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
            $this->session->set_userdata('error_warning', 'Warning: No match for E-Mail Address.');
            redirect('admin/forgotten');
        }

        $check_temp = $this->Model_crud->total_row_where('temp_forgot', array('email'=>$email));
        if ($check_temp > 0) {
            $this->session->set_userdata('error_warning', 'Warning! Your email already submited');
            redirect('admin/forgotten');
        } else {
            $user = $this->Model_crud->select_where('users', array('user_email'=>$email));
            if ($user) {
                $startDate = time();
                $data = array(
                    "email" => $email,
                    "token" => md5(rand()),
                    "expired" => date('Y-m-d H:i:s', strtotime('+1 day', $startDate)),
                );
                $this->Model_crud->insert('temp_forgot', $data);
                
                $title = 'Reset Password Token';
                $dir = base_url('assets/email/forgotten_token.php');
                $var = array('{base_url}','{token}');
                $var_to_repl = array(base_url(),  base_url('admin/forgotten/token/'.$data['token']));
                
                $this->_sendMail($email, $title, $dir, $var, $var_to_repl);
                
                $this->session->set_userdata('success', 'Reset password has been send to your mail');
                redirect('admin/login');
                
            } else {
                $this->session->set_userdata('error_warning', 'Warning! Your email never exist');
                redirect('admin/forgotten');
            }
        }
    }
    
    public function token($token) {
        //Delete Old token first
        $this->Model_crud->checkToken();
        
        if (isset($token)) {
            $num = $this->Model_crud->select_where('temp_forgot', array("token" => $token));
            if ($num) {
                $new_pass = rand();
                
                // Update Password
                $data_update = array(
                    'user_pass' => crypt($new_pass, '$2a$07$padajodadhaihiw1oihlknkxnc8718e01eu0suc9862853uyvjheqvwd')
                );
                $this->Model_crud->update('users', $data_update, array('user_email'=>$num[0]['email']));
                
                $title = 'New Password';
                $dir = base_url('assets/email/forgotten_reset.php');
                $var = array('{base_url}','{password}','{login}');
                $var_to_repl = array(base_url(), $new_pass, base_url('admin/login'));
                
                $this->_sendMail($num[0]['email'], $title, $dir, $var, $var_to_repl);

                $this->session->set_userdata('success', 'New password has been send to your mail');
                $this->Model_crud->delete('temp_forgot', array("token"=>$token));
                redirect('admin/login');
            } else {
                redirect('admin/login');
            }
        } else {
            redirect('admin/login');
        }
    }
    
    function _sendMail($seg1 = '', $seg2 = '', $seg3 = '', $seg4 = '', $seg5 = '') {
        $email = $seg1;
        $title = $seg2;
        $dir = $seg3;
        $var = $seg4;
        $var_to_repl = $seg5;
        
        //recipients
        $to = $email;

        //subject
        $subject = $title;

        // message
        $message = file_get_contents($dir);
        $message = eregi_replace("[\]",'',$message);

        //setup vars to replace
        $vars = $var;
        $values = $var_to_repl;

        //replace vars
        $message = str_replace($vars,$values,$message);

        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'From: Joscelynopal <store@joscelynopal.com>' . "\r\n";

        // Mail it
        mail($to, $subject, $message, $headers);
    }

}
