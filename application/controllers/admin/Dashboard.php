<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();

        // check if logged in
        if (!$this->session->has_userdata('logged_in')) {
            redirect('admin/login');
        }

        //Data
        $this->data = array(
            'title' => 'Dashboard'
        );
    }

    public function index() {
        //Data
        $data = $this->data;

        $this->load->model('Model_crud');

        //Data Total Order
        $data['total_order'] = $this->Model_crud->total_row('order');

        //Data Total Sale
        $q_sale = "SELECT SUM(value) as total_sale FROM order_total WHERE code = 'total'";
        $sale_total = $this->Model_crud->select_query($q_sale);

        if ($sale_total[0]['total_sale'] > 1000000000000) {
            $data['total'] = round($sale_total[0]['total_sale'] / 1000000000000, 1) . 'T';
        } elseif ($sale_total[0]['total_sale'] > 1000000000) {
            $data['total'] = round($sale_total[0]['total_sale'] / 1000000000, 1) . 'B';
        } elseif ($sale_total[0]['total_sale'] > 1000000) {
            $data['total'] = round($sale_total[0]['total_sale'] / 1000000, 1) . 'M';
        } elseif ($sale_total[0]['total_sale'] > 1000) {
            $data['total'] = round($sale_total[0]['total_sale'] / 1000, 1) . 'K';
        } else {
            $data['total'] = round($sale_total[0]['total_sale']);
        }

        //Data Total Customer
        $data['total_customer'] = $this->Model_crud->total_row('customer');
        
        //Data Recent Order
        $q_recent = "SELECT * FROM `order` ORDER BY `order_id` DESC LIMIT 5";
        $data['recent_orders'] = $this->Model_crud->select_query($q_recent);

        //View
        $data['load_view'] = 'admin/page_dashboard';
        $this->load->view('admin/template/backend', $data);
    }

    public function chart($seg1 = '') {
        
        $this->load->model('Model_chart');

        $json = array();

        $json['order'] = array();
        $json['customer'] = array();
        $json['xaxis'] = array();

        $json['order']['data'] = array();
        $json['customer']['data'] = array();

        if (isset($seg1)) {
            $range = $seg1;
        } else {
            $range = 'day';
        }

        switch ($range) {
            default:
            case 'day':
                $results = $this->Model_chart->getTotalOrdersByDay();

                foreach ($results as $key => $value) {
                    $json['order']['data'][] = array($key, $value['total']);
                }

                $results = $this->Model_chart->getTotalCustomersByDay();

                foreach ($results as $key => $value) {
                    $json['customer']['data'][] = array($key, $value['total']);
                }

                for ($i = 0; $i < 24; $i++) {
                    $json['xaxis'][] = array($i, $i);
                }
                break;
            case 'week':
                $results = $this->Model_chart->getTotalOrdersByWeek();

                foreach ($results as $key => $value) {
                    $json['order']['data'][] = array($key, $value['total']);
                }

                $results = $this->Model_chart->getTotalCustomersByWeek();

                foreach ($results as $key => $value) {
                    $json['customer']['data'][] = array($key, $value['total']);
                }

                $date_start = strtotime('-' . date('w') . ' days');

                for ($i = 0; $i < 7; $i++) {
                    $date = date('Y-m-d', $date_start + ($i * 86400));

                    $json['xaxis'][] = array(date('w', strtotime($date)), date('D', strtotime($date)));
                }
                break;
            case 'month':
                $results = $this->Model_chart->getTotalOrdersByMonth();

                foreach ($results as $key => $value) {
                    $json['order']['data'][] = array($key, $value['total']);
                }

                $results = $this->Model_chart->getTotalCustomersByMonth();

                foreach ($results as $key => $value) {
                    $json['customer']['data'][] = array($key, $value['total']);
                }

                for ($i = 1; $i <= date('t'); $i++) {
                    $date = date('Y') . '-' . date('m') . '-' . $i;

                    $json['xaxis'][] = array(date('j', strtotime($date)), date('d', strtotime($date)));
                }
                break;
            case 'year':
                $results = $this->Model_chart->getTotalOrdersByYear();

                foreach ($results as $key => $value) {
                    $json['order']['data'][] = array($key, $value['total']);
                }

                $results = $this->Model_chart->getTotalCustomersByYear();

                foreach ($results as $key => $value) {
                    $json['customer']['data'][] = array($key, $value['total']);
                }

                for ($i = 1; $i <= 12; $i++) {
                    $json['xaxis'][] = array($i, date('M', mktime(0, 0, 0, $i)));
                }
                break;
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }

}
