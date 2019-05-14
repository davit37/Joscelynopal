<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Cart extends CI_Controller {



    function __construct() {

        parent::__construct();



        //Load Model

        $this->load->model('Model_crud');

        $this->load->model('Model_front');

        //Data

        $this->data = array(

            'title' => 'Cart'

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



        //Get Cart if user logon



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



                $query = "SELECT p.*,pso.product_option_id,pso.value as option_name,psov.product_option_value_id,psov.price as price_option_value,psov.price_prefix as price_prefix_option_value,psov.weight as weight_option_value,psov.weight_prefix as weight_prefix_option_value,psov.value as option_detil_name, c.name as category_name, c.slug as category_slug , ps.price as special, ps.date_end FROM product p JOIN category c ON p.category_id = c.category_id LEFT JOIN product_special ps ON p.product_id = ps.product_id LEFT JOIN product_option pso ON p.product_id = pso.product_id LEFT JOIN product_option_value psov ON pso.product_option_id = psov.product_option_id WHERE p.product_id = " . $row['product_id'];

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



                if(is_array($products['data_option']) && !empty($products['data_option'])){

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



    //Navigation

    $data['header'] = $this->Model_front->get_menu_header();

    $data['bottom'] = $this->Model_front->get_menu_bottom();


 /*   echo '<pre>';
    print_r($products);
    echo '</pre>';*/

        //View

    $data['load_view'] = 'catalog/checkout/cart';

    $this->load->view('template/frontend', $data);

}



public function add($seg1 = '', $seg2 = '') {



    $json = array();

    $price              = 0;

    $total_option       = 0;

    $option     = $this->input->post('option');

    $product_id = $seg1;

    if (isset($product_id)) {

        $product_id = (int) $seg1;

    } else {

        $product_id = 0;

    }



    $query = "SELECT p.*, c.name as category_name, c.slug as category_slug , ps.price as special, ps.date_end FROM product p JOIN category c ON p.category_id = c.category_id LEFT JOIN product_special ps ON p.product_id = ps.product_id WHERE p.product_id = " . $product_id;



    $product_info = $this->Model_crud->select_query($query);



    if ($product_info) {



        $price = $product_info[0]['price'];



       /* if ($product_info[0]['special']) {

            $now = strtotime(date('Y-m-d'));

            $date_end = strtotime($product_info[0]['date_end']);

            if ($date_end >= $now) {

                $price = $product_info[0]['special'];

            } else {

                $price = $product_info[0]['price'];

            }

        }*/



        //$price    = $product_info[0]['price'];

        $quantity = 1;

        /*if (isset($quantity)) {

            $quantity = (int) $seg2;

        } else {

            $quantity = 1;

        }*/



            //Get Cart if user logon

        if ($this->session->userdata('uid')) {

            $customer = $this->Model_crud->select_where('customer', array('customer_id' => $this->session->userdata('uid')));



            if ($customer[0]['cart']) {

                $json = json_decode($customer[0]['cart'], true);

            }



            if(!empty($option)){



                foreach($option as $index => $value){



                    $option_query = $this->Model_crud->select_where('product_option_value',array('product_option_value_id' => $value));



                    if(!empty($option_query)){



                        foreach($option_query as $key => $row){



                            $total_option+=$row['price'];



                        }



                    }



                }



            }



        } else {

            if ($this->session->userdata('guest_cart')) {

                $json = json_decode($this->session->userdata('guest_cart'), true);

            } else {

                $this->session->set_userdata('guest_cart', json_encode($json));

            }

        }



            //Counter quantity for same product

        $i = 0;

        $flag = FALSE;

        foreach ($json as $row) {

            if ($row['product_id'] == $product_id) {

                $flag = TRUE;

                $index = $i;

            }

            $i++;

        }

        if ($flag) {

            $json[$index]['quantity'] += $quantity;

        } else {



            $total = $price + $total_option;



            $json[] = array(

                "product_id" => $product_id,

                "quantity" => $quantity,

                "option" => $this->input->post('option'),

                //"total" => number_format($total, 2, '.', '')

                );

        }



            //Update cart if user logon

        if ($this->session->userdata('uid')) {

            $data_update = array(

                "cart" => json_encode($json)

                );

            $this->Model_crud->update('customer', $data_update, array('customer_id' => $this->session->userdata('uid')));

        } else {

            $this->session->set_userdata('guest_cart', json_encode($json));

        }

        

    }



    header('Content-Type: application/json');

    echo json_encode($json);

}



public function edit() {

        //Get Cart if user logon

    $json = array();

    $new_json = array();

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



    if (count($json) > 0) {

            //Counter quantity for same product

        foreach ($json as $row) {

            $new_json[] = array(

                "product_id" => $row['product_id'],

                "quantity" => $this->input->post('qty' . $row['product_id'])

                );

        }



            //Update cart if user logon

        if ($this->session->userdata('uid')) {

            $data_update = array(

                "cart" => json_encode($new_json)

                );

            $this->Model_crud->update('customer', $data_update, array('customer_id' => $this->session->userdata('uid')));

        } else {

            $this->session->set_userdata('guest_cart', json_encode($new_json));

        }

    }

    redirect('checkout/cart');

}



public function remove($seg1 = '') {

    $product_id = $seg1;



    if (isset($product_id)) {

        $json = array();

        $new_json = array();



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



        if (count($json) > 0) {

                //Rebuilt Cart

            foreach ($json as $row) {

                if ($row['product_id'] != $product_id) {

                    $new_json[] = array(

                        "product_id" => $row['product_id'],

                        "quantity" => $row['quantity'],

                        "option" => $row['option'],

                        );

                }

            }



                //Update cart if user logon

            if ($this->session->userdata('uid')) {

                $data_update = array(

                    "cart" => json_encode($new_json)

                    );

                $this->Model_crud->update('customer', $data_update, array('customer_id' => $this->session->userdata('uid')));

            } else {

                $this->session->set_userdata('guest_cart', json_encode($new_json));

            }

        }

    }



    $data = array();

    $data['redirect'] = base_url('checkout/cart');

    header('Content-Type: application/json');

    echo json_encode($data);

}



}

