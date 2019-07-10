<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

    function __construct() {
        parent::__construct();

        //Load Model
        $this->load->model('Model_crud');
        $this->load->model('Model_front');
        $this->load->helper('text');
        $this->load->library('pagination');

        //Data
        $this->data = array(
            'title' => 'Shop'
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

    public function index($seg1 = '', $seg2 = '', $seg3 = '') {
        //Data
        $data = $this->data;
        if(empty($seg2)) {
            $seg2 = 'featured';
        }
        
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
            "slug"=>$this->uri->segment(2),
            "status"=>1
            ));
        if(!$data['content']) {show_404();}
        $data['title'] = $data['content'][0]['name'];
        
        //Pagnation
        $config["base_url"] = base_url('shop/'.$seg1.'/'.$seg2);
        $config["total_rows"] = $this->Model_crud->total_row_where('product', array("category_id"=>$data['content'][0]['category_id']));
        $config["per_page"] = 8;
        $config["uri_segment"] = 4;
        $config['use_page_numbers'] = TRUE;

        //Customize
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><span>';
        $config['cur_tag_close'] = '</span></li>';
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config['next_link'] = '&gt;';
        $config['prev_link'] = '&lt;';
        $config['first_link'] = '|&lt;';
        $config['last_link'] = '&gt;|';
        
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 1;
        $this->pagination->initialize($config);

        switch ($seg2) {
            case 'featured':
                //Class Active
            $data['active'] = 'featured';
            $data['load_view'] = 'page_product';

                //Data Product
            $query = "SELECT p.*, ps.price as special, ps.date_end FROM product p LEFT JOIN product_special ps ON p.product_id = ps.product_id WHERE p.status = 1 AND p.category_id = ".$data['content'][0]['category_id']." ORDER BY p.featured desc LIMIT ".(($page - 1) * $config['per_page']).", ".$config["per_page"];
            $data['products'] = $this->Model_crud->select_query($query);
            break;
            case 'newest':
                //Class Active
            $data['active'] = 'newest';
            $data['load_view'] = 'page_product';

                //Data Product
            $query = "SELECT p.*, ps.price as special, ps.date_end FROM product p LEFT JOIN product_special ps ON p.product_id = ps.product_id WHERE p.status = 1 AND p.category_id = ".$data['content'][0]['category_id']." ORDER BY p.date_added desc LIMIT ".(($page - 1) * $config['per_page']).", ".$config["per_page"];
            $data['products'] = $this->Model_crud->select_query($query);
            break;
            case 'top-rated':
                //Class Active
            $data['active'] = 'top-rated';
            $data['load_view'] = 'page_product';

                //Data Product
            $query = "SELECT p.*, ps.price as special, ps.date_end, SUM(r.rating) as rating FROM product p LEFT JOIN product_special ps ON p.product_id = ps.product_id LEFT JOIN review r ON p.product_id = r.product_id WHERE p.status = 1 AND p.category_id = ".$data['content'][0]['category_id']." GROUP BY p.product_id ORDER BY rating desc LIMIT ".(($page - 1) * $config['per_page']).", ".$config["per_page"];
            $data['products'] = $this->Model_crud->select_query($query);
            break;
            case 'price-high-to-low':
                //Class Active
            $data['active'] = 'price-high-to-low';
            $data['load_view'] = 'page_product';

                //Data Product
            $query = "SELECT p.*, ps.price as special, ps.date_end FROM product p LEFT JOIN product_special ps ON p.product_id = ps.product_id WHERE p.status = 1 AND p.category_id = ".$data['content'][0]['category_id']." ORDER BY p.price desc LIMIT ".(($page - 1) * $config['per_page']).", ".$config["per_page"];
            $data['products'] = $this->Model_crud->select_query($query);
            break;
            case 'price-low-to-high':
                //Class Active
            $data['active'] = 'price-low-to-high';
            $data['load_view'] = 'page_product';

                //Data Product
            $query = "SELECT p.*, ps.price as special, ps.date_end FROM product p LEFT JOIN product_special ps ON p.product_id = ps.product_id WHERE p.status = 1 AND p.category_id = ".$data['content'][0]['category_id']." ORDER BY p.price asc LIMIT ".(($page - 1) * $config['per_page']).", ".$config["per_page"];
            $data['products'] = $this->Model_crud->select_query($query);
            break;
            default :
            $data['load_view'] = 'page_product_single';

                // Data Social Media
            $data['fb'] = $this->Model_crud->select_where('setting', array('setting_id'=>21));
            $data['tw'] = $this->Model_crud->select_where('setting', array('setting_id'=>22));
            $data['ig'] = $this->Model_crud->select_where('setting', array('setting_id'=>23));

                //Data Product
            $data['product'] = $this->Model_crud->select_where('product', array("slug"=>$seg2,"status" => 1));

                //Data Review
            $data['review']  = $this->Model_front->get_product_review_single($data['product'][0]['slug']);

                //Data Product Image
            $data['product_image'] = $this->Model_crud->select_where('product_image', array("product_id"=>$data['product'][0]['product_id']));

                //Data Product Video
            $data['product_video'] = $this->Model_crud->select_where('product_video', array("product_id"=>$data['product'][0]['product_id']));

                //Option
            $data['option'] = $this->Model_crud->select('option');

            //Product Option
            $data['product_option'] = $this->Model_crud->select_where('p_option', array(
                "id" => $data['product'][0]['option_id']
            ));
                //Product Option Value
            $data['product_option_values'] = $this->Model_crud->select_where('product_option_value', array("product_id"=>$data['product'][0]['product_id']));

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
            $total_product = $this->Model_crud->total_row_where('product', array("status"=>1));
            if($total_product > 4) {
                $limit = 4;
            } else {
                $limit = $total_product;
            }
            $product = $this->Model_crud->select_where('product', array("status" => 1));
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
        }
        
        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;
        if(isset($data["products"])) {
            $data['last_result'] = count($data["products"]) + (($page - 1) * $config['per_page']);
        }
        $data['total_result'] = $config["total_rows"];
        $data['current_page'] = $page;
        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);
        if($data['total_page'] > 1) {
            $data['next_page'] = $config["base_url"] . '/' . ($page + 1);
        } else {
            $data['next_page'] = $config["base_url"] . '/' . ($page);
        }
        $data["links"] = $this->pagination->create_links();
        
        //Navigation
        $data['header'] = $this->Model_front->get_menu_header();
        $data['bottom'] = $this->Model_front->get_menu_bottom();

        //View
        $this->load->view('template/frontend', $data);
    }

}
