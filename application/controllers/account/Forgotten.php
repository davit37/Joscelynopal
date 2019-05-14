<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Forgotten extends CI_Controller {



    function __construct() {

        parent::__construct();



        //Load Model

        $this->load->model('Model_crud');

        $this->load->model('Model_front');

        //Data

        $this->data = array(

            'title' => 'Forgot Your Password?'

        );

        if($this->session->userdata('value_order_id')){
            $check_order = $this->Model_crud->select_where('order',array('order_id' => $this->session->userdata('value_order_id')));

            if(!empty($check_order)){
                if($check_order[0]['order_status'] == 'Completed'){

                    if($this->session->userdata('guest_cart')){
                        $this->session->unset_userdata('guest_cart');
                    }

                    if ($this->session->userdata('uid')) {
                        $data_update = array(
                            "cart" => "[]"
                            );
                        $this->Model_crud->update('customer', $data_update, array('customer_id' => $this->session->userdata('uid')));
                    }

                    $this->session->unset_userdata('value_order_id');
                }
            }

        }

        if($this->session->userdata('guest_cart')){
            $json = json_decode($this->session->userdata('guest_cart'));
            $new_json = array();

            foreach($json as $index => $value){

                $prod_disabled = $this->Model_crud->select_where('product', array(
                    "product_id" => $value->product_id,
                    "status"=> 0
                    ));
                if(!empty($prod_disabled)){
                    foreach($prod_disabled as $key => $row){
                        if($value->product_id != $row['product_id']){
                            $new_json[] = $value;
                        }
                    }
                } else {
                    $new_json[] = $value;
                }
            }
            if(!empty($new_json)){
                $json = json_encode($new_json);
                $this->session->set_userdata('guest_cart',$json);
            } else {
                $this->session->unset_userdata('guest_cart');   
            }
        }

        if ($this->session->userdata('uid')) {
            $json = array();
            $new_json = array();
            $customer = $this->Model_crud->select_where('customer', array('customer_id' => $this->session->userdata('uid')));

            if ($customer[0]['cart']) {

                $json = json_decode($customer[0]['cart'], true);

            }

            if(!empty($json)){
                foreach($json as $index => $value){

                    $prod_disabled = $this->Model_crud->select_where('product', array(
                        "product_id" => $value['product_id'],
                        "status"=> 0
                        ));

                    if(!empty($prod_disabled)){
                        foreach($prod_disabled as $key => $row){
                            if($value['product_id'] != $row['product_id']){
                                $new_json[] = $value;
                            }
                        }
                    } else {
                        $new_json[] = $value;
                    }
                }
            } else {
                $new_json = $json;
            }

            if(!empty($new_json)){
                $data_update = array(
                    "cart" => json_encode($new_json)
                    );
                $this->Model_crud->update('customer', $data_update, array('customer_id' => $this->session->userdata('uid')));
            } else {
                $data_update = array(
                    "cart" => "[]"
                    );
                $this->Model_crud->update('customer', $data_update, array('customer_id' => $this->session->userdata('uid'))); 
            }

        }
        
    }



    public function index() {

        //Data

        $data = $this->data;



        //Category

        $data['category'] = $this->Model_crud->select_where_order('category', array("status" => 1), 'sort_order', 'asc');



        //Cart

        $data['cart'] = array();

        if ($this->session->userdata('uid')) {

            $customer = $this->Model_crud->select_where('customer', array('customer_id' => $this->session->userdata('uid')));

            if ($customer[0]['cart']) {

                $data['cart'] = json_decode($customer[0]['cart'], true);

            }

        }



        //Navigation

        $data['header'] = $this->Model_front->get_menu_header();

        $data['bottom'] = $this->Model_front->get_menu_bottom();



        $data['load_view'] = 'catalog/account/forgotten';

        $this->load->view('template/frontend', $data);

    }



    public function reset() {

        $email = $this->input->post('email');



        //Message

        if ((strlen($email) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {

            $this->session->set_userdata('error_login', 'Warning: No match for E-Mail Address.');

            redirect('account/forgotten');

        }



        $check_temp = $this->Model_crud->total_row_where('temp_forgot', array('email'=>$email));

        if ($check_temp > 0) {

            $this->session->set_userdata('error_login', 'Warning! Your email already submited');

            redirect('account/forgotten');

        } else {

            $customer = $this->Model_crud->select_where('customer', array('email'=>$email));

            if ($customer) {

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

                $var_to_repl = array(base_url(),  base_url('account/forgotten/token/'.$data['token']));

                

                $this->_sendMail($email, $title, $dir, $var, $var_to_repl);

                

                $this->session->set_userdata('success', 'Reset password has been send to your mail');

                redirect('account/login');

                

            } else {

                $this->session->set_userdata('error_login', 'Warning! Your email never exist');

                redirect('account/forgotten');

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

                

                $data_update = array(

                    "password" => crypt($new_pass, '$2a$07$padajodadhaihiw1oihlknkxnc8718e01eu0suc9862853uyvjheqvwd')

                );

                

                $this->Model_crud->update('customer', $data_update, array('email'=>$num[0]['email']));

                

                $title = 'New Password';

                $dir = base_url('assets/email/forgotten_reset.php');

                $var = array('{base_url}','{password}','{login}');

                $var_to_repl = array(base_url(), $new_pass, base_url('account/login'));

                

                $this->_sendMail($num[0]['email'], $title, $dir, $var, $var_to_repl);



                $this->session->set_userdata('success', 'New password has been send to your mail');

                $this->Model_crud->delete('temp_forgot', array("token"=>$token));

                redirect('account/login');

            } else {

                redirect('account/login');

            }

        } else {

            redirect('account/login');

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

