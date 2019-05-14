<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index(){

    	$data['dapid'] = 'dapid';
    	$data['danang'] = 'danang';
    	$data = array('dapid' => 'dapid', 'danang' => 'danang');

    	foreach($data as $index => $value){

    		echo $index;
    	}
    	echo '<pre>';
    	print_r($data);
    	echo '</pre>';

    }

}

?>