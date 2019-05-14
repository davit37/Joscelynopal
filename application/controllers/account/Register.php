<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Register extends CI_Controller {



    function __construct() {

        parent::__construct();



        //Load Model

        $this->load->model('Model_crud');

        $this->load->model('Model_front');

        

        //Data

        $this->data = array(

            'title' => 'Register'

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



        //Country

        $data['countries'] = $this->Model_crud->select('country');



        //First Selected Zone

        $data['zones'] = $this->Model_crud->select_where('zone', array('country_id' => 100));



        //Navigation

        $data['header'] = $this->Model_front->get_menu_header();

        $data['bottom'] = $this->Model_front->get_menu_bottom();



        $data['load_view'] = 'catalog/account/register';

        $this->load->view('template/frontend', $data);

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

        $this->form_validation->set_rules('agree', 'Agree', 'trim|required|xss_clean');



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

        $agree = $this->input->post('agree');



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

            if (!isset($agree)) {

                $this->session->set_userdata('error_agree', 'Warning: You must agree to the Privacy Policy!');

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

            redirect('account/register');

        } else {

            //Check Duplicate Email

            $check_dp = $this->Model_crud->total_row_where('customer', array('email'=>$email));

            if($check_dp > 0) {

                $this->session->set_userdata('error_email', 'E-Mail Address already used!');

                redirect('account/register');

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

            

            //Send Email

            $title = 'Customer';

            $dir = base_url('assets/email/account_register.php');

            $var = array('{base_url}','{username}','{password}','{login}');

            $var_to_repl = array(base_url(), $email, $password, base_url('account/login'));

                

            $this->_sendMail($num[0]['email'], $title, $dir, $var, $var_to_repl);

            

            

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

            

            redirect('account/register/success');

        }

    }

    

    public function success() {

        //Data

        $data = $this->data;



        //Category

        $data['category'] = $this->Model_crud->select_where_order('category', array("status" => 1), 'sort_order', 'asc');



        //Navigation

        $data['header'] = $this->Model_front->get_menu_header();

        $data['bottom'] = $this->Model_front->get_menu_bottom();



        $data['load_view'] = 'catalog/account/success';

        $this->load->view('template/frontend', $data);

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

