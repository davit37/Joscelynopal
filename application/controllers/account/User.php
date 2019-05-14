<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class User extends CI_Controller {

    function __construct() {

        parent::__construct();

        //Load Model

        $this->load->model('Model_crud');

        $this->load->model('Model_front');

        if(!$this->session->userdata('uid')) {

            redirect('account/login');

        }

        //Data

        $this->data = array(

            'title' => 'Account'

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



        $data['load_view'] = 'catalog/account/user';

        $this->load->view('template/frontend', $data);

    }

    

    public function edit() {

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

        

        //Data User

        $data['user'] = $this->Model_crud->select_where('customer', array('customer_id' => $this->session->userdata('uid')));

        

        //Country

        $data['countries'] = $this->Model_crud->select('country');



        //First Selected Zone

        $data['zones'] = $this->Model_crud->select_where('zone', array('country_id' => $data['user'][0]['country_id']));

        

        //Navigation

        $data['header'] = $this->Model_front->get_menu_header();

        $data['bottom'] = $this->Model_front->get_menu_bottom();



        $data['load_view'] = 'catalog/account/user_edit';

        $this->load->view('template/frontend', $data);

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

            

            redirect('account/user/edit');

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

            

            $ex_update = $this->Model_crud->update('customer', $data_update, array('customer_id'=>$this->session->userdata('uid')));

            

            //Update table subscriber

            if($ex_update == TRUE) {

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

                

                $this->Model_crud->update('subscribe', $data_update, array('customer_id' => $this->session->userdata('uid')));

            }

            

            //Message

            $this->session->set_userdata('success', 'Success: Your account has been successfully updated.');

            

            redirect('account/user');

        }

    }

    

    public function password() {

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

        

        $data['load_view'] = 'catalog/account/password';

        $this->load->view('template/frontend', $data);

    }

    

    public function password_update() {

        //Validation rule

        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        $this->form_validation->set_rules('confirm', 'Password Confirmation', 'required|matches[password]');

        

        $password = $this->input->post('password');

        $confirm = $this->input->post('confirm');

        

        if ($this->form_validation->run() == FALSE) {

            if ((strlen($password) < 4) || (strlen($password) > 20)) {

                $this->session->set_userdata('error_password', 'Password must be between 4 and 20 characters!');

            }

            if ($confirm != $password) {

                $this->session->set_userdata('error_confirm', 'Password confirmation does not match password!');

            }

            redirect('account/user/password');

        } else {

            $data_update = array(

                "password" => crypt($password, '$2a$07$padajodadhaihiw1oihlknkxnc8718e01eu0suc9862853uyvjheqvwd')

            );

            $ex_update = $this->Model_crud->update('customer', $data_update, array('customer_id'=>$this->session->userdata('uid')));

            

            if($ex_update) {

                $this->session->set_userdata('success', 'Success: Your password has been successfully updated.');

                redirect('account/user');

            } else {

                $this->session->set_userdata('error', 'Error: please try again.');

                redirect('account/user');

            }

        }

    }

}