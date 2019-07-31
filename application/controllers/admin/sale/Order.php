<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        // check if logged in
        if (!$this
            ->session
            ->has_userdata('logged_in'))
        {
            redirect('admin/login');
        }

        //load Model
        $this
            ->load
            ->model('Model_crud');
        $this
            ->load
            ->model('Model_backend');
        $this
            ->load
            ->library('pagination');

        $this->load->library('email');
        
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.app-show.net';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = "herman@app-show.net";
        $config['smtp_pass'] = "D9w3iuKa02";
        $config['smtp_crypto'] ="ssl";
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);


        //Data
        $this->data = array(
            'title' => 'Orders'
        );

    }

    public function index()
    {
        //Data
        $data = $this->data;

        $config["base_url"] = base_url('admin/sale/order/page');
        $config["per_page"] = 10;
        $config["uri_segment"] = 5;
        $config['use_page_numbers'] = true;

        //customize
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

        $page = ($this
            ->uri
            ->segment(5)) ? $this
            ->uri
            ->segment(5) : 1;
        $query = "SELECT * FROM `order` ORDER BY `order_id` DESC LIMIT " . (($page - 1) * $config['per_page']) . ", " . $config["per_page"];

        $data['results'] = $this
            ->Model_crud
            ->select_query($query);
        $data['results_total'] = array();

        if (!empty($data['results']))
        {

            foreach ($data['results'] as $index => $value)
            {
                $query_total = $this
                    ->Model_crud
                    ->select_where('country', array(
                    'country_id' => $value['shipping_country_id']
                ));
                if (!empty($query_total))
                {
                    foreach ($query_total as $key => $row)
                    {
                        if ($value['shipping_country_id'] == $row['country_id'])
                        {
                            $shipping_price = $row['shipping_price'];
                        }
                        else
                        {
                            $shipping_price = 0;
                        }

                        $data['results_total'][] = array(
                            'order_id' => $value['order_id'],
                            'shipping_price' => $shipping_price
                        );
                    }
                }
            }
        }

        $config["total_rows"] = $this
            ->Model_crud
            ->total_row('order');
        $this
            ->pagination
            ->initialize($config);

        $data['url_order_id'] = base_url('admin/sale/order/sort/order_id/asc/' . $page);
        $data['url_customer'] = base_url('admin/sale/order/sort/customer/asc/' . $page);
        $data['url_order_status'] = base_url('admin/sale/order/sort/order_status/asc/' . $page);
        $data['url_total'] = base_url('admin/sale/order/sort/total/asc/' . $page);
        $data['url_date_added'] = base_url('admin/sale/order/sort/date_added/asc/' . $page);
        $data['url_date_modified'] = base_url('admin/sale/order/sort/date_modified/asc/' . $page);
        $data['class_order_id'] = '';
        $data['class_customer'] = '';
        $data['class_order_status'] = '';
        $data['class_total'] = '';
        $data['class_date_added'] = '';
        $data['class_date_modified'] = '';
        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;
        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);
        $data['total_result'] = $config["total_rows"];
        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);
        $data["links"] = $this
            ->pagination
            ->create_links();

        $data['load_view'] = 'admin/sale/order/order_list';
        $this
            ->load
            ->view('admin/template/backend', $data);
    }

    public function page()
    {
        //Data
        $data = $this->data;

        $config["base_url"] = base_url('admin/sale/order/page');
        $config["per_page"] = 10;
        $config["uri_segment"] = 5;
        $config['use_page_numbers'] = true;

        //customize
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

        $page = ($this
            ->uri
            ->segment(5)) ? $this
            ->uri
            ->segment(5) : 1;
        $query = "SELECT * FROM `order` LIMIT " . (($page - 1) * $config['per_page']) . ", " . $config["per_page"];
        $data['results'] = $this
            ->Model_crud
            ->select_query($query);
        $config["total_rows"] = $this
            ->Model_crud
            ->total_row('order');
        $this
            ->pagination
            ->initialize($config);

        $data['url_order_id'] = base_url('admin/sale/order/sort/order_id/asc/' . $page);
        $data['url_customer'] = base_url('admin/sale/order/sort/customer/asc/' . $page);
        $data['url_order_status'] = base_url('admin/sale/order/sort/order_status/asc/' . $page);
        $data['url_total'] = base_url('admin/sale/order/sort/total/asc/' . $page);
        $data['url_date_added'] = base_url('admin/sale/order/sort/date_added/asc/' . $page);
        $data['url_date_modified'] = base_url('admin/sale/order/sort/date_modified/asc/' . $page);
        $data['class_order_id'] = '';
        $data['class_customer'] = '';
        $data['class_order_status'] = '';
        $data['class_total'] = '';
        $data['class_date_added'] = '';
        $data['class_date_modified'] = '';
        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;
        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);
        $data['total_result'] = $config["total_rows"];
        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);
        $data["links"] = $this
            ->pagination
            ->create_links();

        $data['load_view'] = 'admin/sale/order/order_list';
        $this
            ->load
            ->view('admin/template/backend', $data);
    }

    public function sort($seg1 = '', $seg2 = '')
    {
        //Data
        $data = $this->data;

        $sort_by = $seg2;

        switch ($seg1)
        {
            case 'order_id':
                $sort = 'order_id';
            break;
            case 'customer':
                $sort = "CONCAT(firstname, ' ', lastname)";
            break;
            case 'order_status':
                $sort = 'order_status';
            break;
            case 'total':
                $sort = 'total';
            break;
            case 'date_added':
                $sort = 'date_added';
            break;
            case 'date_modified':
                $sort = 'date_modified';
            break;
            default:
                $sort = 'order_id';
        }

        if (empty($sort_by))
        {
            $sort_by = 'asc';
        }

        $config["base_url"] = base_url('admin/sale/order/sort/' . $seg1 . '/' . $sort_by);
        $query_total_row = "SELECT * FROM `order` ORDER BY $sort $sort_by";
        $config["total_rows"] = $this
            ->Model_crud
            ->total_row_query($query_total_row);
        $config["per_page"] = 10;
        $config["uri_segment"] = 7;
        $config['use_page_numbers'] = true;

        //customize
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

        $page = ($this
            ->uri
            ->segment(7)) ? $this
            ->uri
            ->segment(7) : 1;
        $query = "select * from `order` ORDER BY $sort $sort_by LIMIT " . (($page - 1) * $config['per_page']) . ", " . $config["per_page"];
        $data['results'] = $this
            ->Model_crud
            ->select_query($query);
        $this
            ->pagination
            ->initialize($config);

        if ($sort_by == 'asc')
        {
            $reverse_sort = 'desc';
        }
        else
        {
            $reverse_sort = 'asc';
        }

        $data['url_order_id'] = base_url('admin/sale/order/sort/order_id/asc/' . $page);
        $data['url_customer'] = base_url('admin/sale/order/sort/customer/asc/' . $page);
        $data['url_order_status'] = base_url('admin/sale/order/sort/order_status/asc/' . $page);
        $data['url_total'] = base_url('admin/sale/order/sort/total/asc/' . $page);
        $data['url_date_added'] = base_url('admin/sale/order/sort/date_added/asc/' . $page);
        $data['url_date_modified'] = base_url('admin/sale/order/sort/date_modified/asc/' . $page);
        $data['class_order_id'] = '';
        $data['class_customer'] = '';
        $data['class_order_status'] = '';
        $data['class_total'] = '';
        $data['class_date_added'] = '';
        $data['class_date_modified'] = '';

        switch ($seg1)
        {
            case 'order_id':
                $data['url_order_id'] = base_url('admin/sale/order/sort/order_id/' . $reverse_sort . '/' . $page);
                $data['class_order_id'] = $sort_by;
            break;
            case 'customer':
                $data['url_customer'] = base_url('admin/sale/order/sort/customer/' . $reverse_sort . '/' . $page);
                $data['class_customer'] = $sort_by;
            break;
            case 'order_status':
                $data['url_order_status'] = base_url('admin/sale/order/sort/order_status/' . $reverse_sort . '/' . $page);
                $data['class_order_status'] = $sort_by;
            break;
            case 'total':
                $data['url_total'] = base_url('admin/sale/order/sort/total/' . $reverse_sort . '/' . $page);
                $data['class_total'] = $sort_by;
            break;
            case 'date_added':
                $data['url_date_added'] = base_url('admin/sale/order/sort/date_added/' . $reverse_sort . '/' . $page);
                $data['class_date_added'] = $sort_by;
            break;
            case 'date_modified':
                $data['url_date_modified'] = base_url('admin/sale/order/sort/date_modified/' . $reverse_sort . '/' . $page);
                $data['class_date_modified'] = $sort_by;
            break;
        }

        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;
        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);
        $data['total_result'] = $config["total_rows"];
        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);
        $data["links"] = $this
            ->pagination
            ->create_links();

        $data['load_view'] = 'admin/sale/order/order_list';
        $this
            ->load
            ->view('admin/template/backend', $data);
    }

    public function autocomplete($seg1 = '', $seg2 = '')
    {
        $json = array();
        $limit = 15;

        switch ($seg1)
        {
            case 'customer':
                $like = "CONCAT(firstname, ' ', lastname)";
                $like_by = $seg2;
                $results = $this
                    ->Model_crud
                    ->select_like_limit('order', array(
                    "$like" => $like_by
                ) , $limit);

                foreach ($results as $result)
                {
                    $json[] = array(
                        'order_id' => $result['order_id'],
                        'name' => $result['firstname'] . ' ' . $result['lastname']
                    );
                }
            break;

            case 'product':
                $like = "name";
                $like_by = $seg2;
                $results = $this
                    ->Model_crud
                    ->select_like_limit('product', array(
                    "$like" => $like_by
                ) , $limit);

                foreach ($results as $result)
                {
                    $json[] = array(
                        'product_id' => $result['product_id'],
                        'name' => $result['name']
                    );
                }
            break;

        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function filter($seg1 = '', $seg2 = '')
    {
        //Data
        $data = $this->data;

        $order_id = $this
            ->input
            ->post('filter_order_id');
        $customer = $this
            ->input
            ->post('filter_customer');
        $order_status = $this
            ->input
            ->post('filter_order_status');
        $total = $this
            ->input
            ->post('filter_total');
        $date_added = $this
            ->input
            ->post('filter_date_added');
        $date_modified = $this
            ->input
            ->post('filter_date_modified');
        $query_where = array();
        if ($order_id != '')
        {
            $query_where[] = "order_id = '$order_id'";
        }
        if ($customer != '')
        {
            $query_where[] = "CONCAT(firstname, ' ', lastname) LIKE '%$customer%'";
        }
        if ($order_status != '')
        {
            $query_where[] = "order_status LIKE '%$order_status%'";
        }
        if ($total != '')
        {
            $query_where[] = "total LIKE '%$total%'";
        }
        if ($date_added != '')
        {
            $date_added_min = $date_added . " 00:00:00";
            $date_added_max = $date_added . " 23:59:59";
            $query_where[] = "date_added >= '$date_added_min' AND date_added <= '$date_added_max'";
        }
        if ($date_modified != '')
        {
            $date_modified_min = $date_modified . " 00:00:00";
            $date_modified_max = $date_modified . " 23:59:59";
            $query_where[] = "date_modified >= '$date_modified_min' AND date_modified <= '$date_modified_max'";
        }
        if (count($query_where) > 0)
        {
            $this
                ->session
                ->set_userdata('query_where', $query_where);
        }

        $query = "select * from `order`";
        if ($this
            ->session
            ->userdata('query_where'))
        {
            for ($i = 0;$i < count($this
                ->session
                ->userdata('query_where'));$i++)
            {
                if ($i == 0)
                {
                    $query .= " WHERE " . $this
                        ->session
                        ->userdata['query_where'][$i];
                }
                else
                {
                    $query .= " AND " . $this
                        ->session
                        ->userdata['query_where'][$i];
                }
            }
        }

        //Sort
        $sort_by = $seg2;

        switch ($seg1)
        {
            case 'order_id':
                $sort = 'order_id';
                $sort_seg1 = 'order_id';
            break;
            case 'customer':
                $sort = "CONCAT(firstname, ' ', lastname)";
                $sort_seg1 = 'customer';
            break;
            case 'order_status':
                $sort = 'order_status';
                $sort_seg1 = 'order_status';
            break;
            case 'total':
                $sort = 'total';
                $sort_seg1 = 'total';
            break;
            case 'date_added':
                $sort = 'date_added';
                $sort_seg1 = 'date_added';
            break;
            case 'date_modified':
                $sort = 'date_modified';
                $sort_seg1 = 'date_modified';
            break;
            default:
                $sort = 'order_id';
                $sort_seg1 = 'order_id';
        }
        if (empty($sort_by))
        {
            $sort_by = 'asc';
        }

        $config["base_url"] = base_url('admin/sale/order/filter/' . $sort_seg1 . '/' . $sort_by);
        $config["total_rows"] = $this
            ->Model_crud
            ->total_row_query($query);
        $config["per_page"] = 10;
        $config["uri_segment"] = 7;
        $config['use_page_numbers'] = true;

        //customize
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

        $page = ($this
            ->uri
            ->segment(7)) ? $this
            ->uri
            ->segment(7) : 1;
        $query .= " ORDER BY $sort $sort_by LIMIT " . (($page - 1) * $config['per_page']) . ", " . $config["per_page"];
        $data['results'] = $this
            ->Model_crud
            ->select_query($query);
        $this
            ->pagination
            ->initialize($config);

        if ($sort_by == 'asc')
        {
            $reverse_sort = 'desc';
        }
        else
        {
            $reverse_sort = 'asc';
        }

        $data['url_order_id'] = base_url('admin/sale/order/filter/order_id/asc/' . $page);
        $data['url_customer'] = base_url('admin/sale/order/filter/customer/asc/' . $page);
        $data['url_order_status'] = base_url('admin/sale/order/filter/order_status/asc/' . $page);
        $data['url_total'] = base_url('admin/sale/order/filter/total/asc/' . $page);
        $data['url_date_added'] = base_url('admin/sale/order/filter/date_added/asc/' . $page);
        $data['url_date_modified'] = base_url('admin/sale/order/filter/date_modified/asc/' . $page);
        $data['class_order_id'] = '';
        $data['class_customer'] = '';
        $data['class_order_status'] = '';
        $data['class_total'] = '';
        $data['class_date_added'] = '';
        $data['class_date_modified'] = '';

        switch ($seg1)
        {
            case 'order_id':
                $data['url_order_id'] = base_url('admin/sale/order/filter/order_id/' . $reverse_sort . '/' . $page);
                $data['class_order_id'] = $sort_by;
            break;
            case 'customer':
                $data['url_customer'] = base_url('admin/sale/order/filter/customer/' . $reverse_sort . '/' . $page);
                $data['class_customer'] = $sort_by;
            break;
            case 'order_status':
                $data['url_order_status'] = base_url('admin/sale/order/filter/order_status/' . $reverse_sort . '/' . $page);
                $data['class_order_status'] = $sort_by;
            break;
            case 'total':
                $data['url_total'] = base_url('admin/sale/order/filter/total/' . $reverse_sort . '/' . $page);
                $data['class_total'] = $sort_by;
            break;
            case 'date_added':
                $data['url_date_added'] = base_url('admin/sale/order/sort/date_added/' . $reverse_sort . '/' . $page);
                $data['class_date_added'] = $sort_by;
            break;
            case 'date_modified':
                $data['url_modified'] = base_url('admin/sale/order/sort/date_modified/' . $reverse_sort . '/' . $page);
                $data['class_modified'] = $sort_by;
            break;
        }

        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;
        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);
        $data['total_result'] = $config["total_rows"];
        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);
        $data["links"] = $this
            ->pagination
            ->create_links();

        $data['load_view'] = 'admin/sale/order/order_list';
        $this
            ->load
            ->view('admin/template/backend', $data);
    }

    public function add()
    {
        //Data
        $data = $this->data;

        $this
            ->session
            ->unset_userdata('admin_cart');

        //Country
        $data['countries'] = $this
            ->Model_crud
            ->select('country');

        // Data Shipping
        $data['shipping'] = $this
            ->Model_crud
            ->select_where('setting', array(
            'code' => 'shipping'
        ));

        /* Payment Start */
        // Bank
        $data['bank'] = $this
            ->Model_crud
            ->select_where('setting', array(
            'setting_id' => 1
        ));

        // Paypal
        $data['paypal'] = $this
            ->Model_crud
            ->select_where('setting', array(
            'setting_id' => 2
        ));
        /* Payment End */

        //View
        $data['load_view'] = 'admin/sale/order/order_add';
        $this
            ->load
            ->view('admin/template/backend', $data);
    }

    public function customer_autocomplete($seg1 = '', $seg2 = '')
    {
        $json = array();
        $limit = 5;
        $like = "CONCAT(firstname, ' ', lastname)";
        $like_by = $seg2;

        switch ($seg1)
        {
            case 'customer':
                $results = $this
                    ->Model_crud
                    ->select_like_limit('customer', array(
                    "$like" => $like_by
                ) , $limit);

                foreach ($results as $result)
                {
                    $json[] = array(
                        'customer_id' => $result['customer_id'],
                        'name' => $result['firstname'] . ' ' . $result['lastname'],
                        'firstname' => $result['firstname'],
                        'lastname' => $result['lastname'],
                        'email' => $result['email'],
                        'telephone' => $result['telephone'],
                        'fax' => $result['fax'],
                        'company' => $result['company'],
                        'address_1' => $result['address_1'],
                        'address_2' => $result['address_2'],
                        'city' => $result['city'],
                        'postcode' => $result['postcode'],
                        'country_id' => $result['country_id'],
                        'zone_id' => $result['zone_id'],
                        'zones' => $this
                            ->Model_crud
                            ->select_where('zone', array(
                            'country_id' => $result['country_id']
                        ))
                    );
                }
            break;

        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function country($seg1 = '')
    {
        $json = array();
        $county_id = $seg1;

        $results = $this
            ->Model_crud
            ->select_where('zone', array(
            "country_id" => $county_id
        ));

        foreach ($results as $result)
        {
            $json[] = array(
                'zone_id' => $result['zone_id'],
                'name' => $result['name']
            );
        }

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    public function product_add($seg1 = '')
    {
        $json = array();

        $product_id = $seg1;
        if (isset($product_id))
        {
            $product_id = (int)$seg1;
        }
        else
        {
            $product_id = 0;
        }

        $message = '';
        $flag = false;
        $data_template = '';

        $product_info = $this
            ->Model_crud
            ->select_where('product', array(
            'product_id' => $product_id
        ));
        if ($product_info)
        {
            /*$quantity = $seg2;
            if (isset($quantity)) {
                $quantity = (int) $seg2;
            } else {
                $quantity = 1;
            }*/

            //Get Cart
            if ($this
                ->session
                ->userdata('admin_cart'))
            {
                $json = json_decode($this
                    ->session
                    ->userdata('admin_cart') , true);
            }
            else
            {
                $this
                    ->session
                    ->set_userdata('admin_cart', json_encode($json));
            }

            //Counter quantity for same product
            $i = 0;
            $flag = false;
            $order_option = array();
            foreach ($json as $row)
            {
                if ($row['product_id'] == $product_id)
                {
                    $flag = true;
                    $index = $i;
                }

                if (isset($row['order_option']))
                {
                    $order_option[$i] = $row['order_option'];
                }

                $i++;

                $category = $this
                    ->Model_crud
                    ->select_where('category', array(
                    'category_id' => $product_info[0]['category_id']
                ));
                $special_price = $this
                    ->Model_crud
                    ->select_where('product_special', array(
                    'product_id' => $product_id
                ));
                $query_option = $this
                    ->Model_backend
                    ->get_option_and_value_by_id($product_id);
                if ($special_price)
                {
                    $now = strtotime(date('Y-m-d'));
                    $date_end = strtotime($special_price[0]['date_end']);
                    if ($date_end >= $now)
                    {
                        $flag_special = $special_price;
                    }
                    else
                    {
                        $flag_special = false;
                    }
                }
                else
                {
                    $flag_special = false;
                }
                if ($flag_special)
                {
                    $special_price = $special_price[0]['price'];
                }
                else
                {
                    $special_price = false;
                }

            }
            /*if ($flag) {
                $json[$index]['quantity'] += $quantity;
            } else {*/

            $json[] = array(
                "product_id" => $product_id,
                //"quantity" => $quantity,
                "product_name" => $product_info[0]['name'],
                "category_name" => $category[0]['name'],
                "special_price" => $special_price,
                "price" => $product_info[0]['price']
            );

            if (isset($order_option) && !empty($order_option))
            {
                foreach ($order_option as $index => $value)
                {
                    $json[$index]['order_option'] = $value;
                }
            }

            foreach ($json as $index => $value)
            {

                $data_template = '<tr value="' . $value['product_id'] . '">';
                $data_template .= '<td class="text-left">';
                $data_template .= '<p style="margin-bottom: 5px;">' . $value['product_name'] . '</p>';

                if (isset($query_option) && !empty($query_option))
                {
                    $data_template .= '<table class="table table-bordered">';
                    $data_template .= '<thead>';
                    $data_template .= '<tr>';
                    $data_template .= '<td class="text-left">Option Name</td>';
                    $data_template .= '<td class="text-left">Value</td>';
                    $data_template .= '<td class="text-right"></td>';
                    $data_template .= '</tr>';
                    $data_template .= '</thead>';
                    $data_template .= '<tbody>';

                    foreach ($query_option as $k => $v)
                    {
                        $data_template .= '<tr>';
                        $data_template .= '<td class="text-left"><p style="margin-bottom: 5px;">' . $v['name'] . '</p></td>';
                        $data_template .= '<td class="text-right">';
                        if (!empty($query_option_value))
                        {
                            $data_template .= '<select class="product-option-value form-control" name="product_option_value">';

                            foreach ($query_option_value as $key => $row)
                            {
                                $selected = '';
                                if ($v['product_option_id'] == $row['product_option_id'])
                                {
                                    $selected = 'selected';
                                    $data_template .= '<option ' . $selected . ' value="' . $row['product_option_value_id'] . '" data-product="' . $value['product_id'] . '" data-product-option="' . $row['product_option_id'] . '">' . ucfirst($row['value']) . ' - $' . number_format($v['price'], 2, '.', '') . '</option>';
                                }
                            }
                            $data_template .= '</select>';
                        }
                        $data_template .= '</td>';
                        $data_template .= '<td class="text-center" style="width: 3px;">';
                        $data_template .= '<button data-original-title="Remove" type="button" data-toggle="tooltip" title="" data-loading-text="Loading..." class="btn btn-danger btn-remove-option"><i class="fa fa-minus-circle"></i></button>';
                        $data_template .= '</td>';
                        $data_template .= '</tr>';
                    }
                    $data_template .= '</tbody>';

                    if (isset($query_option) && !empty($query_option))
                    {
                        $data_template .= '<tfoot>';
                        $data_template .= '<tr>';
                        $data_template .= '<td colspan="4">';
                        $data_template .= '<form></form>';
                        $data_template .= '<form class="choose-option form-horizontal">';
                        $data_template .= '<label>Choose Option</label>';
                        $data_template .= '<select name="product_option" class="input-option form-control select-option">';

                        $temp_product_option_id = array();
                        foreach ($query_option as $i => $v)
                        {
                            if ($i == 0)
                            {
                                $temp_product_option_id[] = $v['product_option_id'];
                            }
                            $data_template .= '<option value="' . $v['product_option_id'] . '" data-product="' . $product_id . '">' . ucfirst($v['value']) . '</option>';
                        }

                        $data_template .= '</select>';
                        $data_template .= '<label style="margin-top: 5px;">Choose Option Value (Select option first)</label>';
                        $data_template .= '<select name="product_option_value" class="input-option form-control select-option-value">';
                        if (!empty($query_option_value))
                        {
                            foreach ($query_option_value as $k => $r)
                            {
                                $selected = '';
                                if (in_array($r['product_option_id'], $temp_product_option_id))
                                {
                                    $data_template .= '<option selected value="' . $r['product_option_value_id'] . '">' . ucfirst($r['value']) . '</option>';
                                }
                            }
                        }
                        $data_template .= '</select>';
                        $data_template .= '<input type="hidden" name="product_id" value="' . $product_id . '">';
                        $data_template .= '<div class="text-right" style="margin-top: 5px;">';
                        $data_template .= '<button class="btn btn-primary button-option-add" data-loading-text="Loading..." type="submit"><i class="fa fa-plus-circle"></i> Add Option</button>';
                        $data_template .= '</div>';
                        $data_template .= '</form>';
                        $data_template .= '</td>';
                        $data_template .= '</tr>';
                        $data_template .= '</tfoot>';
                    }
                    $data_template .= '</table>';
                }
                $data_template .= '</td>';
                $data_template .= '<td class="text-left">' . $category_name . '</td>';
                $data_template .= '<td class="text-right">$.' . number_format($value['price'], 2, '.', '') . '</td>';
                $data_template .= '<td class="text-center" style="width: 3px;"><button data-original-title="Remove" type="button" value="' . $product_id . '" data-toggle="tooltip" title="" data-loading-text="Loading..." class="btn btn-danger btn-remove-product"><i class="fa fa-minus-circle"></i></button></td>';
                $data_template .= '</tr>';
            }
            //}
            //Update cart
            $this
                ->session
                ->set_userdata('admin_cart', json_encode($json));

            $message = 'Success';
            $flag = true;

        }
        else
        {
            $message = 'No product in database';
            $flag = false;
        }

        $result = array(
            'message' => $message,
            'flag' => $flag,
            'template' => $data_template,
            'json' => $json
        );

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function option_value_change($seg1 = '')
    {
        $product_option_id = $seg1;

        $query = $this
            ->Model_crud
            ->select_where('product_option_value', array(
            'product_option_id' => $product_option_id
        ));

        header('Content-Type: application/json');
        echo json_encode($query);
    }

    public function option_change($seg1 = '', $seg2 = '')
    {
        $product_option_value_id = $seg1;
        $product_id = $seg2;

        $data_template = '';
        $message = 'No data';
        $flag = false;

        if ($this
            ->session
            ->userdata('admin_cart'))
        {
            $json = json_decode($this
                ->session
                ->userdata('admin_cart') , true);
        }
        else
        {
            $this
                ->session
                ->set_userdata('admin_cart', json_encode($json));
        }

        $query_product_option_value = $this
            ->Model_backend
            ->get_product_option_change($product_option_value, $product_id);

        $result = array(
            'message' => $message,
            'flag' => $flag,
            'json' => $json,
            'product_option_value' => $product_option_value_id,
            'product_id' => $product_id,
            'query' => $query_product_option_value
        );

        if (!empty($json))
        {
            foreach ($json as $index => $value)
            {
                if ($value['product_id'] == $product_id)
                {
                    if (isset($value['order_option']))
                    {
                        foreach ($value['order_option'] as $k => $row)
                        {

                            if (!empty($query_product_option_value))
                            {
                                $message = 'Success';
                                $flag = true;
                                foreach ($query_product_option_value as $key => $values)
                                {
                                    $json[$index]['order_option'][$key] = array(
                                        'product_option_id' => $values['product_option_id'],
                                        'product_option_value_id' => $product_option_value_id,
                                        'name' => $values['name'],
                                        'price' => number_format($values['price'], 2, '.', '') ,
                                        'required' => $values['required'],
                                        'type' => $values['type'],
                                        'value' => $values['value']
                                    );
                                }
                            }

                        }
                    }
                }
            }
        }

        $this
            ->session
            ->set_userdata('admin_cart', json_encode($json));

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function option_remove($seg1 = '', $seg2 = '', $seg3 = '')
    {

        /* CRUD NYA BELOM */
        /* */
        /* */
        $json = array();
        $new_json = array();

        $product_id = $seg1;
        $product_option_value_id = $seg2;
        $product_option_id = $seg3;

        if (isset($product_id))
        {
            $product_id = (int)$seg1;
        }
        else
        {
            $product_id = 0;
        }

        //Get Cart
        if ($this
            ->session
            ->userdata('admin_cart'))
        {
            $json = json_decode($this
                ->session
                ->userdata('admin_cart') , true);
        }
        else
        {
            $this
                ->session
                ->set_userdata('admin_cart', json_encode($json));
        }

        if (!empty($json))
        {
            foreach ($json as $index => $value)
            {
                if ($value['product_id'] == $product_id)
                {
                    if (isset($value['order_option']))
                    {
                        $key_option = 'empty';
                        foreach ($value['order_option'] as $k => $row)
                        {
                            if ($row['product_option_id'] == $product_option_id)
                            {
                                $key_option = $k;
                            }
                        }
                        if (is_numeric($key_option))
                        {
                            unset($json[$index]['order_option'][$key_option]);
                            if (count($json[$index]['order_option']) == 0)
                            {
                                unset($json[$index]['order_option']);
                            }
                            else
                            {
                                $json[$index]['order_option'] = array_values($json[$index]['order_option']);
                            }
                        }
                        $json[$index]['order_option'] = array_values($json[$index]['order_option']);
                    }
                }
                $i++;
            }

            $this
                ->session
                ->set_userdata('admin_cart', json_encode($json));
        }

        header('Content-Type: application/json');
        echo json_encode($json);

    }

    //public function option_add($product_id = '',$product_option = '',$product_option_value = ''){
    public function option_add($seg1 = '')
    {

        $json = array();
        $new_json = array();

        if ($this
            ->session
            ->userdata('admin_cart'))
        {
            $json = json_decode($this
                ->session
                ->userdata('admin_cart') , true);
        }
        else
        {
            $this
                ->session
                ->set_userdata('admin_cart', json_encode($json));
        }

        if ($_POST)
        {

            $order_id = $seg1;
            $product_id = $this
                ->input
                ->post('product_id');
            $product_option = $this
                ->input
                ->post('product_option');
            $product_option_value = $this
                ->input
                ->post('product_option_value');

            $query_product_option = $this
                ->Model_backend
                ->get_product_option_add($product_option, $product_option_value, $product_id);
            $query_product = $this
                ->Model_backend
                ->get_product_and_category($product_id);
            $query_shipping_country = $this
                ->Model_backend
                ->get_shipping_price_from_order($order_id);
            $query_product_option_value = $this
                ->Model_crud
                ->select('product_option_value');

            if (!empty($json))
            {
                foreach ($json as $index => $value)
                {
                    if ($value['product_id'] == $product_id)
                    {
                        $new_option = array();
                        $data_template = '';
                        $flag = false;
                        $message = '';
                        if (isset($value['order_option']))
                        {
                            /* ADA ORDER OPTION SEBELUMNYA */
                            $no = 1;
                            $arr_search = array();
                            foreach ($value['order_option'] as $k => $row)
                            {
                                $arr_search[] = $row['product_option_value_id'];
                            }
                            $flag_check_same_id = false;
                            if (in_array($product_option_value, $arr_search))
                            {
                                $flag_check_same_id = true;
                            }
                            if ($flag_check_same_id == true)
                            {
                                $message = 'Value option already exist in table.';
                                $flag = false;
                                $result = array(
                                    'message' => $message,
                                    'flag' => $flag,
                                );
                            }
                            else
                            {
                                $message = 'Success.';
                                $flag = true;
                                $no = 1;
                                foreach ($value['order_option'] as $k => $row)
                                {
                                    if (!empty($query_product_option))
                                    {
                                        foreach ($query_product_option as $k => $v)
                                        {
                                            $new_option = array(
                                                'product_option_id' => $product_option,
                                                'product_option_value_id' => $product_option_value,
                                                'name' => $v['name'],
                                                'price' => number_format($v['price'], 2, '.', '') ,
                                                'required' => $v['required'],
                                                'type' => $v['type'],
                                                'value' => $v['value']
                                            );

                                            $data_template = '<tr>';
                                            $data_template .= '<td class="text-left"><p style="margin-bottom: 5px;">' . ucfirst($v['name']) . '</p></td>';
                                            $data_template .= '<td class="text-right">';
                                            if (!empty($query_product_option_value))
                                            {
                                                $data_template .= '<select class="product-option-value form-control" name="product_option_value">';
                                                foreach ($query_product_option_value as $key => $row)
                                                {
                                                    $selected = '';
                                                    if ($product_option == $row['product_option_id'])
                                                    {
                                                        $selected = 'selected';
                                                        $data_template .= '<option ' . $selected . ' value="' . $row['product_option_value_id'] . '" data-product="' . $product_id . '" data-product-option="' . $product_option . '">' . ucfirst($row['value']) . ' - $' . number_format($v['price'], 2, '.', '') . '</option>';
                                                    }
                                                }
                                                $data_template .= '</select>';
                                            }
                                            $data_template .= '</td>';
                                            $data_template .= '<td class="text-center" style="width: 3px;">
                                                <button data-original-title="Remove" type="button" data-toggle="tooltip" title="" data-loading-text="Loading..." class="btn btn-danger btn-remove-option"><i class="fa fa-minus-circle"></i></button></td></tr>';

                                        }
                                    }
                                    //array_splice($json[$index]['order_option'],$no,0,$new_option);
                                    $no++;
                                }

                                if (!empty($query_product_option))
                                {
                                    $json[$index]['order_option'][$no] = $new_option;
                                    $json[$index]['order_option'] = array_values($json[$index]['order_option']);
                                }
                                else
                                {
                                    $message = 'No data Product in option';
                                    $flag = false;
                                }
                            }
                            /* ADA ORDER OPTION SEBELUMNYA */
                        }
                        else
                        {
                            /* GA ADA ORDER OPTION SEBELUMNYA */
                            if (!empty($query_product_option))
                            {
                                $message = 'Success.';
                                $flag = true;
                                $no = 1;
                                foreach ($query_product_option as $k => $v)
                                {
                                    $new_option[] = array(
                                        'product_option_id' => $product_option,
                                        'product_option_value_id' => $product_option_value,
                                        'name' => $v['name'],
                                        'price' => number_format($v['price'], 2, '.', '') ,
                                        'required' => $v['required'],
                                        'type' => $v['type'],
                                        'value' => $v['value']
                                    );

                                    $data_template = '<tr>';
                                    $data_template .= '<td class="text-left"><p style="margin-bottom: 5px;">' . ucfirst($v['name']) . '</p></td>';
                                    $data_template .= '<td class="text-right">';
                                    if (!empty($query_product_option_value))
                                    {
                                        $data_template .= '<select class="product-option-value form-control" name="product_option_value">';
                                        foreach ($query_product_option_value as $key => $row)
                                        {
                                            $selected = '';
                                            if ($product_option == $row['product_option_id'])
                                            {
                                                $selected = 'selected';
                                                $data_template .= '<option ' . $selected . ' value="' . $row['product_option_value_id'] . '" data-product="' . $product_id . '">' . ucfirst($row['value']) . ' - $' . number_format($v['price'], 2, '.', '') . '</option>';
                                            }
                                        }
                                        $data_template .= '</select>';
                                    }
                                    $data_template .= '</td>';
                                    $data_template .= '<td class="text-center" style="width: 3px;">
                                        <button data-original-title="Remove" type="button" data-toggle="tooltip" title="" data-loading-text="Loading..." class="btn btn-danger btn-remove-option"><i class="fa fa-minus-circle"></i></button></td></tr>';
                                    $no++;
                                }
                                $json[$index]['order_option'] = $new_option;
                                $json[$index]['order_option'] = array_values($json[$index]['order_option']);
                            }
                            else
                            {
                                $message = 'No data Product in option';
                                $flag = false;
                            }
                            /* GA ADA ORDER OPTION SEBELUMNYA */
                        }
                        $result = array(
                            'message' => $message,
                            'flag' => $flag,
                            'template' => $data_template,
                            'json' => $json
                        );
                    }
                }
            }
        }

        $this
            ->session
            ->set_userdata('admin_cart', json_encode($json));

        header('Content-Type: application/json');
        echo json_encode($result);

    }

    public function product_remove($seg1 = '')
    {
        $json = array();
        $new_json = array();

        $product_id = $seg1;
        if (isset($product_id))
        {
            $product_id = (int)$seg1;
        }
        else
        {
            $product_id = 0;
        }

        //Get Cart
        if ($this
            ->session
            ->userdata('admin_cart'))
        {
            $json = json_decode($this
                ->session
                ->userdata('admin_cart') , true);
        }
        else
        {
            $this
                ->session
                ->set_userdata('admin_cart', json_encode($json));
        }

        //Rebuilt Cart
        foreach ($json as $row)
        {
            if ($row['product_id'] != $product_id)
            {
                $product_info = $this
                    ->Model_crud
                    ->select_where('product', array(
                    'product_id' => $row['product_id']
                ));
                $category = $this
                    ->Model_crud
                    ->select_where('category', array(
                    'category_id' => $product_info[0]['category_id']
                ));
                $special_price = $this
                    ->Model_crud
                    ->select_where('product_special', array(
                    'product_id' => $row['product_id']
                ));
                if ($special_price)
                {
                    $now = strtotime(date('Y-m-d'));
                    $date_end = strtotime($special_price[0]['date_end']);
                    if ($date_end >= $now)
                    {
                        $flag_special = $special_price;
                    }
                    else
                    {
                        $flag_special = false;
                    }
                }
                else
                {
                    $flag_special = false;
                }
                if ($flag_special)
                {
                    $special_price = $special_price[0]['price'];
                }
                else
                {
                    $special_price = false;
                }

                $new_json[] = array(
                    "product_id" => $row['product_id'],
                    "quantity" => $row['quantity'],
                    "product_name" => $product_info[0]['name'],
                    "category_name" => $category[0]['name'],
                    "special_price" => $special_price,
                    "price" => $product_info[0]['price']
                );

                if (isset($row['order_option']))
                {
                    foreach ($new_json as $index => $value)
                    {
                        $new_json[$index]['order_option'] = $row['order_option'];
                    }
                }
            }
        }

        //Update cart
        $this
            ->session
            ->set_userdata('admin_cart', json_encode($new_json));

        header('Content-Type: application/json');
        echo json_encode($new_json);
    }

    public function save()
    {
        $customer_id = $this
            ->input
            ->post('customer_id');
        $firstname = $this
            ->input
            ->post('firstname');
        $lastname = $this
            ->input
            ->post('lastname');
        $email = $this
            ->input
            ->post('email');
        $telephone = $this
            ->input
            ->post('telephone');
        $fax = $this
            ->input
            ->post('fax');
        $company = $this
            ->input
            ->post('company');
        $address_1 = $this
            ->input
            ->post('address_1');
        $address_2 = $this
            ->input
            ->post('address_2');
        $city = $this
            ->input
            ->post('city');
        $postcode = $this
            ->input
            ->post('postcode');
        $country_id = $this
            ->input
            ->post('country_id');
        $zone_id = $this
            ->input
            ->post('zone_id');
        $payment_method = $this
            ->input
            ->post('payment_method');
        $payment_comment = $this
            ->input
            ->post('payment_comment');
        $shipping_method = $this
            ->input
            ->post('shipping_method');
        $shipping_comment = $this
            ->input
            ->post('shipping_comment');
        $total = $this
            ->input
            ->post('total');

        $ip = $_SERVER['REMOTE_ADDR'] ? : ($_SERVER['HTTP_X_FORWARDED_FOR'] ? : $_SERVER['HTTP_CLIENT_IP']);
        //User Agent
        $this
            ->load
            ->library('user_agent');
        if ($this
            ->agent
            ->is_browser())
        {
            $user_agent = $this
                ->agent
                ->browser() . ' ' . $this
                ->agent
                ->version();
        }
        elseif ($this
            ->agent
            ->is_robot())
        {
            $user_agent = $this
                ->agent
                ->robot();
        }
        elseif ($this
            ->agent
            ->is_mobile())
        {
            $user_agent = $this
                ->agent
                ->mobile();
        }
        else
        {
            $user_agent = 'Unidentified User Agent';
        }

        $accept_language = $this
            ->agent
            ->agent_string();

        //message
        $error = False;
        if ((strlen(trim($firstname)) < 1) || (strlen(trim($firstname)) > 32))
        {
            $this
                ->session
                ->set_userdata('error_firstname', 'First Name must be between 1 and 32 characters!');
            $error = true;
        }
        if ((strlen(trim($lastname)) < 1) || (strlen(trim($lastname)) > 32))
        {
            $this
                ->session
                ->set_userdata('error_lastname', 'Last Name must be between 1 and 32 characters!');
            $error = true;
        }
        if ((strlen($email) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email))
        {
            $this
                ->session
                ->set_userdata('error_email', 'E-Mail Address does not appear to be valid!');
            $error = true;
        }
        if ((strlen($telephone) < 3) || (strlen($telephone) > 32))
        {
            $this
                ->session
                ->set_userdata('error_telephone', 'Telephone must be between 3 and 32 characters!');
            $error = true;
        }
        if ((strlen(trim($address_1)) < 3) || (strlen(trim($address_1)) > 128))
        {
            $this
                ->session
                ->set_userdata('error_address_1', 'Address 1 must be between 3 and 128 characters!');
            $error = true;
        }
        if ((strlen(trim($city)) < 2) || (strlen(trim($city)) > 128))
        {
            $this
                ->session
                ->set_userdata('error_city', 'City must be between 2 and 128 characters!');
            $error = true;
        }
        if ((strlen(trim($postcode)) < 2 || strlen(trim($postcode)) > 10))
        {
            $this
                ->session
                ->set_userdata('error_postcode', 'Postcode must be between 2 and 10 characters!');
            $error = true;
        }
        if ($country_id == '')
        {
            $this
                ->session
                ->set_userdata('error_country_id', 'Please select a country!');
            $error = true;
        }
        if ($zone_id == '')
        {
            $this
                ->session
                ->set_userdata('error_zone_id', 'Please select a region / state!');
            $error = true;
        }

        if ($error)
        {
            redirect('admin/sale/order/add');
        }

        //Insert Data Order
        $total_row = $this
            ->Model_crud
            ->total_row('order');
        $total_row += 1;
        $invoice = "INV-" . date('Y') . "-" . $total_row;
        $data_insert = array(
            "invoice" => $invoice,
            "customer_id" => $customer_id,
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
            "ip" => $ip,
            "user_agent" => $user_agent,
            "accept_language" => $accept_language,
            "date_added" => date('c') ,
            "date_modified" => date('c')
        );
        $ex_ins = $this
            ->Model_crud
            ->insert('order', $data_insert);
        $order_id = $this
            ->Model_crud
            ->inserted_id();

        //Insert Data Order History
        $data_insert = array(
            "order_id" => $order_id,
            "date_added" => date("c")
        );
        $ex_ins = $this
            ->Model_crud
            ->insert('order_history', $data_insert);

        //Insert Data Order Product
        /* Get Cart Start */
        //Get Cart if user logon
        $json = array();
        if ($this
            ->session
            ->userdata('admin_cart'))
        {
            $json = json_decode($this
                ->session
                ->userdata('admin_cart') , true);
        }

        //Get product from cart
        if (count($json) > 0)
        {
            foreach ($json as $row)
            {
                $query = "SELECT p.*, c.name as category_name, c.slug as category_slug , ps.price as special, ps.date_end FROM product p JOIN category c ON p.category_id = c.category_id LEFT JOIN product_special ps ON p.product_id = ps.product_id WHERE p.product_id = " . $row['product_id'];
                $products = $this
                    ->Model_crud
                    ->select_query($query);
                if ($products[0]['date_end'])
                {
                    $now = strtotime(date('Y-m-d'));
                    $date_end = strtotime($products[0]['date_end']);
                    if ($date_end >= $now)
                    {
                        $flag_special = $products[0]['special'];
                    }
                    else
                    {
                        $flag_special = false;
                    }
                }
                else
                {
                    $flag_special = false;
                }
                $price = ($flag_special) ? $products[0]['special'] : $products[0]['price'];
                $data_insert = array(
                    "order_id" => $order_id,
                    "product_id" => $products[0]['product_id'],
                    "name" => $products[0]['name'],
                    "category" => $products[0]['category_name'],
                    "quantity" => $row['quantity'],
                    "price" => $price,
                    "total" => $row['quantity'] * $price
                );
                $ex_ins = $this
                    ->Model_crud
                    ->insert('order_product', $data_insert);

                //Update Stock Quantity
                $data_update = array(
                    "quantity" => $products[0]['quantity'] - $row['quantity']
                );
                $ex_update = $this
                    ->Model_crud
                    ->update('product', $data_update, array(
                    'product_id' => $products[0]['product_id']
                ));
            }
        }
        /* Get Cart End */

        //Insert Data Order Total
        $data_insert = array(
            "order_id" => $order_id,
            "code" => 'total',
            "title" => 'Total',
            "value" => $total
        );
        $ex_ins = $this
            ->Model_crud
            ->insert('order_total', $data_insert);

        redirect('admin/sale/order');
    }

    public function info($seg1 = '')
    {
        //Data
        $data = $this->data;

        $order_id = $seg1;

        //Order ID
        $data['order_id'] = $order_id;

        //Order Details
        $data['order_detail'] = $this
            ->Model_crud
            ->select_where('order', array(
            'order_id' => $order_id
        ));
        $data['order_shipping_country'] = array();

        if (!empty($data['order_detail']))
        {
            $data['order_shipping_country'] = $this
                ->Model_crud
                ->select_where('country', array(
                'country_id' => $data['order_detail'][0]['shipping_country_id']
            ));
        }
        //Order History
        $data['order_history'] = $this
            ->Model_crud
            ->select_where('order_history', array(
            'order_id' => $order_id
        ));
        $total_row_order_history = $this
            ->Model_crud
            ->total_row_where('order_history', array(
            'order_id' => $order_id
        ));
        $data['last_order_history'] = $data['order_history'][$total_row_order_history - 1]['order_status'];

        //Country
        $data['country'] = $this
            ->Model_crud
            ->select_where('country', array(
            'country_id' => $data['order_detail'][0]['country_id']
        ));

        //Zone
        $data['zone'] = $this
            ->Model_crud
            ->select_where('zone', array(
            'zone_id' => $data['order_detail'][0]['zone_id']
        ));

        //Order Product
        $data['order_products'] = $this
            ->Model_crud
            ->select_where('order_product', array(
            'order_id' => $order_id
        ));

        //Order Total
        $data['order_total'] = $this
            ->Model_crud
            ->select_where('order_total', array(
            'order_id' => $order_id
        ));


        $data['order_option'] = json_decode($data['order_detail'][0]['option']);

      

        //View
        $data['load_view'] = 'admin/sale/order/order_info';
        $this
            ->load
            ->view('admin/template/backend', $data);
    }

    public function notify()
    {
        $order_id = $this
            ->input
            ->post('order_id');
        $order_status = $this
            ->input
            ->post('order_status');
        $notify = $this
            ->input
            ->post('notify');
        $comment = $this
            ->input
            ->post('comment');

        $data_insert = array(
            "order_id" => $order_id,
            "order_status" => $order_status,
            "notify" => $notify,
            "comment" => $comment,
            "date_added" => date("c")
        );
        $ex_ins = $this
            ->Model_crud
            ->insert('order_history', $data_insert);

        $data_update = array(
            "order_status" => $order_status
        );
        $ex_upd = $this
            ->Model_crud
            ->update('order', $data_update, array(
            'order_id' => $order_id
        ));

        $data_insert['date_added'] = date("d/m/Y", strtotime($data_insert['date_added']));
        $data_insert['notify'] = ($data_insert['notify'] == 1) ? "Yes" : "No";

        //Send Email
        if ($notify == 1)
        {
            $title = 'Your Order Status - Joscelyn Opal';

            //Get Order
            $order = $this
                ->Model_crud
                ->select_where('order', array(
                'order_id' => $order_id
            ));
            $country_name = $this
                ->Model_crud
                ->select_where('country', array(
                'country_id' => $order[0]['country_id']
            ));
            $zone_name = $this
                ->Model_crud
                ->select_where('zone', array(
                'zone_id' => $order[0]['zone_id']
            ));
            $data_email = array(
                'order_id' => $order_id,
                'date_added' => date('d/m/Y', strtotime($order[0]['date_added'])) ,
                'payment_method' => $order[0]['payment_method'],
                'shipping_method' => $order[0]['shipping_method'],
                'telephone' => $order[0]['telephone'],
                'ip' => $order[0]['ip'],
                'order_status' => $order_status,
                'payment_comment' => $order[0]['payment_comment'],
                'shipping_comment' => $order[0]['shipping_comment'],
                'shipping_address' => $order[0]['company'] . '<br>' . $order[0]['address_1'] . '<br>' . $order[0]['address_2'] . '<br>' . $order[0]['city'] . ' ' . $order[0]['postcode'] . '<br>' . $zone_name[0]['name'] . '<br>' . $country_name[0]['name']
            );

            //Get Order Product
            $products = $this
                ->Model_crud
                ->select_where('order_product', array(
                'order_id' => $order_id
            ));

            //Get Order Total
            $total = $this
                ->Model_crud
                ->select_where('order_total', array(
                'order_id' => $order_id
            ));

            //Get Order History
            $order_history = $this
                ->Model_crud
                ->select_where('order_history', array(
                'order_id' => $order_id
            ));

            $order_option = json_decode($order[0]['option']);


      
            $email = $order[0]['email'];
            $total = $total[0]['value'];

            $this->_sendMail($email, $title, $data_email, $products, $total, $order_history,$order_option );
        }

        header('Content-Type: application/json');
        echo json_encode($data_insert);
    }

    public function invoice($seg1 = '')
    {
        //Data
        $data = $this->data;

        $order_id = $seg1;

        //Order ID
        $data['order_id'] = $order_id;

        //Order Detail
        $data['order_detail'] = $this
            ->Model_crud
            ->select_where('order', array(
            'order_id' => $order_id
        ));

        //Zone
        $data['zone'] = $this
            ->Model_crud
            ->select_where('zone', array(
            'zone_id' => $data['order_detail'][0]['zone_id']
        ));

        //Country
        $data['country'] = $this
            ->Model_crud
            ->select_where('country', array(
            'country_id' => $data['order_detail'][0]['country_id']
        ));

        //Order Product
        $data['order_products'] = $this
            ->Model_crud
            ->select_where('order_product', array(
            'order_id' => $order_id
        ));

        //Order Total
        $data['order_total'] = $this
            ->Model_crud
            ->select_where('order_total', array(
            'order_id' => $order_id
        ));

        //Store Config
        $data['config_store_name'] = $this
            ->Model_crud
            ->select_where('setting', array(
            'setting_id' => 17
        ));
        $data['config_store_address'] = $this
            ->Model_crud
            ->select_where('setting', array(
            'setting_id' => 18
        ));
        $data['config_store_email'] = $this
            ->Model_crud
            ->select_where('setting', array(
            'setting_id' => 19
        ));
        $data['config_store_telephone'] = $this
            ->Model_crud
            ->select_where('setting', array(
            'setting_id' => 20
        ));

        //View
        $this
            ->load
            ->view('admin/sale/order/order_invoice', $data);
    }

    public function edit($seg1 = '')
    {
        //Data
        $data = $this->data;

        $this
            ->session
            ->unset_userdata('admin_cart');

        $order_id = $seg1;

        $json = array();

        //Order ID
        $data['order_id'] = $order_id;

        //Order Detail
        $data['order_detail'] = $this
            ->Model_crud
            ->select_where('order', array(
            'order_id' => $order_id
        ));

        //Customer
        if ($pdata['order_detail'][0]['customer_id'] == 0)
        {
            if (!empty($data['order_detail']))
            {
                $data['customer'] = $data['order_detail'];
            }
        }
        else
        {
            $data['customer'] = $this
                ->Model_crud
                ->select_where('customer', array(
                'customer_id' => $data['order_detail'][0]['customer_id']
            ));
        }

        //Country
        $data['product'] = $this
            ->Model_crud
            ->select('product');

        //Country
        $data['countries'] = $this
            ->Model_crud
            ->select('country');

        //Zone
        $data['zones'] = $this
            ->Model_crud
            ->select_where('zone', array(
            'country_id' => $data['order_detail'][0]['country_id']
        ));

        //Order Product
        $data['order_products'] = $this
            ->Model_crud
            ->select_where('order_product', array(
            'order_id' => $order_id
        ));

        $data['product_option'] = $this
            ->Model_crud
            ->select('product_option');

        //Order Option
        if (!empty($data['order_products']))
        {
            foreach ($data['order_products'] as $index => $value)
            {
                $order_option = $this
                    ->Model_backend
                    ->get_order_option($value['order_id'], $value['product_id']);
                $special_price = $this
                    ->Model_crud
                    ->select_where('product_special', array(
                    'product_id' => $value['product_id']
                ));
                if ($special_price)
                {
                    $now = strtotime(date('Y-m-d'));
                    $date_end = strtotime($special_price[0]['date_end']);
                    if ($date_end >= $now)
                    {
                        $flag_special = $special_price;
                    }
                    else
                    {
                        $flag_special = false;
                    }
                }
                else
                {
                    $flag_special = false;
                }
                if ($flag_special)
                {
                    $special_price = $special_price[0]['price'];
                }
                else
                {
                    $special_price = false;
                }

                foreach ($order_option as $key => $row)
                {
                    if ($value['product_id'] == $row['order_product_id'])
                    {

                        echo '<pre>';
                        print_r($row);
                        echo '</pre>';
                        $data['order_products'][$index]['order_option'][] = array(
                            'name' => $row['name'],
                            'price' => $row['price'],
                            'product_option_id' => $row['product_option_id'],
                            'product_option_value_id' => $row['product_option_value_id'],
                            'required' => $row['required'],
                            'type' => $row['type'],
                            'value' => $row['value']
                        );
                    }
                    else
                    {
                        $data['order_products'][] = array(
                            $value
                        );
                    }
                }
            }
        }

        echo '<pre>';
        print_r($data['order_products']);
        echo '</pre>';

        $json = $data['order_products'];

        //Order Product Option Value
        $data['product_option_value'] = $this
            ->Model_crud
            ->select('product_option_value');

        //Order Shipping
        $data['shipping_country'] = $this
            ->Model_crud
            ->select_where('country', array(
            'country_id' => $data['order_detail'][0]['shipping_country_id']
        ));

        //Order Total
        $data['order_total'] = $this
            ->Model_crud
            ->select_where('order_total', array(
            'order_id' => $order_id
        ));

        // Data Shipping
        $data['shipping'] = $this
            ->Model_crud
            ->select_where('setting', array(
            'code' => 'shipping'
        ));

        /* Payment Start */
        // Bank
        $data['bank'] = $this
            ->Model_crud
            ->select_where('setting', array(
            'setting_id' => 1
        ));

        // Paypal
        $data['paypal'] = $this
            ->Model_crud
            ->select_where('setting', array(
            'setting_id' => 2
        ));
        /* Payment End */

        //Get Cart
        /*foreach ($data['order_products'] as $row) {
        $product = $this->Model_crud->select_where('product', array('product_id'=>$row['product_id']));
        $special_price = $this->Model_crud->select_where('product_special', array('product_id'=>$row['product_id']));
        if($special_price) {
        $now = strtotime(date('Y-m-d'));
        $date_end = strtotime($special_price[0]['date_end']);
        if($date_end >= $now ) {
        $flag_special = $special_price;
        } else {
        $flag_special = FALSE;
        }
        } else {
        $flag_special = FALSE;
        }
        if($flag_special) {
        $special_price = $special_price[0]['price'];
        } else {
        $special_price = FALSE;
        }
        
        $json[] = array(
        "product_id" => $row['product_id'],
        "quantity" => $row['quantity'],
        "product_name" => $row['name'],
        "category_name" => $row['category'],
        "special_price" => $special_price,
        "price" => $product[0]['price']
        );
        }*/

        //View
        $this
            ->session
            ->set_userdata('admin_cart', json_encode($json));

        if ($this
            ->session
            ->userdata('admin_cart'))
        {
            $json = json_decode($this
                ->session
                ->userdata('admin_cart') , true);
        }

        /*echo '<pre>';
        print_r($data);
        echo '</pre>';*/
        //Get product from cart
        //$data['load_view'] = 'admin/sale/order/order_edit';
        //$this->load->view('admin/template/backend', $data);
        
    }

    public function update()
    {
        $order_id = $this
            ->input
            ->post('order_id');
        $customer_id = $this
            ->input
            ->post('customer_id');
        $firstname = $this
            ->input
            ->post('firstname');
        $lastname = $this
            ->input
            ->post('lastname');
        $email = $this
            ->input
            ->post('email');
        $telephone = $this
            ->input
            ->post('telephone');
        $fax = $this
            ->input
            ->post('fax');
        $company = $this
            ->input
            ->post('company');
        $address_1 = $this
            ->input
            ->post('address_1');
        $address_2 = $this
            ->input
            ->post('address_2');
        $city = $this
            ->input
            ->post('city');
        $postcode = $this
            ->input
            ->post('postcode');
        $country_id = $this
            ->input
            ->post('country_id');
        $zone_id = $this
            ->input
            ->post('zone_id');
        $payment_method = $this
            ->input
            ->post('payment_method');
        $payment_comment = $this
            ->input
            ->post('payment_comment');
        $shipping_method = $this
            ->input
            ->post('shipping_method');
        $shipping_comment = $this
            ->input
            ->post('shipping_comment');
        $order_status = $this
            ->input
            ->post('order_status');
        $total = $this
            ->input
            ->post('total');

        //message
        $error = False;
        if ((strlen(trim($firstname)) < 1) || (strlen(trim($firstname)) > 32))
        {
            $this
                ->session
                ->set_userdata('error_firstname', 'First Name must be between 1 and 32 characters!');
            $error = true;
        }
        if ((strlen(trim($lastname)) < 1) || (strlen(trim($lastname)) > 32))
        {
            $this
                ->session
                ->set_userdata('error_lastname', 'Last Name must be between 1 and 32 characters!');
            $error = true;
        }
        if ((strlen($email) > 96) || !preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email))
        {
            $this
                ->session
                ->set_userdata('error_email', 'E-Mail Address does not appear to be valid!');
            $error = true;
        }
        if ((strlen($telephone) < 3) || (strlen($telephone) > 32))
        {
            $this
                ->session
                ->set_userdata('error_telephone', 'Telephone must be between 3 and 32 characters!');
            $error = true;
        }
        if ((strlen(trim($address_1)) < 3) || (strlen(trim($address_1)) > 128))
        {
            $this
                ->session
                ->set_userdata('error_address_1', 'Address 1 must be between 3 and 128 characters!');
            $error = true;
        }
        if ((strlen(trim($city)) < 2) || (strlen(trim($city)) > 128))
        {
            $this
                ->session
                ->set_userdata('error_city', 'City must be between 2 and 128 characters!');
            $error = true;
        }
        if ((strlen(trim($postcode)) < 2 || strlen(trim($postcode)) > 10))
        {
            $this
                ->session
                ->set_userdata('error_postcode', 'Postcode must be between 2 and 10 characters!');
            $error = true;
        }
        if ($country_id == '')
        {
            $this
                ->session
                ->set_userdata('error_country_id', 'Please select a country!');
            $error = true;
        }
        if ($zone_id == '')
        {
            $this
                ->session
                ->set_userdata('error_zone_id', 'Please select a region / state!');
            $error = true;
        }

        if ($error)
        {
            redirect('admin/sale/order/edit/' . $order_id);
        }

        //Update Data Order
        $data_update = array(
            "customer_id" => $customer_id,
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
            "date_modified" => date('c')
        );
        $ex_upd = $this
            ->Model_crud
            ->update('order', $data_update, array(
            "order_id" => $order_id
        ));

        ###Delete Old Data & Insert Data Order Product###
        $old_carts = $this
            ->Model_crud
            ->select_where('order_product', array(
            "order_id" => $order_id
        ));
        //Realising old cart qty
        foreach ($old_carts as $old_cart)
        {
            $query = "SELECT p.*, c.name as category_name, c.slug as category_slug , ps.price as special FROM product p JOIN category c ON p.category_id = c.category_id LEFT JOIN product_special ps ON p.product_id = ps.product_id WHERE p.product_id = " . $old_cart['product_id'];
            $products = $this
                ->Model_crud
                ->select_query($query);
            $data_update = array(
                "quantity" => $products[0]['quantity'] + $old_cart['quantity']
            );
            $ex_upd = $this
                ->Model_crud
                ->update('product', $data_update, array(
                'product_id' => $old_cart['product_id']
            ));
        }

        $ex_del = $this
            ->Model_crud
            ->delete('order_product', array(
            "order_id" => $order_id
        ));

        /* Get Cart Start */
        $json = array();
        if ($this
            ->session
            ->userdata('admin_cart'))
        {
            $json = json_decode($this
                ->session
                ->userdata('admin_cart') , true);
        }

        //Get product from cart
        if (count($json) > 0)
        {
            foreach ($json as $row)
            {
                $query = "SELECT p.*, c.name as category_name, c.slug as category_slug , ps.price as special, ps.date_end FROM product p JOIN category c ON p.category_id = c.category_id LEFT JOIN product_special ps ON p.product_id = ps.product_id WHERE p.product_id = " . $row['product_id'];
                $products = $this
                    ->Model_crud
                    ->select_query($query);

                if ($products[0]['date_end'])
                {
                    $now = strtotime(date('Y-m-d'));
                    $date_end = strtotime($products[0]['date_end']);
                    if ($date_end >= $now)
                    {
                        $flag_special = $products[0]['special'];
                    }
                    else
                    {
                        $flag_special = false;
                    }
                }
                else
                {
                    $flag_special = false;
                }

                $price = ($flag_special) ? $products[0]['special'] : $products[0]['price'];
                $data_insert = array(
                    "order_id" => $order_id,
                    "product_id" => $products[0]['product_id'],
                    "name" => $products[0]['name'],
                    "category" => $products[0]['category_name'],
                    "quantity" => $row['quantity'],
                    "price" => $price,
                    "total" => $row['quantity'] * $price
                );
                $ex_ins = $this
                    ->Model_crud
                    ->insert('order_product', $data_insert);

                //Update Stock Quantity
                $data_update = array(
                    "quantity" => $products[0]['quantity'] - $row['quantity']
                );
                $ex_upd = $this
                    ->Model_crud
                    ->update('product', $data_update, array(
                    'product_id' => $products[0]['product_id']
                ));
            }
        }
        /* Get Cart End */

        //Insert Data Order Total
        $data_update = array(
            "value" => $total
        );
        $ex_upd = $this
            ->Model_crud
            ->update('order_total', $data_update, array(
            "order_id" => $order_id
        ));

        $this
            ->session
            ->set_userdata('order_success', 'Success: You have modified order!');

        redirect('admin/sale/order');
    }

    public function delete($seg1 = '')
    {
        $order_id = $seg1;

        //Delete table order
        $ex_del = $this
            ->Model_crud
            ->delete('order', array(
            'order_id' => $order_id
        ));

        //Delete table order history
        $ex_del = $this
            ->Model_crud
            ->delete('order_history', array(
            'order_id' => $order_id
        ));

        //Delete table order product
        $ex_del = $this
            ->Model_crud
            ->delete('order_product', array(
            'order_id' => $order_id
        ));

        //Delete table order total
        $ex_del = $this
            ->Model_crud
            ->delete('order_total', array(
            'order_id' => $order_id
        ));

        $this
            ->session
            ->set_userdata('order_success', 'Success: You have modified order!');

        redirect('admin/sale/order');
    }

    private function _sendMail($seg1 = '', $seg2 = '', $seg3 = '', $seg4 = '', $seg5 = '', $seg6 = '',$seg7='')
    {
        $email = $seg1;
        $title = $seg2;
        $data_email = $seg3;
        $data_cart = $seg4;
        $total = $seg5;
        $order_history = $seg6;
        $order_option = $seg7;


        //recipients
        $to = $email;

        //subject
        $subject = $title;

        // message
        $data = array();

        $data['order_option'] = $order_option;
        $data['title'] = $title;
        $data['store_url'] = base_url();
        $data['store_name'] = 'Joscelyn Opal';
        $data['logo'] = base_url('assets/images/general/logo_small.png');
        $data['text_greeting'] = 'Your Order Status has been update';

        $data['order_id'] = $data_email['order_id'];
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

        $data['order_history'] = $order_history;


       

        $message = $this
            ->load
            ->view('admin/email/order_history', $data, true);

        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'From: Joscelynopal <store@joscelynopal.com>' . "\r\n";

        // Mail it
        // mail($to, $subject, $message, $headers);


        $this->email->from('store@joscelynopal.com', 'Joscelynopal');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();

        exit;
    }
}

