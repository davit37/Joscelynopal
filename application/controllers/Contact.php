<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Contact extends CI_Controller {



    function __construct() {

        parent::__construct();



        //Load Model

        $this->load->model('Model_crud');

        $this->load->model('Model_front');

        //Data

        $this->data = array(

            'title' => 'Contact'

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



        //Data Contact

        $data['contact'] = $this->Model_crud->select_where('page', array('slug' => 'contact'));

        

        //Data Validation

        $this->session->unset_userdata('sum'); //Unset First

        $data['int1'] = mt_rand(1, 10);

        $data['int2'] = mt_rand(1, 10);

        $sum = $data['int1'] + $data['int2'];

        $this->session->set_userdata('sum', $sum);



        //Navigation

        $data['header'] = $this->Model_front->get_menu_header();

        $data['bottom'] = $this->Model_front->get_menu_bottom();

        $data['result_page'] = $this->Model_crud->select_where('page',array('slug' => $this->uri->segment(1)));



        //View

        $data['load_view'] = 'page_contact';

        $this->load->view('template/frontend', $data);

    }



    public function notify() {

        $name = $this->input->post('name');

        $email = $this->input->post('email');

        $comment = $this->input->post('comment');

        $validation = $this->input->post('validation');

        

        //Message

        $error = False;

        if ((strlen(trim($name)) < 1) || (strlen(trim($name)) > 64)) {

            $this->session->set_userdata('error_name', 'Name must be between 1 and 64 characters!');

            $error = TRUE;

        }

        if ((strlen($email) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {

            $this->session->set_userdata('error_email', 'E-Mail Address does not appear to be valid!');

            $error = TRUE;

        }

        if (strlen(trim($comment)) < 1) {

            $this->session->set_userdata('error_comment', 'Comment required!');

            $error = TRUE;

        }

        if ($validation != $this->session->userdata('sum')) {

            $this->session->set_userdata('error_validation', 'Validation not match!');

            $error = TRUE;

        }

        

        if($error) {

            redirect('contact');

        }

        

        $title = 'Contact Us Notification - Joscelyn Opal';



        $data_email = array(

            'name' => $name,

            'email' => $email,

            'comment' => $comment

        );

        

        // Setting Email

        $contact_email = $this->Model_crud->select_where('setting', array('setting_id' => 11));



        $this->_sendMail($contact_email[0]['value'], $title, $data_email);

        

        $this->session->set_userdata('contact_success', 'Success: You submission has been submit!');

        redirect('contact');

    }



    function _sendMail($seg1 = '', $seg2 = '', $seg3 = '') {

        $email = $seg1;

        $title = $seg2;

        $data_email = $seg3;

        

        //recipients

        $to = $email;



        //subject

        $subject = $title;



        // message

        $data = array();

        $data['title'] = $title;

        $data['store_url'] = base_url();

        $data['store_name'] = 'Joscelyn Opal';

        $data['logo'] = base_url('assets/images/general/logo_small.png');

        $data['text_greeting'] = 'Your customer contact your store';



        $data['name'] = $data_email['name'];

        $data['email'] = $data_email['email'];

        $data['comment'] = $data_email['comment'];



        $message = $this->load->view('email/page_contact', $data, TRUE);



        // To send HTML mail, the Content-type header must be set

        $headers = 'MIME-Version: 1.0' . "\r\n";

        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";



        // Additional headers

        $headers .= 'From: Joscelynopal <store@joscelynopal.com>' . "\r\n";



        // Mail it

        mail($to, $subject, $message, $headers);

    }



}

