<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	function __construct(){
		parent::__construct();

		//Data
		$this->data = array(
			'title' => 'Welcome to Joscelyn Opal'
		);
	}


	public function index(){
		//Data
		$data = $this->data;

		//View
		$data['load_view'] = 'view_welcome';
		$this->load->view('template/frontend', $data);
	}


}
