<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends CI_Controller {
    function __construct() {
        parent::__construct();

        // check if logged in
        if (!$this->session->has_userdata('logged_in')) {
            redirect('admin/login');
        }

        //load Model
        $this->load->model('Model_crud');

        //Data
        $this->data = array(
            'title' => 'Shipping'
            );
    }
    
    public function index() {
        // Data
        $data = $this->data;
        
        // Data Shipping
        $data['results'] = $this->Model_crud->select_where('setting', array('code'=>'shipping'));
        
        // View
        $data['load_view'] = 'admin/setting/shipping/shipping_list';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function add() {
        //Data
        $data = $this->data;

        $data['load_view'] = 'admin/setting/shipping/shipping_add';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function save() {
        $name = $this->input->post('name');

        if (empty($name)) {
            $this->session->set_userdata('name_error', 'Shipping Name is required!');
            redirect('admin/setting/shipping/add');
        }
        
        $data_insert = array(
            "code" => 'shipping',
            "title" => $name,
            "value" => '',
            "status" => 1
            );

        //notification
        $ex_ins = $this->Model_crud->insert('setting', $data_insert);
        if ($ex_ins) {
            $this->session->set_userdata('success', 'Success: You have modified shipping!');
        } else {
            $this->session->set_userdata('error', 'Error: Please try again!');
        }

        redirect('admin/setting/shipping');
    }
    
    public function edit($seg1 = '') {
        //Data
        $data = $this->data;
        
        $setting_id = $seg1;
        $data['result'] = $this->Model_crud->select_where('setting', array("setting_id" => $setting_id));

        $data['load_view'] = 'admin/setting/shipping/shipping_edit';
        $this->load->view('admin/template/backend', $data);
    }
    
    public function update() {
        //Data
        $data = $this->data;
        
        $setting_id = $this->input->post('setting_id');
        $name = $this->input->post('name');

        if (empty($name)) {
            $this->session->set_userdata('name_error', 'Shipping Name is required!');
            redirect('admin/setting/shipping/edit/'.$setting_id);
        }

        $data_update = array(
            "title" => $name
            );
        
        //notification
        $ex_upd = $this->Model_crud->update('setting', $data_update, array("setting_id" => $setting_id));
        if ($ex_upd) {
            $this->session->set_userdata('success', 'Success: You have modified shipping!');
        } else {
            $this->session->set_userdata('error', 'Error: Please try again!');
        }

        redirect('admin/setting/shipping');
    }
    
    public function delete() {
        //Data
        $data = $this->data;
        
        $checkbox = $this->input->post('selected');

        for ($i = 0; $i < count($checkbox); $i++) {
            $ex_del = $this->Model_crud->delete('setting', array("setting_id" => $checkbox[$i]));
        }

        //notification
        if ($ex_del) {
            $this->session->set_userdata('success', 'Success: You have modified shipping!');
        } else {
            $this->session->set_userdata('error', 'Error: Please try again!');
        }

        redirect('admin/setting/shipping');
    }

    public function shipping_price(){

        $this->form_validation->set_rules('price','trim');

        if($this->form_validation->run() == false){

            //Data
            $data = $this->data;

            //Get data
            $get_shipping_data          = $this->get_shipping_data();
            $data['countries']          = $get_shipping_data['countries'];
            $data['shipping_types']     = $get_shipping_data['shipping_types'];
            $data['shipping_prices']    = $get_shipping_data['shipping_prices'];

            // View
            $data['load_view'] = 'admin/setting/shipping/shipping_price';
            $this->load->view('admin/template/backend', $data);


        }else{
            $id    = $this->input->post('id');
            $price = $this->input->post('price');

            echo '<pre>';
            print_r($_POST);
            echo '</pre>';
            exit;

            foreach($id as $index => $value){
                if(empty($price[$index])){
                    $price[$index] = NULL;
                }

                $update = array(
                    'shipping_price' => $price[$index]
                );
                $this->Model_crud->update('country',$update,array('country_id' => $value));
            }

            $this->session->set_flashdata('success','Save success');
            redirect('admin/setting/shipping/shipping_price');
        }
    }


    public function update_single_shipping_price(){
        $result = array('status' => 400, 'message' => '', 'Error' => 'Invalid request');

        //Get post
        if($this->input->post()){
            $price          = $this->input->post('price', true);
            $shipping_id    = $this->input->post('shipping_id', true);
            $country_id     = $this->input->post('country_id', true);

            if(!is_numeric($price) || $price < 0){
                $price = 0;
            }

            if(!empty($shipping_id) && !empty($country_id)){
                $tmp_table      = 'country_shipping';
                $tmp_where      = 'setting_shipping_id = "'.$shipping_id.'" AND country_id = "'.$country_id.'"';
                $check          = $this->Model_crud->select_where($tmp_table, $tmp_where);
                $quer = $this->db->last_query();
                $array_query    = array('price' => $price);

                //Item found, update price
                if(!empty($check) && is_array($check) && $check > 0){
                    $execute = $this->Model_crud->update($tmp_table, $array_query, $tmp_where);
                    $action = 'update';

                //Item not found, insert data
                }else{
                    $action = 'insert';
                    $array_query['setting_shipping_id'] = $shipping_id;
                    $array_query['country_id']  = $country_id;
                    $execute                    = $this->Model_crud->insert($tmp_table, $array_query);
                }

                //Set result
                if($execute){
                    $result['status']   = 200;
                    $result['message']  = 'Data successfully updated';
                    $result['error']    = '';
                    $result['change_price'] = $price;
                    $result['action']       = $action;
                    $result['check']            = $check;
                    $result['check_query'] = $quer;
                }else{
                    $result['status']   = 500;
                    $result['error']    = $this->db->last_query();
                }

            }else{
                $result['status']   = 410;
                $result['error']    = 'Shipping ID and/or Country ID must be filled';
            }
        }

        echo json_encode($result);
    }


    /*
    Detail  : Add dynamic shipping and its prices
    Author  : Novrizal Zuhri (rizal@designcub3.com)
    */
    private function get_shipping_data(){
        //Data Shipping
        $get_countries = $this->Model_crud->select('country');


        //Declare empty variable to store data
        $countries = $shipping_types = $shipping_prices = array();


        //Save countries to an array
        if(!empty($get_countries) && is_array($get_countries) && count($get_countries) > 0){
            foreach($get_countries as $i => $v){
                $tmp_id = $v['country_id'];
                $countries[$tmp_id] = $v;
            }
        }


        //Set shipping types & prices
        $get_shipping_types = $this->Model_crud->select_where('setting', array('code'=>'shipping'));
        if(!empty($get_shipping_types) && is_array($get_shipping_types) && count($get_shipping_types) > 0){
            foreach($get_shipping_types as $i => $v){
                $tmp_id = $v['setting_id'];
                $shipping_types[$tmp_id] = $v;
            }

            //Set shipping prices
            if(!empty($shipping_types)){
                $get_shipping_prices = $this->Model_crud->select('country_shipping');
                if(!empty($get_shipping_prices) && is_array($get_shipping_prices) && count($get_shipping_prices) > 0){
                    foreach($get_shipping_prices as $i => $v){
                        $tmp_country_id     = $v['country_id'];
                        $tmp_shipping_id    = $v['setting_shipping_id'];
                        $tmp_price          = $v['price'];

                        //Avoid ghost data : undeclared shipping type
                        if(empty($shipping_types[$tmp_shipping_id])){
                            continue;
                        }

                        //Insert shipping to array
                        $shipping_prices[$tmp_shipping_id][$tmp_country_id] = $tmp_price;
                    }
                }
            }
        }


        //Return data
        $data = array(
            'countries'         => $countries,
            'shipping_types'    => $shipping_types,
            'shipping_prices'   => $shipping_prices,
        );
        return $data;
    }
}