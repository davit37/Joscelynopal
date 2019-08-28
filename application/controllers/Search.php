<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Search extends CI_Controller {

    function __construct() {

        parent::__construct();



        //Load Model

        $this->load->model('Model_crud');

        $this->load->model('Model_front');

        $this->load->helper('text');



        //Data

        $this->data = array(

            'title' => 'Search'

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

    

    public function index($seg1 = '') {


        

        if($seg1 == '') {

            $filter = $this->input->post('search');

          

        } else {

            $filter = $seg1;

        }

        $filter = $this->security->xss_clean($filter);

        $filter = str_replace( array( "'","'" ),'',$filter );

        

        if($filter == '') {

            $filter = 'no product';

        }

        

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

        

        

        //Data Product

        $query = "SELECT p.*, ps.price as special, ps.date_end FROM product p LEFT JOIN product_special ps ON p.product_id = ps.product_id WHERE p.status = 1 AND p.name LIKE '%".$filter."%' ESCAPE '!'";


        
        $data['products'] = $this->Model_crud->select_query($query);

        

        //Data Product Category

        if($data['products']) {

            $product_category = array();

            $i=0;

            foreach ($data['products'] as $row) {

                $category = $this->Model_crud->select_where('category', array('category_id'=>$row['category_id']));

                $product_category[$i] = $category[0]['name'];

                $i++;

            }

        }



        //Navigation

        $data['header'] = $this->Model_front->get_menu_header();

        $data['bottom'] = $this->Model_front->get_menu_bottom();

       

        //View

        $data['load_view'] = 'page_search';

        $this->load->view('template/frontend', $data);

    }

}