<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
    function __construct() {
        parent::__construct();
        
        //Load Model
        $this->load->model('Model_crud');
        $this->load->model('Model_front');
        $this->load->helper('text');
        
        //Data
        $this->data = array(
            'title' => 'Product'
        );
        
        if ($this->session->userdata('value_order_id')) {
            $check_order = $this->Model_crud->select_where('order', array(
                'order_id' => $this->session->userdata('value_order_id')
            ));
            
            if (!empty($check_order)) {
                if ($check_order[0]['order_status'] == 'Completed') {
                    
                    if ($this->session->userdata('guest_cart')) {
                        $this->session->unset_userdata('guest_cart');
                    }
                    
                    if ($this->session->userdata('uid')) {
                        $data_update = array(
                            "cart" => "[]"
                        );
                        $this->Model_crud->update('customer', $data_update, array(
                            'customer_id' => $this->session->userdata('uid')
                        ));
                    }
                    
                    $this->session->unset_userdata('value_order_id');
                }
            }
            
        }
        
        if ($this->session->userdata('guest_cart')) {
            $json     = json_decode($this->session->userdata('guest_cart'));
            $new_json = array();
            
            foreach ($json as $index => $value) {
                
                $prod_disabled = $this->Model_crud->select_where('product', array(
                    "product_id" => $value->product_id,
                    "status" => 0
                ));
                if (!empty($prod_disabled)) {
                    foreach ($prod_disabled as $key => $row) {
                        if ($value->product_id != $row['product_id']) {
                            $new_json[] = $value;
                        }
                    }
                } else {
                    $new_json[] = $value;
                }
            }
            if (!empty($new_json)) {
                $json = json_encode($new_json);
                $this->session->set_userdata('guest_cart', $json);
            } else {
                $this->session->unset_userdata('guest_cart');
            }
        }
        
        if ($this->session->userdata('uid')) {
            $json     = array();
            $new_json = array();
            $customer = $this->Model_crud->select_where('customer', array(
                'customer_id' => $this->session->userdata('uid')
            ));
            
            if ($customer[0]['cart']) {
                
                $json = json_decode($customer[0]['cart'], true);
                
            }
            
            if (!empty($json)) {
                foreach ($json as $index => $value) {
                    
                    $prod_disabled = $this->Model_crud->select_where('product', array(
                        "product_id" => $value['product_id'],
                        "status" => 0
                    ));
                    
                    if (!empty($prod_disabled)) {
                        foreach ($prod_disabled as $key => $row) {
                            if ($value['product_id'] != $row['product_id']) {
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
            
            if (!empty($new_json)) {
                $data_update = array(
                    "cart" => json_encode($new_json)
                );
                $this->Model_crud->update('customer', $data_update, array(
                    'customer_id' => $this->session->userdata('uid')
                ));
            } else {
                $data_update = array(
                    "cart" => "[]"
                );
                $this->Model_crud->update('customer', $data_update, array(
                    'customer_id' => $this->session->userdata('uid')
                ));
            }
            
        }
    }
    
    public function index() {
        //Data
        $data = $this->data;
        
        //Category
        $data['category'] = $this->Model_crud->select_where_order('category', array(
            "status" => 1
        ), 'sort_order', 'asc');
        
        //Cart
        $data['cart'] = array();
        if ($this->session->userdata('uid')) {
            $customer = $this->Model_crud->select_where('customer', array(
                'customer_id' => $this->session->userdata('uid')
            ));
            if ($customer[0]['cart']) {
                $data['cart'] = json_decode($customer[0]['cart'], true);
            }
        }
        
        if ($this->uri->segment(2)) {
            //Data Product
            $data['product'] = $this->Model_crud->select_where('product', array(
                "slug" => $this->uri->segment(2),
                "status" => 1
            ));
            
            // Data Social Media
            $data['fb'] = $this->Model_crud->select_where('setting', array(
                'setting_id' => 21
            ));
            $data['tw'] = $this->Model_crud->select_where('setting', array(
                'setting_id' => 22
            ));
            $data['ig'] = $this->Model_crud->select_where('setting', array(
                'setting_id' => 23
            ));
            
            //Data Product Image
            $data['product_image'] = $this->Model_crud->select_where('product_image', array(
                "product_id" => $data['product'][0]['product_id']
            ));
            
            //Data Product Video
            $data['product_video'] = $this->Model_crud->select_where('product_video', array(
                "product_id" => $data['product'][0]['product_id']
            ));
            
            //Data Review
            $data['review'] = $this->Model_front->get_product_review_single($data['product'][0]['slug']);
            
            //Option
            $data['option'] = $this->Model_crud->select('option');
            
            //Product Option
            $data['product_option'] = $this->Model_crud->select_where('p_option', array(
                "id" => $data['product'][0]['option_id']
            ));
            
            //Product Option Value
            $data['product_option_values'] = $this->Model_crud->select_where('product_option_value', array(
                "product_id" => $data['product'][0]['product_id']
            ));
            
            //Data Product Special
            $data['product_special'] = $this->Model_crud->select_where('product_special', array(
                "product_id" => $data['product'][0]['product_id']
            ));
            if ($data['product_special']) {
                $now_sp      = strtotime(date('Y-m-d'));
                $date_end_sp = strtotime($data['product_special'][0]['date_end']);
                if ($date_end_sp >= $now_sp) {
                    $flag_special_sp = $data['product_special'];
                } else {
                    $flag_special_sp = FALSE;
                }
            } else {
                $flag_special_sp = FALSE;
            }
            $data['product_special'] = $flag_special_sp;
            
            //Data Product Review
            $data['product_review'] = $this->Model_crud->select_where('review', array(
                "product_id" => $data['product'][0]['product_id'],
                "status" => 1
            ));
            
            //Random Product
            $total_product = $this->Model_crud->total_row_where('product', array(
                "status" => 1
            ));
            if ($total_product > 4) {
                $limit = 4;
            } else {
                $limit = $total_product;
            }
            $product = $this->Model_crud->select_where('product', array(
                "status" => 1
            ));
            $number  = range(0, $total_product - 1);
            shuffle($number);
            $random_product = array();
            for ($i = 0; $i < $limit; $i++) {
                $special = $this->Model_crud->select_where('product_special', array(
                    "product_id" => $product[$number[$i]]['product_id']
                ));
                if ($special) {
                    $now      = strtotime(date('Y-m-d'));
                    $date_end = strtotime($special[0]['date_end']);
                    if ($date_end >= $now) {
                        $flag_special = $special;
                    } else {
                        $flag_special = FALSE;
                    }
                } else {
                    $flag_special = FALSE;
                }
                
                $random_product[$i]['image']       = $product[$number[$i]]['image'];
                $random_product[$i]['name']        = $product[$number[$i]]['name'];
                $random_product[$i]['description'] = $product[$number[$i]]['description'];
                $random_product[$i]['price']       = $product[$number[$i]]['price'];
                $random_product[$i]['special']     = $flag_special;
                $random_product[$i]['slug']        = $product[$number[$i]]['slug'];
            }
            $data['random_product'] = $random_product;
            
            $data['title'] = $data['product'][0]['name'];
            
            //Navigation
            $data['header'] = $this->Model_front->get_menu_header();
            $data['bottom'] = $this->Model_front->get_menu_bottom();
            
            $data['load_view'] = 'page_product_single';
            $this->load->view('template/frontend', $data);
        } else {
            //Product
            $query            = "SELECT p.*, ps.price as special, ps.date_end FROM product p LEFT JOIN product_special ps ON p.product_id = ps.product_id WHERE p.status = 1";
            $data['products'] = $this->Model_crud->select_query($query);
            
            //Navigation
            $data['header'] = $this->Model_front->get_menu_header();
            $data['bottom'] = $this->Model_front->get_menu_bottom();
            
            $data['load_view'] = 'page_search';
            $this->load->view('template/frontend', $data);
        }
        
    }
}