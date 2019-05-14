<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Model_front extends CI_Model {



	function check_review_status($slug){
		$this->db->where('review_slug',$slug);
		$this->db->where('review_status','Pending');
		$query = $this->db->get('order');

		if($query->num_rows() > 0){
			return true;
		} else {
			return false;
		}
	}

	function get_order_notify_paypal($id){

		$this->db->select('order_total.order_id,payment_comment,shipping_comment,order_total.value');

		$this->db->where('order.order_id',$id);

		$this->db->join('order_total','order_total.order_id = order.order_id','left');

		return $this->db->get('order')->result_array();

	}

	function get_product_review($slug){
		$this->db->select('order_product.order_id,order_product.product_id,order_product.name,order_product.category,product.image,product.description');
		$this->db->join('order_product','order_product.order_id = order.order_id','left');
		$this->db->join('product','product.product_id = order_product.product_id','left');
		$this->db->where('review_slug',$slug);
		$this->db->where('review_status','Pending');
		return $this->db->get('order')->result_array();
	}

	function get_product_review_single($slug){
		$this->db->select('order.firstname,order.lastname,review.rating,review.text,review.status,review.date_added');
		$this->db->join('product','product.product_id = review.product_id','left');
		$this->db->join('order','order.order_id = review.order_id','left');
		$this->db->join('customer','customer.customer_id = order.customer_id','left');
		$this->db->where('product.slug',$slug);
		$this->db->where('review.status',1);
		return $this->db->get('review')->result_array();
	}

	function get_menu_header(){

		$this->db->select('title,label_menu,slug,sort_order,position_menu');

		$this->db->where('position_menu','header');

		$this->db->order_by('sort_order','asc');

		return $this->db->get('page')->result_array();

	}



	function get_menu_bottom(){

		$this->db->select('title,label_menu,slug,sort_order,position_menu');

		$this->db->where('position_menu','bottom');

		$this->db->order_by('sort_order','asc');

		return $this->db->get('page')->result_array();

	}

}



?>