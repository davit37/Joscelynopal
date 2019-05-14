<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Australian_opal extends CI_Controller {

    function __construct() {
        parent::__construct();

        //Load Model
        $this->load->model('Model_crud');
        $this->load->helper('text');

        //Data
        $this->data = array(
            'title' => 'Australian Opal'
        );
    }

    public function index() {
        //Data
        $data = $this->data;
        
        //Category
        $data['category'] = $this->Model_crud->select_where_order('category', array("status"=>1), 'sort_order', 'asc');
        
        //Cart
        $data['cart'] = array();
        if ($this->session->userdata('uid')) {
            $customer = $this->Model_crud->select_where('customer', array('customer_id' => $this->session->userdata('uid')));
            if ($customer[0]['cart']) {
                $data['cart'] = json_decode($customer[0]['cart'], true);
            }    
        }
        
        //Content
        $data['content'] = $this->Model_crud->select_where('category', array(
            "slug"=>$this->uri->segment(1)
                ));
        if(!$data['content']) {show_404();}
        $data['title'] = $data['content'][0]['name'];
        
        if ($this->uri->segment(2)) {
            //Data Product
            $data['product'] = $this->Model_crud->select_where('product', array("slug"=>$this->uri->segment(2)));
            
            // Data Social Media
            $data['fb'] = $this->Model_crud->select_where('setting', array('setting_id'=>21));
            $data['tw'] = $this->Model_crud->select_where('setting', array('setting_id'=>22));
            $data['ig'] = $this->Model_crud->select_where('setting', array('setting_id'=>23));

            //Data Product Image
            $data['product_image'] = $this->Model_crud->select_where('product_image', array("product_id"=>$data['product'][0]['product_id']));

            //Data Product Video
            $data['product_video'] = $this->Model_crud->select_where('product_video', array("product_id"=>$data['product'][0]['product_id']));

            //Data Product Special
            $data['product_special'] = $this->Model_crud->select_where('product_special', array("product_id"=>$data['product'][0]['product_id']));
            if($data['product_special']) {
                $now_sp = strtotime(date('Y-m-d'));
                $date_end_sp = strtotime($data['product_special'][0]['date_end']);
                if($date_end_sp >= $now_sp ) {
                    $flag_special_sp = $data['product_special'];
                } else {
                    $flag_special_sp = FALSE;
                } 
            } else {
                $flag_special_sp = FALSE;
            }
            $data['product_special'] = $flag_special_sp;
            
            //Data Product Review
            $data['product_review'] = $this->Model_crud->select_where('review', array("product_id"=>$data['product'][0]['product_id'],"status"=>1));
            
            //Random Product
                $total_product = $this->Model_crud->total_row_where('product', array("category_id"=>$data['product'][0]['category_id']));
                if($total_product > 4) {
                    $limit = 4;
                } else {
                    $limit = $total_product;
                }
                $product = $this->Model_crud->select_where('product', array("category_id"=>$data['product'][0]['category_id']));
                $number = range(0, $total_product-1);
                shuffle($number);
                $random_product = array();
                for ($i=0;$i<$limit;$i++) {
                    $special = $this->Model_crud->select_where('product_special', array("product_id"=>$product[$number[$i]]['product_id']));
                    if($special) {
                        $now = strtotime(date('Y-m-d'));
                        $date_end = strtotime($special[0]['date_end']);
                        if($date_end >= $now ) {
                            $flag_special = $special;
                        } else {
                            $flag_special = FALSE;
                        } 
                    } else {
                        $flag_special = FALSE;
                    }
                    
                    $random_product[$i]['image'] = $product[$number[$i]]['image'];
                    $random_product[$i]['name'] = $product[$number[$i]]['name'];
                    $random_product[$i]['description'] = $product[$number[$i]]['description'];
                    $random_product[$i]['price'] = $product[$number[$i]]['price'];
                    $random_product[$i]['special'] = $flag_special;
                    $random_product[$i]['slug'] = $product[$number[$i]]['slug'];
                }
                $data['random_product'] = $random_product;
            
            $data['title'] = $data['product'][0]['name'];
            $data['load_view'] = 'page_product_single';
            $this->load->view('template/frontend', $data);
        } else {
            //Product
            $query = "SELECT p.*, ps.price as special, ps.date_end FROM product p LEFT JOIN product_special ps ON p.product_id = ps.product_id WHERE p.category_id = ".$data['content'][0]['category_id'];
            $data['products'] = $this->Model_crud->select_query($query);
            
            $data['load_view'] = 'page_australian';
            $this->load->view('template/frontend', $data);
        }
    }

}
