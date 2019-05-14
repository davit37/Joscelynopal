<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Order extends CI_Controller {

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

            'title' => 'Order History'

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

        

        $customer_id = $this->session->userdata('uid');

        

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

        

        //Order History

        $data['orders'] = $this->Model_crud->select_where_order('order', array('customer_id'=>$customer_id), 'date_added', 'desc');

        

        //Order Status & Total Product

        $order_history = array();

        $total_product = array();

        $order_total = array();

        $i = 0;

        foreach ($data['orders'] as $order) {

            $oh = $this->Model_crud->select_where_order('order_history', array('order_id'=>$order['order_id']), 'date_added', 'desc');

            $order_history[$i] = $oh[0]['order_status'];

            

            $total_product[$i] = $this->Model_crud->total_row_where('order_product', array('order_id'=>$order['order_id']));

            

            $ot = $this->Model_crud->select_where('order_total', array('order_id'=>$order['order_id']));

            $order_total[$i] = $ot[0]['value'];

              

            $i++;

        }

        $data['order_history'] = $order_history;

        $data['total_product'] = $total_product;

        $data['order_total'] = $order_total;

        

        //Navigation

        $data['header'] = $this->Model_front->get_menu_header();

        $data['bottom'] = $this->Model_front->get_menu_bottom();



        $data['load_view'] = 'catalog/account/order';

        $this->load->view('template/frontend', $data);

    }

    

    public function info($seg1 = '') {

        //Data

        $data = $this->data;

        

        $order_id = $seg1;

        

        //Order ID

        $data['order_id'] = $order_id;

        

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

        

        //Order Detail

        $data['order_detail'] = $this->Model_crud->select_where('order',array('order_id'=>$order_id));

        

        //Zone

        $data['zone'] = $this->Model_crud->select_where('zone',array('zone_id'=>$data['order_detail'][0]['zone_id']));

        

        //Country

        $data['country'] = $this->Model_crud->select_where('country',array('country_id'=>$data['order_detail'][0]['country_id']));

        

        //Order Product

        $data['order_products'] = $this->Model_crud->select_where('order_product', array('order_id'=>$order_id));

        

        //Order Total

        $data['order_total'] = $this->Model_crud->select_where('order_total', array('order_id'=>$order_id));

        

        //Order Status

        $data['order_statues'] = $this->Model_crud->select_where('order_history', array('order_id'=>$order_id));

        

        //Navigation

        $data['header'] = $this->Model_front->get_menu_header();

        $data['bottom'] = $this->Model_front->get_menu_bottom();

        

        $data['load_view'] = 'catalog/account/order_info';

        $this->load->view('template/frontend', $data);

    }

}