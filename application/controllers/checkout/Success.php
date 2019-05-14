<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Success extends CI_Controller {

    function __construct() {

        parent::__construct();



        //Load Model

        $this->load->model('Model_front');

        $this->load->model('Model_crud');



        //Data

        $this->data = array(

            'title' => 'Success'

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

    }

    

    public function index() {

        //Data

        $data = $this->data;
        $status_paypal = $this->input->post('payment_status',true);

        if(isset($status_paypal) && $status_paypal == 'Completed'){

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
        //Unset User Data

        /*$this->session->unset_userdata('value_firstname');

        $this->session->unset_userdata('value_lastname');

        $this->session->unset_userdata('value_email');

        $this->session->unset_userdata('value_telephone');

        $this->session->unset_userdata('value_fax');

        $this->session->unset_userdata('value_company');

        $this->session->unset_userdata('value_address_1');

        $this->session->unset_userdata('value_address_2');

        $this->session->unset_userdata('value_city');

        $this->session->unset_userdata('value_postcode');

        $this->session->unset_userdata('value_country_id');

        $this->session->unset_userdata('value_zone_id');

        $this->session->unset_userdata('value_shipping_country_id');

        $this->session->unset_userdata('value_shipping_method');

        $this->session->unset_userdata('value_shipping_comment');

        $this->session->unset_userdata('value_payment_method');

        $this->session->unset_userdata('value_payment_comment');*/

        //Category
        $data['category'] = $this->Model_crud->select_where_order('category', array("status" => 1), 'sort_order', 'asc');

        //Navigation

        $data['header'] = $this->Model_front->get_menu_header();

        $data['bottom'] = $this->Model_front->get_menu_bottom();

        //View

        $data['load_view'] = 'catalog/checkout/success';

        $this->load->view('template/frontend', $data);

    }



    public function tokenkeycomplete() {



        $chars = array(

            'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',

            'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',

            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',

            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',

            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');



        shuffle($chars);



        $num_chars = count($chars) - 1;

        $token = '';



    for ($i = 0; $i < $num_chars; $i++){ // <-- $num_chars instead of $len

        $token .= $chars[mt_rand(0, $num_chars)];

    }



    return $token;

}

}



?>