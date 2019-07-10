<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Process extends CI_Controller {

    function __construct() {
        parent::__construct();

        //Load Model
        $this->load->model('Model_crud');
        $this->load->model('Model_front');
        //Data
        $this->data = array(
            'title' => 'Checkout'
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
        
        //Term & Condition
        $data['term_condition'] = $this->Model_crud->select_where('page', array("page_id"=>4));

        //Cart
        $data['cart'] = array();
        if ($this->session->userdata('uid')) {
            $customer = $this->Model_crud->select_where('customer', array('customer_id' => $this->session->userdata('uid')));
            if ($customer[0]['cart']) {
                $data['cart'] = json_decode($customer[0]['cart'], true);
            }
        }

        /* Biling Detail Start */
        //Data User
        $data['user'] = $this->Model_crud->select_where('customer', array('customer_id' => $this->session->userdata('uid')));

        //Country
        $data['countries'] = $this->Model_crud->select('country');

        //First Selected Zone
        $country_id = ($data['user']) ? $data['user'][0]['country_id'] : 100;
        $data['zones'] = $this->Model_crud->select_where('zone', array('country_id' => $country_id));
        /* Biling Detail End */

        /* Get Cart Start */
        $json = array();
        if ($this->session->userdata('uid')) {
            $customer = $this->Model_crud->select_where('customer', array('customer_id' => $this->session->userdata('uid')));
            if ($customer[0]['cart']) {
                $json = json_decode($customer[0]['cart'], true);
            }
        } else {
            if ($this->session->userdata('guest_cart')) {
                $json = json_decode($this->session->userdata('guest_cart'), true);
            }
        }

        //Get product from cart
        if (count($json) > 0) {
            $products = array();
            $quantity = array();
            foreach ($json as $row) {

                $query = "SELECT p.*,pso.product_option_id,pso.value as option_name,psov.product_option_value_id,psov.price as price_option_value,psov.price_prefix as price_prefix_option_value,psov.weight as weight_option_value,psov.weight_prefix as weight_prefix_option_value,psov.value as option_detil_name, c.name as category_name, c.slug as category_slug , ps.price as special, ps.date_end FROM product p LEFT JOIN category c ON p.category_id = c.category_id LEFT JOIN product_special ps ON p.product_id = ps.product_id LEFT JOIN product_option pso ON p.product_id = pso.product_id LEFT JOIN product_option_value psov ON pso.product_option_id = psov.product_option_id WHERE p.product_id = " . $row['product_id'];
                $result_json = $this->Model_crud->select_query($query);

                if(!empty($result_json)){

                    foreach($result_json as $index => $value){

                        $products['data_single'][$value['product_id']] = array(
                            'product_id'    => $value['product_id'],
                            'type'          => $value['type'],
                            'item_id'       => $value['item_id'],
                            'content'       => $value['content'],
                            'weight'        => $value['weight'],
                            'size'          => $value['size'],
                            'shape'         => $value['shape'],
                            'clarity'       => $value['clarity'],
                            'treatment'     => $value['treatment'],
                            'origin'        => $value['origin'],
                            'price'         => $value['price'],
                            'quantity'      => $value['quantity'],
                            'name'          => $value['name'],
                            'description'   => $value['description'],
                            'image'         => $value['image'],
                            'stock'         => $value['stock'],
                            'slug'          => $value['slug'],
                            'category_id'   => $value['category_id'],
                            'featured'      => $value['featured'],
                            'sort_order'    => $value['sort_order'],
                            'status'        => $value['status'],
                            'date_added'    => $value['date_added'],
                            'date_modified' => $value['date_modified'],
                            'category_name' => $value['category_name'],
                            'category_slug' => $value['category_slug'],
                            'special'       => $value['special'],
                            'date_end'      => $value['date_end']
                            );

                        if(!empty($value['product_option_value_id'])){

                            if(!empty($customer)){

                                foreach($customer as $i => $v){

                                    if(!empty($v['cart'])){

                                        $cart = json_decode($v['cart']);

                                        if(is_array($cart[0]->option) && !empty($cart[0]->option)){

                                            $cart_value = $cart[0]->option;

                                            foreach($cart_value as $ci => $vi){

                                                if($value['product_option_value_id'] == $vi){

                                                 $products['data_option'][$value['product_option_value_id']] = array(
                                                    'product_id'                => $value['product_id'],
                                                    'product_option_id'         => $value['product_option_id'],
                                                    'product_option_value_id'   => $value['product_option_value_id'],
                                                    'option_name'               => $value['option_name'],
                                                    'option_detil_name'         => $value['option_detil_name'],
                                                    'price_option_value'        => $value['price_option_value'],
                                                    'price_prefix_option_value' => $value['price_prefix_option_value'],
                                                    'weight_option_value'       => $value['weight_option_value'],
                                                    'weight_prefix_option_value'=> $value['weight_prefix_option_value']
                                                    );

                                             }

                                         }

                                     }

                                 }

                             }

                         } else {

                            if(!empty($json)){
                                foreach($json as $index => $val){
                                    if(isset($val['option']) && is_array($val['option'])){
                                        foreach($val['option'] as $key => $row){
                                            if($value['product_option_value_id'] == $row){
                                                $products['data_option'][$value['product_option_value_id']] = array(
                                                    'product_id'                => $value['product_id'],
                                                    'product_option_id'         => $value['product_option_id'],
                                                    'product_option_value_id'   => $value['product_option_value_id'],
                                                    'option_name'               => $value['option_name'],
                                                    'option_detil_name'         => $value['option_detil_name'],
                                                    'price_option_value'        => $value['price_option_value'],
                                                    'price_prefix_option_value' => $value['price_prefix_option_value'],
                                                    'weight_option_value'       => $value['weight_option_value'],
                                                    'weight_prefix_option_value'=> $value['weight_prefix_option_value']
                                                    );
                                            }
                                        }
                                    }
                                }
                            }
                        }

                    }

                }

                if(is_array($products['data_single']) && !empty($products['data_single'])){
                    $products['data_single'] = array_values($products['data_single']);
                }

                if(isset($products['data_option']) && !empty($products['data_option'])){
                    $products['data_option'] = array_values($products['data_option']);
                }

            }

            $quantity[] = $row['quantity'];

        }
        $data['products'] = $products;
        $data['quantity'] = $quantity;
    } else {
        $data['products'] = FALSE;
        $data['quantity'] = FALSE;
    }
    /* Get Cart End */

        // Data Shipping
    $data['shipping'] = $this->Model_crud->select_where('setting', array('code'=>'shipping'));

    /* Payment Start */
        // Bank
    $data['bank'] = $this->Model_crud->select_where('setting', array('setting_id'=>1));

        // Paypal
    $data['paypal'] = $this->Model_crud->select_where('setting', array('setting_id'=>2));
    /* Payment End */

    $data['shipping_sess'] = '';

    if($this->session->userdata('value_shipping_country_id') != NULL){

        $data['shipping_sess'] =  $this->Model_crud->select_where('country',array('country_id' => $this->session->userdata('value_shipping_country_id')));

    }

    //Navigation
    $data['header'] = $this->Model_front->get_menu_header();
    $data['bottom'] = $this->Model_front->get_menu_bottom();

    //View

    $data['load_view'] = 'catalog/checkout/process';
    $this->load->view('template/frontend', $data);
}

public function save() {
    $firstname = $this->input->post('firstname',true);
    $lastname = $this->input->post('lastname',true);
    $email = $this->input->post('email',true);
    $telephone = $this->input->post('telephone',true);
    $fax = $this->input->post('fax',true);
    $company = $this->input->post('company',true);
    $address_1 = $this->input->post('address_1',true);
    $address_2 = $this->input->post('address_2',true);
    $city = $this->input->post('city',true);
    $postcode = $this->input->post('postcode',true);
    $country_id = $this->input->post('country_id',true);
    $zone_id = $this->input->post('zone_id',true);

    $shipping_method = $this->input->post('shipping_method',true);
    $shipping_comment = $this->input->post('shipping_comment',true);
    $shipping_country_id = $this->input->post('shipping_country_id',true);
    $payment_method = $this->input->post('payment_method',true);
    $payment_comment = $this->input->post('payment_comment',true);

    $agree = $this->input->post('agree',true);

    $datauser = array();
    $subtotal = 0;
    $total_option   = 0;
    $total_product  = 0;
    $total          = 0;

    //shipping price
    $shipping_amount = 0;
    $shipping_country_name = '';
    if(!empty($shipping_country_id)){
        $shipping_query = $this->Model_crud->select_where('country',array('country_id' => $shipping_country_id));
        if(!empty($shipping_query)){
            if(!empty($shipping_query[0]['shipping_price'])){
                $shipping_amount        = $shipping_query[0]['shipping_price'];
            }
            if(!empty($shipping_query[0]['name'])){
                $shipping_country_name  = $shipping_query[0]['name'];
            }
        }    
    }

    if ($this->session->userdata('uid')) {
        $customer = $this->Model_crud->select_where('customer', array('customer_id' => $this->session->userdata('uid')));
        
        if(!empty($customer)){

            $json = json_decode($customer[0]['cart'], true);

            
            if (count($json) > 0) {

                $total = 0;
                foreach($json as $row){

                   

                    $query_product = "SELECT p.*, c.name as category_name, c.slug as category_slug , ps.price as special, ps.date_end FROM product p LEFT JOIN category c ON p.category_id = c.category_id LEFT JOIN product_special ps ON p.product_id = ps.product_id WHERE p.product_id = " . $row['product_id'];

                    $product_info = $this->Model_crud->select_query($query_product);

                    if(!empty($product_info)){

                        foreach($product_info as $index => $value){

                            //$price = $value['price'];

                            if ($value['special']) {
                                $now = strtotime(date('Y-m-d'));
                                $date_end = strtotime($value['date_end']);
                                if ($date_end >= $now) {
                                    $price = $value['special'];
                                } else {
                                    $price = $value['price'];
                                }
                            } else {

                                $price = $value['price'];

                            }

                            $total_option = 0;

                            if(is_array($row['option']) && !empty($row['option'])){

                                foreach($row['option'] as $index => $value){
                                    $query_option = $this->Model_crud->select_where('product_option_value',array('product_option_value_id' => $value));

                                    if(!empty($query_option)){

                                        foreach($query_option as $key => $values){

                                            $total_option+=$values['price'];

                                        }

                                    }

                                }

                            } else {

                                $total_option = 0;
                            }

                        }

                    }

                    $subtotal = $price + $total_option;
                    $total+=$subtotal;

                }

            }

        }

    } else {
        if ($this->session->userdata('guest_cart')) {
            $json = json_decode($this->session->userdata('guest_cart'), true);

            if (count($json) > 0) {
                $total = 0;
                foreach($json as $row){

                    $query_product = "SELECT p.*, c.name as category_name, c.slug as category_slug , ps.price as special, ps.date_end FROM product p LEFT JOIN category c ON p.category_id = c.category_id LEFT JOIN product_special ps ON p.product_id = ps.product_id WHERE p.product_id = " . $row['product_id'];

                    $product_info = $this->Model_crud->select_query($query_product);

                    if(!empty($product_info)){

                        foreach($product_info as $index => $value){

                            //$price = $value['price'];

                            if ($value['special']) {
                                $now = strtotime(date('Y-m-d'));
                                $date_end = strtotime($value['date_end']);
                                if ($date_end >= $now) {
                                    $price = $value['special'];
                                } else {
                                    $price = $value['price'];
                                }
                            } else {

                                $price = $value['price'];

                            }

                            if(is_array($row['option']) && !empty($row['option'])){

                                foreach($row['option'] as $index => $value){
                                    $query_option = $this->Model_crud->select_where('product_option_value',array('product_option_value_id' => $value));

                                    if(!empty($query_option)){

                                        foreach($query_option as $key => $values){

                                            $total_option+=$values['price'];

                                        }

                                    }

                                }

                            } else {

                                $total_option = 0;
                            }

                        }

                    }

                    $subtotal = $price + $total_option;
                    $total+=$subtotal;

                }

            }
        }
    }

    $ip = $_SERVER['REMOTE_ADDR']? : ($_SERVER['HTTP_X_FORWARDED_FOR']? : $_SERVER['HTTP_CLIENT_IP']);

        //User Agent
    $this->load->library('user_agent');
    if ($this->agent->is_browser()) {
        $user_agent = $this->agent->browser() . ' ' . $this->agent->version();
    } elseif ($this->agent->is_robot()) {
        $user_agent = $this->agent->robot();
    } elseif ($this->agent->is_mobile()) {
        $user_agent = $this->agent->mobile();
    } else {
        $user_agent = 'Unidentified User Agent';
    }

    $accept_language = $this->agent->agent_string();
    $customer_id = ($this->session->userdata('uid')) ? $this->session->userdata('uid') : 0;

        //message
    $error = False;
    if ((strlen(trim($firstname)) < 1) || (strlen(trim($firstname)) > 32)) {
        $this->session->set_userdata('error_firstname', 'First Name must be between 1 and 32 characters!');
        $error = TRUE;
    }
    if ((strlen(trim($lastname)) < 1) || (strlen(trim($lastname)) > 32)) {
        $this->session->set_userdata('error_lastname', 'Last Name must be between 1 and 32 characters!');
        $error = TRUE;
    }
    if ((strlen($email) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
        $this->session->set_userdata('error_email', 'E-Mail Address does not appear to be valid!');
        $error = TRUE;
    }
    if ((strlen($telephone) < 3) || (strlen($telephone) > 32)) {
        $this->session->set_userdata('error_telephone', 'Telephone must be between 3 and 32 characters!');
        $error = TRUE;
    }
    if ((strlen(trim($address_1)) < 3) || (strlen(trim($address_1)) > 128)) {
        $this->session->set_userdata('error_address_1', 'Address 1 must be between 3 and 128 characters!');
        $error = TRUE;
    }
    if ((strlen(trim($city)) < 2) || (strlen(trim($city)) > 128)) {
        $this->session->set_userdata('error_city', 'City must be between 2 and 128 characters!');
        $error = TRUE;
    }
    if ((strlen(trim($postcode)) < 2 || strlen(trim($postcode)) > 10)) {
        $this->session->set_userdata('error_postcode', 'Postcode must be between 2 and 10 characters!');
        $error = TRUE;
    }
    if ($country_id == '') {
        $this->session->set_userdata('error_country_id', 'Please select a country!');
        $error = TRUE;
    }
    if ($zone_id == '') {
        $this->session->set_userdata('error_zone_id', 'Please select a region / state!');
        $error = TRUE;
    }
    if($agree == '') {
        $this->session->set_userdata('error_agree', 'Warning: You must agree to the Terms & Conditions!');
        $error = TRUE;
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
    $this->session->set_userdata('value_country_id', $country_id);
    $this->session->set_userdata('value_zone_id', $zone_id);
    $this->session->set_userdata('value_shipping_country_id', $shipping_country_id);
    $this->session->set_userdata('value_shipping_method', $shipping_method);
    $this->session->set_userdata('value_shipping_comment', $shipping_comment);
    $this->session->set_userdata('value_payment_method', $payment_method);
    $this->session->set_userdata('value_payment_comment', $payment_comment);

    if($error) {
        redirect('checkout/process');
    }

        //Insert Data Order
    $total_row = $this->Model_crud->total_row('order');
    $total_row += 1;
    $invoice = "INV-".date('Y')."-".$total_row;
    $order_status = ($payment_method == 'Paypal') ? 'Processing': 'Pending';

    if($payment_method == NULL){

        $payment_method = '';

    }

    $total_with_shipping = $total + $shipping_amount;

    $data_insert = array(
        "invoice" => $invoice,
        "customer_id" => $customer_id,
        "shipping_country_id" => $shipping_country_id,
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
        "shipping_method" => $shipping_method,
        "shipping_comment" => $shipping_comment,
        "payment_method" => $payment_method,
        "payment_comment" => $payment_comment,
        "total" => $total,
        "order_status" => $order_status,
        "ip" => $ip,
        "user_agent" =>$user_agent,
        "accept_language" => $accept_language,
        "date_added" => date('Y-m-d H:i:s'),
        "date_modified" => date('Y-m-d H:i:s')
        );

    $ex_ins = $this->Model_crud->insert('order', $data_insert);

    $order_id = $this->Model_crud->inserted_id();

    $this->session->set_userdata('value_order_id',$order_id);
    
        //Insert Data Order History
    $data_insert = array(
        "order_id" => $order_id,
        "order_status" => $order_status,
        "date_added" => date("c")
        );
    $ex_ins = $this->Model_crud->insert('order_history', $data_insert);
    //Insert Data Order Product

    /* Get Cart Start */
    $json = array();
    $json_product = array();

    if ($this->session->userdata('uid')) {
        $customer = $this->Model_crud->select_where('customer', array('customer_id' => $this->session->userdata('uid')));
        if ($customer[0]['cart']) {
            $json = json_decode($customer[0]['cart'], true);
        }
    } else {
        if ($this->session->userdata('guest_cart')) {
            $json = json_decode($this->session->userdata('guest_cart'), true);
        }
    }

        //Get product from cart
    $data_option = array();
    $data_email_option = array();
    if (count($json) > 0) {
        foreach ($json as $row) {
            $query = "SELECT p.*, c.name as category_name, c.slug as category_slug , ps.price as special, ps.date_end FROM product p LEFT JOIN category c ON p.category_id = c.category_id LEFT JOIN product_special ps ON p.product_id = ps.product_id WHERE p.product_id = " . $row['product_id'];
            $products = $this->Model_crud->select_query($query);

            if ($products[0]['special']) {
                $now = strtotime(date('Y-m-d'));
                $date_end = strtotime($products[0]['date_end']);
                if($date_end >= $now ) {
                    $flag_special = $products[0]['special'];
                } else {
                    $flag_special = FALSE;
                } 
            } else {
                $flag_special = FALSE;
            }

            $price = ($flag_special) ? $products[0]['special'] : $products[0]['price'];
            $data_insert = array(
                "order_id" => $order_id,
                "product_id" => $products[0]['product_id'],
                "name" => $products[0]['name'],
                "category" => $products[0]['category_name'],
                "quantity" => $row['quantity'],
                "price" => $price,
                "total" => $total
                );
            $ex_ins = $this->Model_crud->insert('order_product', $data_insert);

           

            if(is_array($row['option']) && !empty($row['option'])){
            //Insert Data Order Option

                foreach($row['option'] as $index => $value){

                    $query_option  = "SELECT pov.*, po.value as option_name FROM product_option_value pov JOIN product_option po ON pov.product_option_id = po.product_option_id WHERE pov.product_option_value_id =' " . $value."'";

                    $data_option = $this->Model_crud->select_query($query_option);

                    if(!empty($data_option)){

                        foreach($data_option as $k => $values){

                            $data_option = array(
                                "order_id" => $order_id,
                                "order_product_id" => $row['product_id'],
                                "product_option_id"=> $values['product_option_id'],
                                "product_option_value_id" => $values['product_option_value_id'],
                                "name" => $values['option_name'],
                                "value" => $values['value'],
                                "price" => $values['price']

                                );

                            $ex_ins = $this->Model_crud->insert('order_option', $data_option);

                            $data_email_option[] = array(
                                "order_id" => $order_id,
                                "order_product_id" => $row['product_id'],
                                "product_option_id"=> $values['product_option_id'],
                                "product_option_value_id" => $values['product_option_value_id'],
                                "name" => $values['option_name'],
                                "value" => $values['value'],
                                "price" => $values['price']

                                );

                        }

                    }

                }

            }

            $json_product[] = $data_insert;
                //Update Stock Quantity
            $data_update = array(
                "quantity" => $products[0]['quantity'] - $row['quantity']
                );
            $ex_update = $this->Model_crud->update('product', $data_update, array('product_id'=>$products[0]['product_id']));
        }
    }
    /* Get Cart End */

   /* echo '<pre>';
    print_r($data_insert);
    echo '</pre>';*/

        //Insert Data Order Total
    $data_insert = array(
        "order_id" => $order_id,
        "code" => 'total',
        "title" => 'Total',
        "value" => $total_with_shipping
        );

    /*echo '<pre>';
    print_r($data_option);
    echo '</pre>';

    echo '<pre>';
    print_r($data_insert);
    echo '</pre>';*/
    $ex_ins = $this->Model_crud->insert('order_total', $data_insert);

        //Send Email
    $title = 'Thank you for your order - Joscelyn Opal';
    $country_name = $this->Model_crud->select_where('country', array('country_id'=>$country_id));
    $zone_name = $this->Model_crud->select_where('zone', array('zone_id'=>$zone_id));

    $data_email = array(
        'order_id' => $order_id,
        'date_added' => date('c'),
        'payment_method' => $payment_method,
        'shipping_method' => $shipping_method,
        'telephone' => $telephone,
        'ip' => $ip,
        'order_status' => $order_status,
        'payment_comment' => $payment_comment,
        'shipping_comment' => $shipping_comment,
        'shipping_address' => $company.'<br>'.$address_1.'<br>'.$address_2.'<br>'.$city.' '.$postcode.'<br>'.$zone_name[0]['name'].'<br>'.$country_name[0]['name'],
        'total_amount' => $total_amount,
        'shipping_country_name' => $shipping_country_name,
        'shipping_price' => $shipping_amount,
        'total_amount' => $total_with_shipping
        );

    $this->_sendMail($email, $title, $data_email, $json_product, $total, $data_email_option);

        // Email to Merchant
    $store_mail = $this->Model_crud->select_where('setting', array('setting_id'=>19));
    $this->_sendMail($store_mail[0]['value'], $title, $data_email, $json_product, $total, $data_email_option);

        // Redirect if Payment is Paypal
    if($payment_method == 'Paypal') {

        redirect('checkout/paypal');

    } else {

        redirect('checkout/success');

    }


}

function _sendMail($seg1 = '', $seg2 = '', $seg3 = '', $seg4 = '', $seg5 = '',$seg6 = '') {
    $email = $seg1;
    $title = $seg2;
    $data_email = $seg3;
    $data_cart = $seg4;
    $total = $seg5;
    $option = $seg6;
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
    $data['text_greeting'] = 'Thank you for your interest in our products. Your order has been received and will be processed one payment has been confirmed.';
    $data['data_email'] = $data_email;
    $data['order_id'] = $data_email['order_id'];
    $data['option'] = $option;
    $data['shipping_country_name'] = $data_email['shipping_country_name'];
    $data['shipping_price'] = $data_email['shipping_price'];
    $data['date_added'] = date("d/m/Y", strtotime($data_email['date_added']));
    $data['payment_method'] = $data_email['payment_method'];
    $data['shipping_method'] = $data_email['shipping_method'];
    $data['email'] = $email;
    $data['telephone'] = $data_email['telephone'];
    $data['ip'] = $data_email['ip'];
    $data['order_status'] = $data_email['order_status'];

    $data['payment_comment'] = $data_email['payment_comment'];
    $data['shipping_comment'] = $data_email['shipping_comment'];

    $data['shipping_address'] = $data_email['shipping_address'];

    $data['products'] = $data_cart;
    $data['total'] = $total;
    $data['total_amount'] = $data_email['total_amount'];

    $message = $this->load->view('email/catalog_order',$data,TRUE);

        // To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
    $headers .= 'From: Joscelynopal <store@joscelynopal.com>' . "\r\n";

        // Mail it
    mail($to, $subject, $message, $headers);
}

}
