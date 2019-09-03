<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Product extends CI_Controller {



    function __construct() {

        parent::__construct();



        // check if logged in

        if (!$this->session->has_userdata('logged_in')) {

            redirect('admin/login');

        }



        //load Model

        $this->load->model('Model_crud');
        $this->load->library('form_validation');


        $this->load->library('pagination');



        //Data

        $this->data = array(

            'title' => 'Products'

            );

    }



    public function index() {

        //Data

        $data = $this->data;

        

        $config["base_url"] = base_url('admin/catalog/product/page');

        $config["per_page"] = 5;

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

        $query = "SELECT p.product_id, p.image, p.name as product_name, c.name as category_name, p.price, p.quantity, p.status, ps.price as special from product p left join category c on p.category_id = c.category_id left join product_special ps on p.product_id = ps.product_id LIMIT ".(($page - 1) * $config['per_page']).", ".$config["per_page"];

        $data['results'] = $this->Model_crud->select_query($query);

        $data['special_price'] = $this->Model_crud->select('product_special');

        $config["total_rows"] = $this->Model_crud->total_row('product');

        $this->pagination->initialize($config);

        

        $data['url_name'] = base_url('admin/catalog/product/sort/name/asc/' . $page);

        $data['url_category'] = base_url('admin/catalog/product/sort/category/asc/' . $page);

        $data['url_price'] = base_url('admin/catalog/product/sort/price/asc/' . $page);

        $data['url_quantity'] = base_url('admin/catalog/product/sort/quantity/asc/' . $page);

        $data['url_status'] = base_url('admin/catalog/product/sort/status/asc/' . $page);

        $data['class_name'] = '';

        $data['class_category'] = '';

        $data['class_price'] = '';

        $data['class_quantity'] = '';

        $data['class_status'] = '';

        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;

        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);

        $data['total_result'] = $config["total_rows"];

        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);

        $data["links"] = $this->pagination->create_links();


        $data['load_view'] = 'admin/catalog/product/product_list';

        $this->load->view('admin/template/backend', $data);

    }

    

    public function page() {

        //Data

        $data = $this->data;

        

        $config["base_url"] = base_url('admin/catalog/product/page');

        $config["per_page"] = 5;

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

        $query = "SELECT p.product_id, p.image, p.name as product_name, c.name as category_name, p.price, p.quantity, p.status, ps.price as special from product p left join category c on p.category_id = c.category_id left join product_special ps on p.product_id = ps.product_id LIMIT ".(($page - 1) * $config['per_page']).", ".$config["per_page"];

        $data['results'] = $this->Model_crud->select_query($query);

        $data['special_price'] = $this->Model_crud->select('product_special');

        $config["total_rows"] = $this->Model_crud->total_row('product');

        $this->pagination->initialize($config);

        

        $data['url_name'] = base_url('admin/catalog/product/sort/name/asc/' . $page);

        $data['url_category'] = base_url('admin/catalog/product/sort/category/asc/' . $page);

        $data['url_price'] = base_url('admin/catalog/product/sort/price/asc/' . $page);

        $data['url_quantity'] = base_url('admin/catalog/product/sort/quantity/asc/' . $page);

        $data['url_status'] = base_url('admin/catalog/product/sort/status/asc/' . $page);

        $data['class_name'] = '';

        $data['class_category'] = '';

        $data['class_price'] = '';

        $data['class_quantity'] = '';

        $data['class_status'] = '';

        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;

        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);

        $data['total_result'] = $config["total_rows"];

        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);

        $data["links"] = $this->pagination->create_links();

 

        $data['load_view'] = 'admin/catalog/product/product_list';

        $this->load->view('admin/template/backend', $data);

    }



    public function add() {

        //Data

        $data = $this->data;

        //Category Product

        $data['category'] = $this->Model_crud->select_order('category', 'name', 'asc');

        $p_option = $this->Model_crud->select('p_option');
        $html = '';
        $is_selected='';

        foreach($p_option as  $value){
            $html .= '<option value="'.$value['id'].'">'.$value['option_name'].'</option>';
        }

        $data['option_list'] = $html;

        //Option

        $data['option'] = $this->Model_crud->select('option');

        $data['load_view'] = 'admin/catalog/product/product_add';

        $this->load->view('admin/template/backend', $data) ;

    }



    public function save() {

        //Data
        $this->form_validation->set_rules('product_name', 'product_name', 'required');
        $this->form_validation->set_rules('product_description', 'product_description', 'required');
        $this->form_validation->set_rules('image', 'image', 'required');
        $this->form_validation->set_rules('type', 'type', 'required');
        $this->form_validation->set_rules('item_id', 'item_id', 'required');
        $this->form_validation->set_rules('content', 'content', 'required');
        $this->form_validation->set_rules('weight', 'weight', 'required');
        $this->form_validation->set_rules('size', 'size', 'required');
        $this->form_validation->set_rules('shape', 'shape', 'required');
        $this->form_validation->set_rules('shape', 'shape', 'required');
        $this->form_validation->set_rules('clarity', 'clarity', 'required');
        $this->form_validation->set_rules('stock', 'Stock','required');
        $this->form_validation->set_rules('category_id','category_id','required');
        $this->form_validation->set_rules('treatment','treatment','required');
        $this->form_validation->set_rules('origin','origin','required');
        $this->form_validation->set_rules('price','price','required');
        
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run() == FALSE)
        {
           $this->add();
           
        }else{

            $name = $this->input->post('product_name');

            $description = $this->input->post('product_description');
    
            $image = $this->input->post('image');
    
            $type = $this->input->post('type');
    
            $item_id = $this->input->post('item_id');
    
            $content = $this->input->post('content');
    
            $weight = $this->input->post('weight');
    
            $size = $this->input->post('size');
    
            $shape = $this->input->post('shape');
    
            $clarity = $this->input->post('clarity');
    
            $treatment = $this->input->post('treatment');
    
            $origin = $this->input->post('origin');
    
            $price = $this->input->post('price');
    
            $quantity = $this->input->post('quantity');
    
            $stock = $this->input->post('stock');
    
            $category_id = $this->input->post('category_id');
    
            $featured = $this->input->post('featured');
    
            $sort_order = $this->input->post('sort_order');
    
            $status = $this->input->post('status');
    
            $slug = $this->input->post('slug');
    
            $option_type = $this->input->post('option_type');
    
            $option_name = $this->input->post('option_name');
    
            $option_required = $this->input->post('option_required');
    
            $opt_value = $this->input->post('opt_value');
    
            $opt_price = $this->input->post('opt_price');
    
            $opt_weight = $this->input->post('opt_weight');
    
            $option_id  = $this->input->post('option_id');
    
    
    
            if (empty($name)) {
    
                $this->session->set_userdata('product_error', TRUE);
    
                redirect('admin/catalog/product/add');
    
            }
    
            if (empty($slug)) {
    
                $slug = url_title($name, 'dash', TRUE);
    
            }
    
            $check_duplicate = $this->Model_crud->check_duplicate('product', array("slug" => $slug));
    
            if ($check_duplicate) {
    
                $this->session->set_userdata('slug_error', TRUE);
    
                redirect('admin/catalog/product/add');
    
            }
    
    
    
            $data_insert = array(
    
                "name" => $name,
    
                "description" => $description,
    
                "image" => $image,
    
                "type" => $type,
    
                "item_id" => $item_id,
    
                "content" => $content,
    
                "weight" => $weight,
    
                "size" => $size,
    
                "shape" => $shape,
    
                "clarity" => $clarity,
    
                "treatment" => $treatment,
    
                "origin" => $origin,
    
                "price" => $price,
    
                "quantity" => $quantity,
    
                "stock" => $stock,
    
                "category_id" => $category_id,
    
                "featured" => $featured,
    
                "sort_order" => $sort_order,
    
                "status" => $status,
    
                "slug" => $slug,
    
                "date_added" => date("c"),
    
                'option_id'=>$option_id
    
    
    
                );
    
            
    
            //Insert Data Product
    
            $ex_ins = $this->Model_crud->insert('product', $data_insert);
    
            $product_id = $this->Model_crud->inserted_id();
    
    
    
            //Insert Data Product Image
    
            $product_image = $this->input->post('product_image');
    
            $product_image_sort_order = $this->input->post('product_image_sort_order');
    
            for ($i = 0; $i < count($product_image); $i++) {
    
                $data_insert = array(
    
                    "product_id" => $product_id,
    
                    "image" => $product_image[$i],
    
                    "sort_order" => $product_image_sort_order[$i]
    
                    );
    
                $ex_ins = $this->Model_crud->insert('product_image', $data_insert);
    
            }
    
    
    
            //Insert Data Product Video
    
            $mp4 = $this->input->post('product_video_mp4');
    
            $webm = $this->input->post('product_video_webm');
    
            $ogv = $this->input->post('product_video_ogv');
    
    
    
            if ($mp4 != '') {
    
                $data_insert = array(
    
                    "product_id" => $product_id,
    
                    "video" => $mp4,
    
                    "type" => 'mp4'
    
                    );
    
                $ex_ins = $this->Model_crud->insert('product_video', $data_insert);
    
            }
    
            if ($webm != '') {
    
                $data_insert = array(
    
                    "product_id" => $product_id,
    
                    "video" => $webm,
    
                    "type" => 'webm'
    
                    );
    
                $ex_ins = $this->Model_crud->insert('product_video', $data_insert);
    
            }
    
            if ($ogv != '') {
    
                $data_insert = array(
    
                    "product_id" => $product_id,
    
                    "video" => $ogv,
    
                    "type" => 'ogv'
    
                    );
    
                $ex_ins = $this->Model_crud->insert('product_video', $data_insert);
    
            }
    
            
    
            //Insert Data Product Option
    
            if($option_type) {
    
    
    
                for ($i = 0; $i < count($option_type); $i++) {
    
                    $data_option = array(
    
                        "product_id" => $product_id,
    
                        "option_id" => $option_type[$i],
    
                        "value" => $option_name[$i],
    
                        "required" => $option_required[$i]
    
                        );
    
                    $ex_ins = $this->Model_crud->insert('product_option', $data_option);
    
                    $product_option_id = $this->Model_crud->inserted_id();
    
                    
    
                    for($j = 0; $j < count($opt_value[$i]); $j++) {
    
                        $data_option_value = array(
    
                            "product_option_id" => $product_option_id,
    
                            "product_id" => $product_id,
    
                            "option_id" => $option_type[$i],
    
                            "value" => $opt_value[$i][$j],
    
                            "price" => $opt_price[$i][$j],
    
                            "weight" => $opt_weight[$i][$j]
    
                            );
    
                        $ex_ins = $this->Model_crud->insert('product_option_value', $data_option_value);
    
                    }
    
                    
    
                }
    
                
    
            }
    
    
    
            //Insert Data Product Special
    
            $product_special_price = $this->input->post('product_special_price');
    
            $product_special_date_start = $this->input->post('product_special_date_start');
    
            $product_special_date_end = $this->input->post('product_special_date_end');
    
            if ($product_special_price != '' && $product_special_date_start != '' && $product_special_date_end != '') {
    
                $data_insert = array(
    
                    "product_id" => $product_id,
    
                    "price" => $product_special_price,
    
                    "date_start" => $product_special_date_start,
    
                    "date_end" => $product_special_date_end
    
                    );
    
                $ex_ins = $this->Model_crud->insert('product_special', $data_insert);
    
            }
    
    
    
            //notification
    
            if ($ex_ins) {
    
                $this->session->set_userdata('product_success', TRUE);
    
            } else {
    
                $this->session->set_userdata('product_error', TRUE);
    
            }
    
    
    
            redirect('admin/catalog/product');
        }
        


    }

    

    public function edit($seg1 = '') {




        //Data

        $data = $this->data;       

        $product_id = $seg1;
        $product = $this->Model_crud->select_where('product', array("product_id" => $product_id));

        $p_option = $this->Model_crud->select('p_option');
        $html = '';
        $is_selected='';

        foreach($p_option as  $value){

            if($value['id'] == $product[0]['option_id'] ){
                $is_selected='selected';
            }else{
                $is_selected='';
            }

            $html .= '<option value="'.$value['id'].'"'.$is_selected.'>'.$value['option_name'].'</option>';
        }

        $data['option_list'] = $html;

        $data['result'] = $this->Model_crud->select_where('product', array("product_id" => $product_id));

        

        //Category Product

        $data['category'] = $this->Model_crud->select_order('category', 'name', 'asc');

        

        //Product Image

        $data['product_images'] = $this->Model_crud->select_where_order('product_image', array("product_id"=>$product_id) , 'sort_order', 'asc');

        $data['total_row_images'] = $this->Model_crud->total_row_where('product_image', array("product_id"=>$product_id));

        

        //Product Video

        $data['product_videos'] = $this->Model_crud->select_where('product_video', array("product_id"=>$product_id));

        

        //Option

        $data['option'] = $this->Model_crud->select('option');

        

        //Product Option

        $data['product_options'] = $this->Model_crud->select_where('product_option', array("product_id"=>$product_id));

        

        //Product Option Value

        $data['product_option_values'] = $this->Model_crud->select_where('product_option_value', array("product_id"=>$product_id));

        

        //Product Special

        $data['product_special'] = $this->Model_crud->select_where('product_special', array("product_id"=>$product_id));



        $data['load_view'] = 'admin/catalog/product/product_edit';

        $this->load->view('admin/template/backend', $data);

    }

    

    public function update() {

        //Data

         //Data
         $this->form_validation->set_rules('product_name', 'product_name', 'required');
         $this->form_validation->set_rules('product_description', 'product_description', 'required');
         $this->form_validation->set_rules('image', 'image', 'required');
         $this->form_validation->set_rules('type', 'type', 'required');
         $this->form_validation->set_rules('item_id', 'item_id', 'required');
         $this->form_validation->set_rules('content', 'content', 'required');
         $this->form_validation->set_rules('weight', 'weight', 'required');
         $this->form_validation->set_rules('size', 'size', 'required');
         $this->form_validation->set_rules('shape', 'shape', 'required');
         $this->form_validation->set_rules('shape', 'shape', 'required');
         $this->form_validation->set_rules('clarity', 'clarity', 'required');
         $this->form_validation->set_rules('stock', 'Stock','required');
         $this->form_validation->set_rules('category_id','category_id','required');
         $this->form_validation->set_rules('treatment','treatment','required');
         $this->form_validation->set_rules('origin','origin','required');
         $this->form_validation->set_rules('price','price','required');
         
         $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
 
         if ($this->form_validation->run() == FALSE)
         {
            $this->edit($this->input->post('product_id'));
            
         }else{

            $data = $this->data;

            $product_id = $this->input->post('product_id');

            $name = $this->input->post('product_name');

            $description = $this->input->post('product_description');

            $image = $this->input->post('image');

            $type = $this->input->post('type');

            $item_id = $this->input->post('item_id');

            $content = $this->input->post('content');

            $weight = $this->input->post('weight');

            $size = $this->input->post('size');

            $shape = $this->input->post('shape');

            $clarity = $this->input->post('clarity');

            $treatment = $this->input->post('treatment');

            $origin = $this->input->post('origin');

            $price = $this->input->post('price');

            $quantity = $this->input->post('quantity');

            $stock = $this->input->post('stock');

            $category_id = $this->input->post('category_id');

            $featured = $this->input->post('featured');

            $sort_order = $this->input->post('sort_order');

            $status = $this->input->post('status');

            $slug = $this->input->post('slug');

            $prev_slug = $this->input->post('prev_slug');

            
            $product_option_id = $this->input->post('product_option_id');

            $option_type = $this->input->post('option_type');

            $option_name = $this->input->post('option_name');

            $option_required = $this->input->post('option_required');

            
            $opt_value_id = $this->input->post('opt_value_id');

            $opt_value = $this->input->post('opt_value');

            $opt_price = $this->input->post('opt_price');

            $opt_weight = $this->input->post('opt_weight');
            $option_id  = $this->input->post('option_id');



            if (empty($name)) {

                $this->session->set_userdata('product_error', TRUE);

                redirect('admin/catalog/product/edit/' . $product_id);

            }

            if ($prev_slug != $slug) {

                if (empty($slug)) {

                    $slug = url_title($name, 'dash', TRUE);

                }

                $check_duplicate = $this->Model_crud->check_duplicate('product', array("slug" => $slug));

                if ($check_duplicate) {

                    $this->session->set_userdata('slug_error', TRUE);

                    redirect('admin/catalog/product/edit/' . $product_id);

                }

            }



            $data_update = array(

                "name" => $name,

                "description" => $description,

                "image" => $image,

                "type" => $type,

                "item_id" => $item_id,

                "content" => $content,

                "weight" => $weight,

                "size" => $size,

                "shape" => $shape,

                "clarity" => $clarity,

                "treatment" => $treatment,

                "origin" => $origin,

                "price" => $price,

                "quantity" => $quantity,

                "stock" => $stock,

                "category_id" => $category_id,

                "featured" => $featured,

                "sort_order" => $sort_order,

                "status" => $status,

                "slug" => $slug,

                "date_modified" => date("c"),

                'option_id' => $option_id

                );



            //Update Data Product

            $ex_upd = $this->Model_crud->update('product', $data_update, array("product_id" => $product_id));



            //Update Data Product Image

            //Delete old data first

            $ex_upd = $this->Model_crud->delete('product_image', array("product_id" => $product_id));

            $product_image = $this->input->post('product_image');

            $product_image_sort_order = $this->input->post('product_image_sort_order');

            for ($i = 0; $i < count($product_image); $i++) {

                $data_insert = array(

                    "product_id" => $product_id,

                    "image" => $product_image[$i],

                    "sort_order" => $product_image_sort_order[$i]

                    );

                $ex_upd = $this->Model_crud->insert('product_image', $data_insert);

            }



            //Update Data Product Video

            //Delete old data first

            $ex_upd = $this->Model_crud->delete('product_video', array("product_id" => $product_id));

            $mp4 = $this->input->post('product_video_mp4');

            $webm = $this->input->post('product_video_webm');

            $ogv = $this->input->post('product_video_ogv');

            if ($mp4 != '') {

                $data_insert = array(

                    "product_id" => $product_id,

                    "video" => $mp4,

                    "type" => 'mp4'

                    );

                $ex_upd = $this->Model_crud->insert('product_video', $data_insert);

            }

            if ($webm != '') {

                $data_insert = array(

                    "product_id" => $product_id,

                    "video" => $webm,

                    "type" => 'webm'

                    );

                $ex_upd = $this->Model_crud->insert('product_video', $data_insert);

            }

            if ($ogv != '') {

                $data_insert = array(

                    "product_id" => $product_id,

                    "video" => $ogv,

                    "type" => 'ogv'

                    );

                $ex_upd = $this->Model_crud->insert('product_video', $data_insert);

            }

            //Update Data Product Option
            
            //Update Data Product Special

            //Delete old data first

            $product_special_id = $this->input->post('product_special_id');

            $product_special_price = $this->input->post('product_special_price');

            $product_special_date_start = $this->input->post('product_special_date_start');

            $product_special_date_end = $this->input->post('product_special_date_end');

            if (empty($product_special_id)) {
                $data_insert = array(

                    "product_id" => $product_id,

                    "price" => $product_special_price,

                    "date_start" => $product_special_date_start,

                    "date_end" => $product_special_date_end

                    );

                $is_duplicate = $this->Model_crud->check_duplicate('product_special',['product_id'=>$product_id]);


                if(!$is_duplicate){
                    $ex_upd = $this->Model_crud->insert('product_special', $data_insert);

                }  

            } else {



                $data_update = array(

                    "product_id" => $product_id,

                    "price" => $product_special_price,

                    "date_start" => $product_special_date_start,

                    "date_end" => $product_special_date_end

                );

                $ex_upd = $this->Model_crud->update('product_special', $data_update,array('product_special_id' => $product_special_id));

            }




            //notification

            if ($ex_upd) {

                $this->session->set_userdata('product_success', TRUE);

            } else {

                $this->session->set_userdata('product_error', TRUE);

            }



            redirect('admin/catalog/product');
        }

    }



    public function delete() {

        //Data

        $data = $this->data;



        $checkbox = $this->input->post('selected');



        for ($i = 0; $i < count($checkbox); $i++) {

            $ex_del = $this->Model_crud->delete('product', array("product_id" => $checkbox[$i]));

        }



        //notification

        if ($ex_del) {

            $this->session->set_userdata('product_success', TRUE);

        } else {

            $this->session->set_userdata('product_error', TRUE);

        }



        redirect('admin/catalog/product');

    }



    public function filter($seg1 = '', $seg2 = '') {

        //Data

        $data = $this->data;



        $name = $this->input->post('filter_name');

        $category = $this->input->post('filter_category');

        $price = $this->input->post('filter_price');

        $quantity = $this->input->post('filter_quantity');

        $status = $this->input->post('filter_status');



        $query_where = array();

        if ($name != '') {

            $query_where[] = "p.name LIKE '%$name%'";

        }

        if ($category != '') {

            $query_where[] = "c.name LIKE '%$category%'";

        }

        if ($price != '') {

            $query_where[] = "p.price LIKE '%$price%'";

        }

        if ($quantity != '') {

            $query_where[] = "p.quantity = '$quantity'";

        }

        if ($status != '') {

            $query_where[] = "p.status = '$status'";

        }

        if (count($query_where) > 0) {

            $this->session->set_userdata('query_where', $query_where);

        }



        $query = "select p.product_id, p.image, p.name as product_name, c.name as category_name, p.price, p.quantity, p.status, ps.price as special from product p join category c on p.category_id = c.category_id left join product_special ps on p.product_id = ps.product_id";

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

            case 'name':

            $sort = 'p.name';

            $sort_seg1 = 'name';

            break;

            case 'category':

            $sort = 'c.name';

            $sort_seg1 = 'category';

            break;

            case 'price':

            $sort = 'p.price';

            $sort_seg1 = 'price';

            break;

            case 'quantity':

            $sort = 'p.quantity';

            $sort_seg1 = 'quantity';

            break;

            case 'status':

            $sort = 'p.status';

            $sort_seg1 = 'status';

            break;

            default :

            $sort = 'p.name';

            $sort_seg1 = 'name';

        }

        if (empty($sort_by)) {

            $sort_by = 'asc';

        }



        $config["base_url"] = base_url('admin/catalog/product/filter/'.$sort_seg1.'/'.$sort_by);

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
        $data['special_price'] = $this->Model_crud->select('product_special');

        $this->pagination->initialize($config);



        if ($sort_by == 'asc') {

            $reverse_sort = 'desc';

        } else {

            $reverse_sort = 'asc';

        }



        $data['url_name'] = base_url('admin/catalog/product/filter/name/asc/' . $page);

        $data['url_category'] = base_url('admin/catalog/product/filter/category/asc/' . $page);

        $data['url_price'] = base_url('admin/catalog/product/filter/price/asc/' . $page);

        $data['url_quantity'] = base_url('admin/catalog/product/filter/quantity/asc/' . $page);

        $data['url_status'] = base_url('admin/catalog/product/filter/status/asc/' . $page);

        $data['class_name'] = '';

        $data['class_category'] = '';

        $data['class_price'] = '';

        $data['class_quantity'] = '';

        $data['class_status'] = '';



        switch ($seg1) {

            case 'name':

            $data['url_name'] = base_url('admin/catalog/product/filter/name/' . $reverse_sort . '/' . $page);

            $data['class_name'] = $sort_by;

            break;

            case 'category':

            $data['url_category'] = base_url('admin/catalog/product/filter/category/' . $reverse_sort . '/' . $page);

            $data['class_category'] = $sort_by;

            break;

            case 'price':

            $data['url_price'] = base_url('admin/catalog/product/filter/price/' . $reverse_sort . '/' . $page);

            $data['class_price'] = $sort_by;

            break;

            case 'quantity':

            $data['url_quantity'] = base_url('admin/catalog/product/filter/quantity/' . $reverse_sort . '/' . $page);

            $data['class_quantity'] = $sort_by;

            break;

            case 'status':

            $data['url_status'] = base_url('admin/catalog/product/sort/status/' . $reverse_sort . '/' . $page);

            $data['class_status'] = $sort_by;

            break;

        }



        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;

        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);

        $data['total_result'] = $config["total_rows"];

        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);

        $data["links"] = $this->pagination->create_links();



        $data['load_view'] = 'admin/catalog/product/product_list';

        $this->load->view('admin/template/backend', $data);

    }



    public function sort($seg1 = '', $seg2 = '') {

        //Data

        $data = $this->data;



        $sort_by = $seg2;



        switch ($seg1) {

            case 'name':

            $sort = 'p.name';

            break;

            case 'category':

            $sort = 'c.name';

            break;

            case 'price':

            $sort = 'p.price';

            break;

            case 'quantity':

            $sort = 'p.quantity';

            break;

            case 'status':

            $sort = 'p.status';

            break;

            default :

            $sort = 'p.name';

        }



        if (empty($sort_by)) {

            $sort_by = 'asc';

        }



        $config["base_url"] = base_url('admin/catalog/product/sort/'.$seg1.'/'.$sort_by);

        $query_total_row = "select p.product_id, p.image, p.name as product_name, c.name as category_name, p.price, p.quantity, p.status, ps.price as special from product p join category c on p.category_id = c.category_id left join product_special ps on p.product_id = ps.product_id ORDER BY $sort $sort_by";

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

        $query = "select p.product_id, p.image, p.name as product_name, c.name as category_name, p.price, p.quantity, p.status, ps.price as special from product p join category c on p.category_id = c.category_id left join product_special ps on p.product_id = ps.product_id ORDER BY $sort $sort_by LIMIT ".(($page - 1) * $config['per_page']).", ".$config["per_page"];

        $data['results'] = $this->Model_crud->select_query($query);

        $this->pagination->initialize($config);



        if ($sort_by == 'asc') {

            $reverse_sort = 'desc';

        } else {

            $reverse_sort = 'asc';

        }



        $data['url_name'] = base_url('admin/catalog/product/sort/name/asc/' . $page);

        $data['url_category'] = base_url('admin/catalog/product/sort/category/asc/' . $page);

        $data['url_price'] = base_url('admin/catalog/product/sort/price/asc/' . $page);

        $data['url_quantity'] = base_url('admin/catalog/product/sort/quantity/asc/' . $page);

        $data['url_status'] = base_url('admin/catalog/product/sort/status/asc/' . $page);

        $data['class_name'] = '';

        $data['class_category'] = '';

        $data['class_price'] = '';

        $data['class_quantity'] = '';

        $data['class_status'] = '';



        switch ($seg1) {

            case 'name':

            $data['url_name'] = base_url('admin/catalog/product/sort/name/' . $reverse_sort . '/' . $page);

            $data['class_name'] = $sort_by;

            break;

            case 'category':

            $data['url_category'] = base_url('admin/catalog/product/sort/category/' . $reverse_sort . '/' . $page);

            $data['class_category'] = $sort_by;

            break;

            case 'price':

            $data['url_price'] = base_url('admin/catalog/product/sort/price/' . $reverse_sort . '/' . $page);

            $data['class_price'] = $sort_by;

            break;

            case 'quantity':

            $data['url_quantity'] = base_url('admin/catalog/product/sort/quantity/' . $reverse_sort . '/' . $page);

            $data['class_quantity'] = $sort_by;

            break;

            case 'status':

            $data['url_status'] = base_url('admin/catalog/product/sort/status/' . $reverse_sort . '/' . $page);

            $data['class_status'] = $sort_by;

            break;

        }



        $data['first_result'] = (($page - 1) * $config['per_page']) + 1;

        $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);

        $data['total_result'] = $config["total_rows"];

        $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);

        $data["links"] = $this->pagination->create_links();



        $data['load_view'] = 'admin/catalog/product/product_list';

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

