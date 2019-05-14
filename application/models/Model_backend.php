<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_backend extends CI_Model {

	function get_order_option($order_id,$product_id){
		$this->db->select('order_option.order_product_id,order_option.order_id,order_option.name,order_option.value,order_option.price,product_option.required,option.type,order_option.order_option_id,order_option.product_option_id,order_option.product_option_value_id');
		$this->db->join('product_option','order_option.product_option_id = product_option.product_option_id','left');
		$this->db->join('option','option.option_id = product_option.option_id','left');
		$this->db->where('order_option.order_id',$order_id);
		$this->db->where('order_option.order_product_id',$product_id);
		return $this->db->get('order_option')->result_array();
	}

	function get_product_option_add($product_option_id,$product_option_value_id,$product_id){
		$this->db->select('product_option.value AS `name`,product_option_value.value,product_option_value.price,product_option.required,option.type,product_option_value.product_option_id');
		$this->db->join('product_option','product_option.product_option_id = product_option_value.product_option_id','left');
		$this->db->join('option','option.option_id = product_option_value.option_id','left');
		$this->db->where('product_option_value_id',$product_option_value_id);
		$this->db->where('product_option.product_option_id',$product_option_id);
		$this->db->where('product_option_value.product_id',$product_id);
		return $this->db->get('product_option_value')->result_array();
	}

	function get_product_option_change($product_option_value_id,$product_id){
		$this->db->select('product_option.value AS `name`,product_option_value.value,product_option_value.price,product_option.required,option.type,product_option_value.product_option_id');
		$this->db->join('product_option','product_option.product_option_id = product_option_value.product_option_id','left');
		$this->db->join('option','option.option_id = product_option_value.option_id','left');
		$this->db->where('product_option_value_id',$product_option_value_id);
		$this->db->where('product_option_value.product_id',$product_id);
		return $this->db->get('product_option_value')->result_array();
	}

	function get_product_and_category($product_id){
		$this->db->select('product.name,category.name AS `category_name`,product.price,product_special.price AS `price_special`,product_special.date_start,product_special.date_end');
		$this->db->join('category','category.category_id = product.category_id','left');
		$this->db->join('product_special','product_special.product_id = product.product_id','left');
		return $this->db->get('product')->result_array();
	}

	function get_shipping_price_from_order($order_id){
		$this->db->select('shipping_price');
		$this->db->join('country','country.country_id = order.shipping_country_id','left');
		$this->db->where('order_id',$order_id);
		return $this->db->get('order')->result_array();
	}

	function get_option_and_value_by_id($product_id){
		$this->db->select('product_option.value AS `name`,product_option_value.value,product_option_value.price,product_option.required,option.type,product_option_value.product_option_id');
		$this->db->join('product_option_value','product_option_value.product_option_id = product_option.product_option_id','left');
		$this->db->join('option','option.option_id = product_option.option_id','left');
		$this->db->where('product_option.product_id',$product_id);
		return $this->db->get('product_option')->result_array();
	}
}

?>