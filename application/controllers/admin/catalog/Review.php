<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Review extends CI_Controller {



    function __construct() {

        parent::__construct();



        // check if logged in

        if (!$this->session->has_userdata('logged_in')) {

            redirect('admin/login');

        }



        //load Model

        $this->load->model('Model_crud');

        $this->load->library('pagination');



        //Data

        $this->data = array(

            'title' => 'Reviews'

        );

    }



    public function index() {

        //Data

        $data = $this->data;

        

        $config["base_url"] = base_url('admin/catalog/review/page');

        $config["per_page"] = 10;

        $config["uri_segment"] = 5;

        $config['use_page_numbers'] = TRUE;



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

        



        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 1;

        $query = "SELECT r.*, p.image, p.name as product_name, CONCAT(c.firstname, ' ', c.lastname) as customer_name from review r left join product p on r.product_id = p.product_id left join customer c on r.customer_id = c.customer_id LIMIT ".(($page - 1) * $config['per_page']).", ".$config["per_page"];

        $data['results'] = $this->Model_crud->select_query($query);

        $config["total_rows"] = $this->Model_crud->total_row('review');

        $this->pagination->initialize($config);

        

        $data['url_product'] = base_url('admin/catalog/review/sort/product/asc/' . $page);

        $data['url_author'] = base_url('admin/catalog/review/sort/author/asc/' . $page);

        $data['url_rating'] = base_url('admin/catalog/review/sort/rating/asc/' . $page);

        $data['url_status'] = base_url('admin/catalog/review/sort/status/asc/' . $page);

        $data['url_date'] = base_url('admin/catalog/review/sort/date/asc/' . $page);

        $data['class_product'] = '';

        $data['class_author'] = '';

        $data['class_rating'] = '';

        $data['class_status'] = '';

        $data['class_date'] = '';

        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;

        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);

        $data['total_result'] = $config["total_rows"];

        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);

        $data["links"] = $this->pagination->create_links();



        $data['load_view'] = 'admin/catalog/review/review_list';

        $this->load->view('admin/template/backend', $data);

    }

    

    public function page() {

        //Data

        $data = $this->data;

        

        $config["base_url"] = base_url('admin/catalog/review/page');

        $config["per_page"] = 10;

        $config["uri_segment"] = 5;

        $config['use_page_numbers'] = TRUE;



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

        



        $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 1;

        $query = "SELECT r.*, p.image, p.name as product_name, CONCAT(c.firstname, ' ', c.lastname) as customer_name from review r left join product p on r.product_id = p.product_id left join customer c on r.customer_id = c.customer_id LIMIT ".(($page - 1) * $config['per_page']).", ".$config["per_page"];

        $data['results'] = $this->Model_crud->select_query($query);

        $config["total_rows"] = $this->Model_crud->total_row('review');

        $this->pagination->initialize($config);

        

        $data['url_product'] = base_url('admin/catalog/review/sort/product/asc/' . $page);

        $data['url_author'] = base_url('admin/catalog/review/sort/author/asc/' . $page);

        $data['url_rating'] = base_url('admin/catalog/review/sort/rating/asc/' . $page);

        $data['url_status'] = base_url('admin/catalog/review/sort/status/asc/' . $page);

        $data['url_date'] = base_url('admin/catalog/review/sort/date/asc/' . $page);

        $data['class_product'] = '';

        $data['class_author'] = '';

        $data['class_rating'] = '';

        $data['class_status'] = '';

        $data['class_date'] = '';

        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;

        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);

        $data['total_result'] = $config["total_rows"];

        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);

        $data["links"] = $this->pagination->create_links();



        $data['load_view'] = 'admin/catalog/review/review_list';

        $this->load->view('admin/template/backend', $data);

    }



    public function add() {

        //Data

        $data = $this->data;



        $data['load_view'] = 'admin/catalog/review/review_add';

        $this->load->view('admin/template/backend', $data);

    }



    public function save() {

        //Data

        $data = $this->data;



       /* $author = $this->input->post('author');

        $title = $this->input->post('title');*/

        $product_id = $this->input->post('product_id');

        $text = $this->input->post('text');

        $rating = $this->input->post('rating');

        $status = $this->input->post('status');



        //message

        $error = False;

        /*if (strlen(trim($author)) < 1) {

            $this->session->set_userdata('author_error', 'Author is required!');

            $error = TRUE;

        }

        if (strlen(trim($title)) < 1) {

            $this->session->set_userdata('title_error', 'Title is required!');

            $error = TRUE;

        }*/

        if ($product_id == '') {

            $this->session->set_userdata('product_error', 'Product is required!');

            $error = TRUE;

        }

        if (strlen(trim($text)) < 1) {

            $this->session->set_userdata('text_error', 'Text is required!');

            $error = TRUE;

        }

        if ($rating == '') {

            $this->session->set_userdata('rating_error', 'Rating is required!');

            $error = TRUE;

        }



        if($error) {

            redirect('admin/catalog/review/add');

        }



        $data_insert = array(

            "product_id" => $product_id,

            "author" => $author,

            "title" => $title,

            "text" => $text,

            "rating" => $rating,

            "status" => $status,

            "date_added" => date("c")

        );



        //Insert Data Review

        $ex_ins = $this->Model_crud->insert('review', $data_insert);



        //notification

        if ($ex_ins) {

            $this->session->set_userdata('review_success', TRUE);

        } else {

            $this->session->set_userdata('review_error', TRUE);

        }



        redirect('admin/catalog/review');

    }

    

    public function edit($seg1 = '') {

        //Data

        $data = $this->data;

        

        $review_id = $seg1;

        $data['result'] = $this->Model_crud->select_where('review', array("review_id" => $review_id));

        

        //Data Product

        $data['product'] = $this->Model_crud->select_where('product', array("product_id" => $data['result'][0]['product_id']));

        

        $data['load_view'] = 'admin/catalog/review/review_edit';

        $this->load->view('admin/template/backend', $data);

    }

    

    public function update() {

        //Data

        $data = $this->data;



        $review_id = $this->input->post('review_id');

        /*$author = $this->input->post('author');

        $title = $this->input->post('title');*/

        $product_id = $this->input->post('product_id');

        $text = $this->input->post('text');

        $rating = $this->input->post('rating');

        $status = $this->input->post('status');



        //message

        $error = False;

        /*if (strlen(trim($author)) < 1) {

            $this->session->set_userdata('author_error', 'Author is required!');

            $error = TRUE;

        }

        if (strlen(trim($title)) < 1) {

            $this->session->set_userdata('title_error', 'Title is required!');

            $error = TRUE;

        }*/

        if ($product_id == '') {

            $this->session->set_userdata('product_error', 'Product is required!');

            $error = TRUE;

        }

        if (strlen(trim($text)) < 1) {

            $this->session->set_userdata('text_error', 'Text is required!');

            $error = TRUE;

        }

        if ($rating == '') {

            $this->session->set_userdata('rating_error', 'Rating is required!');

            $error = TRUE;

        }



        if($error) {

            redirect('admin/catalog/review/edit/'.$review_id);

        }



        $data_update = array(

            "product_id" => $product_id,

            "author" => $author,

            "title" => $title,

            "text" => $text,

            "rating" => $rating,

            "status" => $status,

            "date_modified" => date("c")

        );



        //Update Data Review

        $ex_upd = $this->Model_crud->update('review', $data_update, array("review_id" => $review_id));

        //notification

        if ($ex_upd) {

            $this->session->set_userdata('review_success', TRUE);

        } else {

            $this->session->set_userdata('review_error', TRUE);

        }



        redirect('admin/catalog/review');

    }



    public function delete() {

        //Data

        $data = $this->data;

        

        $checkbox = $this->input->post('selected');



        for ($i = 0; $i < count($checkbox); $i++) {

            $ex_del = $this->Model_crud->delete('review', array("review_id" => $checkbox[$i]));

        }



        //notification

        if ($ex_del) {

            $this->session->set_userdata('review_success', TRUE);

        } else {

            $this->session->set_userdata('review_error', TRUE);

        }



        redirect('admin/catalog/review');

    }



    public function filter($seg1 = '', $seg2 = '') {

        //Data

        $data = $this->data;



        $product = $this->input->post('filter_product');

        //$author = $this->input->post('filter_author');

        $date = $this->input->post('filter_date_added');

        $status = $this->input->post('filter_status');



        $query_where = array();

        if ($product != '') {

            $query_where[] = "p.name LIKE '%$product%'";

        }

        /*if ($author != '') {

            $query_where[] = "r.author LIKE '%$author%'";

        }*/

        if ($date != '') {

            $date_added_min = $date . " 00:00:00";

            $date_added_max = $date . " 23:59:59";

            $query_where[] = "r.date_added >= '$date_added_min' AND r.date_added <= '$date_added_max'";

        }

        if ($status != '') {

            $query_where[] = "r.status = '$status'";

        }

        if (count($query_where) > 0) {

            $this->session->set_userdata('query_where', $query_where);

        }



        $query = "SELECT r.*, p.image, p.name as product_name, CONCAT(c.firstname, ' ', c.lastname) as customer_name from review r left join product p on r.product_id = p.product_id left join customer c on r.customer_id = c.customer_id";

        if ($this->session->userdata('query_where')) {

            for ($i = 0; $i < count($this->session->userdata('query_where')); $i++) {

                if ($i == 0) {

                    $query .= " WHERE " . $this->session->userdata['query_where'][$i];

                } else {

                    $query .= " AND " . $this->session->userdata['query_where'][$i];

                }

            }

        }

        

        //Sort

        $sort_by = $seg2;



        switch ($seg1) {

            case 'product':

                $sort = 'p.name';

                $sort_seg1 = 'product';

                break;

            /*case 'author':

                $sort = 'r.author';

                $sort_seg1 = 'author';

                break;*/

            case 'rating':

                $sort = 'r.rating';

                $sort_seg1 = 'rating';

                break;

            case 'date':

                $sort = 'r.date_added';

                $sort_seg1 = 'date';

                break;

            case 'status':

                $sort = 'r.status';

                $sort_seg1 = 'status';

                break;

            default :

                $sort = 'p.name';

                $sort_seg1 = 'product';

        }

        if (empty($sort_by)) {

            $sort_by = 'asc';

        }

        

        $config["base_url"] = base_url('admin/catalog/review/filter/'.$sort_seg1.'/'.$sort_by);

        $config["total_rows"] = $this->Model_crud->total_row_query($query);

        $config["per_page"] = 10;

        $config["uri_segment"] = 7;

        $config['use_page_numbers'] = TRUE;

        

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

        

        $page = ($this->uri->segment(7)) ? $this->uri->segment(7) : 1;

        $query .= " ORDER BY $sort $sort_by LIMIT ".(($page - 1) * $config['per_page']).", ".$config["per_page"];

        $data['results'] = $this->Model_crud->select_query($query);

        $this->pagination->initialize($config);

        

        if ($sort_by == 'asc') {

            $reverse_sort = 'desc';

        } else {

            $reverse_sort = 'asc';

        }

        

        $data['url_product'] = base_url('admin/catalog/review/filter/product/asc/' . $page);

        $data['url_author'] = base_url('admin/catalog/review/filter/category/asc/' . $page);

        $data['url_date'] = base_url('admin/catalog/review/filter/date/asc/' . $page);

        $data['url_rating'] = base_url('admin/catalog/review/filter/rating/asc/' . $page);

        $data['url_status'] = base_url('admin/catalog/review/filter/status/asc/' . $page);

        $data['class_product'] = '';

        $data['class_author'] = '';

        $data['class_date'] = '';

        $data['class_rating'] = '';

        $data['class_status'] = '';

       

        switch ($seg1) {

            case 'product':

                $data['url_product'] = base_url('admin/catalog/review/filter/product/' . $reverse_sort . '/' . $page);

                $data['class_product'] = $sort_by;

                break;

            /*case 'author':

                $data['url_author'] = base_url('admin/catalog/review/filter/author/' . $reverse_sort . '/' . $page);

                $data['class_author'] = $sort_by;

                break;*/

            case 'rating':

                $data['url_rating'] = base_url('admin/catalog/review/filter/rating/' . $reverse_sort . '/' . $page);

                $data['class_rating'] = $sort_by;

                break;

            case 'date':

                $data['url_date'] = base_url('admin/catalog/review/filter/date/' . $reverse_sort . '/' . $page);

                $data['class_date'] = $sort_by;

                break;

            case 'status':

                $data['url_status'] = base_url('admin/catalog/review/sort/status/' . $reverse_sort . '/' . $page);

                $data['class_status'] = $sort_by;

                break;

        }

        

        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;

        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);

        $data['total_result'] = $config["total_rows"];

        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);

        $data["links"] = $this->pagination->create_links();



        $data['load_view'] = 'admin/catalog/review/review_list';

        $this->load->view('admin/template/backend', $data);

    }

    

    public function sort($seg1 = '', $seg2 = '') {

        //Data

        $data = $this->data;

        

        $sort_by = $seg2;



        switch ($seg1) {

            case 'product':

                $sort = 'p.name';

                break;

            case 'author':

                $sort = 'r.author';

                break;

            case 'rating':

                $sort = 'r.rating';

                break;

            case 'date':

                $sort = 'r.date_added';

                break;

            case 'status':

                $sort = 'r.status';

                break;

            default :

                $sort = 'p.name';

        }

        

        if (empty($sort_by)) {

            $sort_by = 'asc';

        }

        

        $config["base_url"] = base_url('admin/catalog/review/sort/'.$seg1.'/'.$sort_by);

        $query_total_row = "SELECT r.*, p.image, p.name as product_name, CONCAT(c.firstname, ' ', c.lastname) as customer_name from review r left join product p on r.product_id = p.product_id left join customer c on r.customer_id = c.customer_id ORDER BY $sort $sort_by";

        $config["total_rows"] = $this->Model_crud->total_row_query($query_total_row);

        $config["per_page"] = 10;

        $config["uri_segment"] = 7;

        $config['use_page_numbers'] = TRUE;



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

        



        $page = ($this->uri->segment(7)) ? $this->uri->segment(7) : 1;

        $query = "SELECT r.*, p.image, p.name as product_name, CONCAT(c.firstname, ' ', c.lastname) as customer_name from review r left join product p on r.product_id = p.product_id left join customer c on r.customer_id = c.customer_id ORDER BY $sort $sort_by LIMIT ".(($page - 1) * $config['per_page']).", ".$config["per_page"];

        $data['results'] = $this->Model_crud->select_query($query);

        $this->pagination->initialize($config);

        

        if ($sort_by == 'asc') {

            $reverse_sort = 'desc';

        } else {

            $reverse_sort = 'asc';

        }

        

        $data['url_product'] = base_url('admin/catalog/review/sort/product/asc/' . $page);

        $data['url_author'] = base_url('admin/catalog/review/sort/author/asc/' . $page);

        $data['url_rating'] = base_url('admin/catalog/review/sort/rating/asc/' . $page);

        $data['url_date'] = base_url('admin/catalog/review/sort/date/asc/' . $page);

        $data['url_status'] = base_url('admin/catalog/review/sort/status/asc/' . $page);

        $data['class_product'] = '';

        $data['class_author'] = '';

        $data['class_rating'] = '';

        $data['class_date'] = '';

        $data['class_status'] = '';

       

        switch ($seg1) {

            case 'product':

                $data['url_product'] = base_url('admin/catalog/review/sort/product/' . $reverse_sort . '/' . $page);

                $data['class_product'] = $sort_by;

                break;

            case 'author':

                $data['url_author'] = base_url('admin/catalog/review/sort/author/' . $reverse_sort . '/' . $page);

                $data['class_author'] = $sort_by;

                break;

            case 'rating':

                $data['url_rating'] = base_url('admin/catalog/review/sort/rating/' . $reverse_sort . '/' . $page);

                $data['class_rating'] = $sort_by;

                break;

            case 'date':

                $data['url_date'] = base_url('admin/catalog/review/sort/date/' . $reverse_sort . '/' . $page);

                $data['class_date'] = $sort_by;

                break;

            case 'status':

                $data['url_status'] = base_url('admin/catalog/review/sort/status/' . $reverse_sort . '/' . $page);

                $data['class_status'] = $sort_by;

                break;

        }

        

        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;

        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);

        $data['total_result'] = $config["total_rows"];

        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);

        $data["links"] = $this->pagination->create_links();



        $data['load_view'] = 'admin/catalog/review/review_list';

        $this->load->view('admin/template/backend', $data);

    }

    

    public function autocomplete($seg1 = '', $seg2 = '') {

        $json = array();

        $limit = 5;

        $like = 'name';

        $like_by = $seg2;



        switch ($seg1) {

            case 'name':

                $results = $this->Model_crud->select_like_limit('product', array("$like" => $like_by), $limit);



                foreach ($results as $result) {

                    $json[] = array(

                        'product_id' => $result['product_id'],

                        'name' => $result['name']

                    );

                }

                break;



            case 'category':

                $results = $this->Model_crud->select_like_limit('category', array("$like" => $like_by), $limit);



                foreach ($results as $result) {

                    $json[] = array(

                        'category_id' => $result['category_id'],

                        'name' => $result['name']

                    );

                }

                break;

        }



        header('Content-Type: application/json');

        echo json_encode($json);

    }



}

