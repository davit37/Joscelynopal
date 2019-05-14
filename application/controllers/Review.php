<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Review extends CI_Controller {

    function __construct() {

        parent::__construct();



        //Load Model

        $this->load->model('Model_crud');

        $this->load->model('Model_front');

        //Data

        $this->data = array(

            'title' => 'Review'

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

    
    public function index($segment_2 = ''){

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

        $data['order_product']  = array();

        $segment_2 = $this->uri->segment(2);
        if(!empty($segment_2)){
            $data['order_product'] = $this->Model_front->get_product_review($segment_2);
        }

        //View

        $data['load_view'] = 'page_review';

        $this->load->view('template/frontend', $data);

    }

    public function form(){

        $this->form_validation->set_rules('rating[]','Rating','required|trim');
        $this->form_validation->set_rules('message[]','Message','required|trim');

        if($this->form_validation->run() == false){
            $result = array(
                'status'    => 'error',
                'message'   => validation_errors()
                );

            echo json_encode($result);
        } else {
            $url        = $this->input->post('url',true);
            $message    = $this->input->post('message',true);
            $product_id = $this->input->post('product_id',true);
            $rating     = $this->input->post('rating',true);
            $order_id   = $this->input->post('order_id',true);

            $check_review_status = $this->Model_front->check_review_status($url);

            if($check_review_status){

                if(!empty($product_id)){
                    foreach($product_id as $index => $value){
                        $insert = array(
                            'order_id'   => $order_id,
                            'product_id' => $value,
                            'text'       => $message[$index],
                            'rating'     => $rating[$index],
                            'status'     => 0,
                            'date_added' => date('c')
                            );

                        $ins = $this->Model_crud->insert('review',$insert);

                        if($ins){
                            $update_order_status = array(
                                'review_status' => 'Completed'
                                );
                            $this->Model_crud->update('order',$update_order_status,array('order_id' => $order_id));

                            $result = array(
                                'status' => 'success',
                                'message' => 'Thank you for your feedback.'
                                );
                        }

                    }   
                } else {

                    $result = array(
                                'status' => 'error',
                                'message' => 'Already submit your review.'
                                );

                }

            } else {
                $result = array(
                    'status'  => 'error',
                    'message' => 'Your link review has been expired.'
                    );
            }

            echo json_encode($result);
            
        }

    }
    /*public function index() {

        //Data

        $data = $this->data;

        

        $email = $this->input->post('email');

        $rating = $this->input->post('rating');

        $message = $this->input->post('message');

        $product_id = $this->input->post('product_id');

        $customer_id = $this->input->post('customer_id');

        $title = $this->input->post('title');

        

        $email = $this->security->xss_clean($email);

        $rating = $this->security->xss_clean($rating);

        $message = $this->security->xss_clean($message);

        $product_id = $this->security->xss_clean($product_id);

        $customer_id = $this->security->xss_clean($customer_id);

        $title = $this->security->xss_clean($title);

        

        $data_insert = array(

            'product_id' => $product_id,

            'customer_id' => $customer_id,

            'author' => $email,

            'title' => $title,

            'text' => $message,

            'rating' => $rating,

            'date_added' => date('c')

        );

        

        $ex_ins = $this->Model_crud->insert('review', $data_insert);

        

        header('Content-Type: application/json');

        echo json_encode($ex_ins);

    }*/

    

    public function subscribe() {

        $email = $this->input->post('email');

        $email = $this->security->xss_clean($email);

        

        //Cek Email if Exist

        $chk_mail = $this->Model_crud->select_where('subscribe', array("email"=>$email));

        

        if(!$chk_mail) {

            $data_insert = array(

                'email' => $email,

                'date_added' => date('c')

                );



            $ex_ins = $this->Model_crud->insert('subscribe', $data_insert);

        } else {

            $ex_ins = FALSE;

        }

        

        header('Content-Type: application/json');

        echo json_encode($ex_ins);

    }

}