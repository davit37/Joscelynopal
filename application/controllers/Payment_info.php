<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_info extends CI_Controller {

    function __construct() {
        parent::__construct();

        //Load Model
        $this->load->model('Model_crud');

        //Data
        $this->data = array(
            'title' => 'Payment Info'
        );
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

        //Data Term
        $data['page'] = $this->Model_crud->select_where('page', array('slug' => 'payment-info'));

        //View
        $data['load_view'] = 'page_single';
        $this->load->view('template/frontend', $data);
    }

}
