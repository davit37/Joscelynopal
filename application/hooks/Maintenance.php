<?php
class Maintenance {
	public function Maintenance_status(){
		$ci =& get_instance();
		$uri_1 = $ci->uri->segment(1);
		$uri_2 = $ci->uri->segment(2);

		//Get maintenance status
		$ci->load->model('Model_crud');
		$get = $ci->Model_crud->select_where('setting', array('setting_id'=>26));
        if(!empty($get[0]) && $get[0]['value'] == '0'){
			if($uri_1 == false || $uri_1 != 'admin'){
				$get = $ci->load->view('view_maintenance', '', true);
				echo $get;
				exit;
			}
		}
	}	
}
