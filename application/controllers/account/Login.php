<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Login extends CI_Controller {



    function __construct() {

        parent::__construct();



        //Load Model

        $this->load->model('Model_crud');

        $this->load->model('Model_front');



        //Data

        $this->data = array(

            'title' => 'Login'

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



        $data['load_view'] = 'catalog/account/login';

        $this->load->view('template/frontend', $data);

    }



    public function auth() {

        //Data

        $data = $this->data;



        $email = $this->input->post('email');

        $password = $this->input->post('password');



        //Message

        if ((strlen($email) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {

            $this->session->set_userdata('error_login', 'Warning: No match for E-Mail Address and/or Password.');

            redirect('account/login');

        }

        if ((strlen($password) < 4) || (strlen($password) > 20)) {

            $this->session->set_userdata('error_login', 'Warning: No match for E-Mail Address and/or Password.');

            redirect('account/login');

        }



        //Checking login

        $user = $this->Model_crud->select_where('customer', array('email' => $email));

        if ($user) {

            $hased_pass = $user[0]['password'];

            if(crypt($password, '$2a$07$padajodadhaihiw1oihlknkxnc8718e01eu0suc9862853uyvjheqvwd') == $hased_pass) {

                //Set Session for loged user

                $this->session->set_userdata('uid', $user[0]['customer_id']);

                

                redirect('account/user');

                

            } else {

                //Message

                $this->session->set_userdata('error_login', 'Warning: No match for E-Mail Address and/or Password.');



                redirect('account/login');

            }

            

        } else {

            //Message

            $this->session->set_userdata('error_login', 'Warning: No match for E-Mail Address and/or Password.');



            redirect('account/login');

        }

    }



}

