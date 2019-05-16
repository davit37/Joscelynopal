<?php



defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * ? DB INFO
 * 
 * Table = p_option
 * Column = option_name => varchar | json_child => text(JSON) | child_setting = text
 */

class Product_option extends CI_Controller {

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

          'title' => 'Products'

          );

  }

  public function index(){

     //Data
     $data = $this->data;

     $config["base_url"] = base_url('admin/catalog/category/page');
     $config["total_rows"] = $this->Model_crud->total_row('p_option');
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
     $this->pagination->initialize($config);

     $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 1;
     $data["results"] = $this->Model_crud->sort_no_order('p_option', (($page - 1) * $config['per_page']), $config["per_page"]);
     $data["links"] = $this->pagination->create_links();
     $data['url_name'] = base_url('admin/catalog/category/sort/name/asc/' . $page);
     $data['url_order'] = base_url('admin/catalog/category/sort/sort_order/asc/' . $page);
     $data['class_name'] = '';
     $data['class_order'] = '';
     $data['first_result'] = (($page - 1) * $config['per_page']) + 1;
     $data['last_result'] = count($data["results"]) + (($page - 1) * $config['per_page']);
     $data['total_result'] = $config["total_rows"];
     $data['total_page'] = ceil($config["total_rows"] / $config['per_page']);

      $data['load_view'] = 'admin/catalog/product_option/index';

      $this->load->view('admin/template/backend', $data);
  }


  /**
   * return form for CREATE or EDIT
   */
  public function form(){

    $action = $this->input->get('action');

    $data['action']='Create';
  

    if($action == 'edit'){

        $id = $this->input->get('id');
        $data['action']='Edit';

        $data['result'] = $this->Model_crud->select_where('p_option', array("id" => $id));
        $json_child = $data['result'][0]['json_child'];

        if($json_child != null ){
            $data['json_child'] = json_decode($json_child,true);
        
        
            foreach ($data['json_child'] as $key => $value) {

                $parent_id = $value['option_child_of'] != '' ? 'data-parent-id="'.$value['option_child_of'].'"' : '';

                $data['json_child'][$key]['option_list']='';

                $data['json_child'][$key]['child_name_html']=
                '<input type="text"  value="'.$value["child_name"].'" class="form-control option-name" data-option-index="'.$key.'"'.$parent_id.'>';

                foreach($data['json_child'] as $k => $v){

                    if($k != $key){

                        if($v['option_child_of'] == ''){

                            $selected = $value['option_child_of'] == $v['child_name'] ? "selected" : '';

                            $data['json_child'][$key]['option_list'].= "<option option-index='".$k."'". $selected.">".$v['child_name']."</option>";

                        }else{

                            $data['json_child'][$key]['option_list'].= "<option option-index=".$k." style='display:none'>".$v['child_name']."</option>";
                        }
                        
                    }

                }
            }
        }
       

    }


   $data['load_view'] = 'admin/catalog/product_option/form';
   
   $this->load->view('admin/template/backend', $data);
  }


  public function save(){

    $option_name    = $this->input->post('option_name');
    $json_child     = $this->input->post('json_child');
    $child_setting  = $this->input->post('child_setting');
    $action         = $this->input->get('action');

    $data = array(
        'option_name'   => $option_name,
        'json_child '   => $json_child,
        'child_setting' => $child_setting,
    );

    if($action =='Edit'){

        $id=[
            'id'=>$this->input->post("id"),
        ];
      
        $ex_action = $this->Model_crud->update('p_option', $data, $id);
       
        
    }else{
        $ex_action = $this->Model_crud->insert('p_option', $data);
    }

    if ($ex_action) {
        $this->session->set_userdata('category_success', TRUE);
    } else {
        $this->session->set_userdata('category_error', TRUE);
    }

    header('Content-Type: application/json');
    echo json_encode( "sukses" );

    
  }


  public function delete(){
        
    $checkbox = $this->input->post('selected');

    for ($i = 0; $i < count($checkbox); $i++) {
        $ex_del = $this->Model_crud->delete('p_option', array("id" => $checkbox[$i]));
    }

    //notification
    if ($ex_del) {
        $this->session->set_userdata('category_success', TRUE);
    } else {
        $this->session->set_userdata('category_error', TRUE);
    }

    redirect('admin/catalog/product_option');
  }

}