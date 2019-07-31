<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Paypal extends CI_Controller {



	function __construct() {

		parent::__construct();



        //Load Model

		$this->load->model('Model_crud');

		$this->load->model('Model_front');

        //Data

		$this->data = array(

			'title' => 'Checkout'

			);

		if($this->session->userdata('value_order_id')){
			$check_order = $this->Model_crud->select_where('order',array('order_id' => $this->session->userdata('value_order_id')));

			if(!empty($check_order)){
				if($check_order[0]['order_status'] == 'Completed'){

					if($this->session->userdata('guest_cart')){
						$this->session->unset_userdata('guest_cart');
					}

					if ($this->session->userdata('uid')) {
						$data_update = array(
							"cart" => "[]"
							);
						$this->Model_crud->update('customer', $data_update, array('customer_id' => $this->session->userdata('uid')));
					}

					$this->session->unset_userdata('value_order_id');
				}
			}

		}

		if($this->session->userdata('guest_cart')){
            $json = json_decode($this->session->userdata('guest_cart'));
            $new_json = array();

            foreach($json as $index => $value){

                $prod_disabled = $this->Model_crud->select_where('product', array(
                    "product_id" => $value->product_id,
                    "status"=> 0
                    ));
                if(!empty($prod_disabled)){
                    foreach($prod_disabled as $key => $row){
                        if($value->product_id != $row['product_id']){
                            $new_json[] = $value;
                        }
                    }
                } else {
                    $new_json[] = $value;
                }
            }
            if(!empty($new_json)){
                $json = json_encode($new_json);
                $this->session->set_userdata('guest_cart',$json);
            } else {
                $this->session->unset_userdata('guest_cart');   
            }
        }

        if ($this->session->userdata('uid')) {
            $json = array();
            $new_json = array();
            $customer = $this->Model_crud->select_where('customer', array('customer_id' => $this->session->userdata('uid')));

            if ($customer[0]['cart']) {

                $json = json_decode($customer[0]['cart'], true);

            }

            if(!empty($json)){
                foreach($json as $index => $value){

                    $prod_disabled = $this->Model_crud->select_where('product', array(
                        "product_id" => $value['product_id'],
                        "status"=> 0
                        ));

                    if(!empty($prod_disabled)){
                        foreach($prod_disabled as $key => $row){
                            if($value['product_id'] != $row['product_id']){
                                $new_json[] = $value;
                            }
                        }
                    } else {
                        $new_json[] = $value;
                    }
                }
            } else {
                $new_json = $json;
            }

            if(!empty($new_json)){
                $data_update = array(
                    "cart" => json_encode($new_json)
                    );
                $this->Model_crud->update('customer', $data_update, array('customer_id' => $this->session->userdata('uid')));
            } else {
                $data_update = array(
                    "cart" => "[]"
                    );
                $this->Model_crud->update('customer', $data_update, array('customer_id' => $this->session->userdata('uid'))); 
            }

        }

	}



	public function index() {
        //Data

		$data = $this->data;





        //Category

		$data['category'] = $this->Model_crud->select_where_order('category', array("status" => 1), 'sort_order', 'asc');



        //Cart

		$data['cart'] = array();

		if ($this->session->userdata('uid')) {

			$customer = $this->Model_crud->select_where('customer', array('customer_id' => $this->session->userdata('uid')));

			if ($customer[0]['cart']) {

				$data['cart'] = json_decode($customer[0]['cart'], true);

			}

		}



		/* Get Cart Start */

		$json = array();

		if ($this->session->userdata('uid')) {

			$customer = $this->Model_crud->select_where('customer', array('customer_id' => $this->session->userdata('uid')));

			if ($customer[0]['cart']) {

				$json = json_decode($customer[0]['cart'], true);

			}

		} else {

			if ($this->session->userdata('guest_cart')) {

				$json = json_decode($this->session->userdata('guest_cart'), true);

			}

		}


		

		$data['shipping'] = 0;

		if($this->session->userdata('value_shipping_country_id')){



			$query = $this->Model_crud->select_where('country',array('country_id' => $this->session->userdata('value_shipping_country_id')));



			if(!empty($query)){

				$data['shipping'] = $query[0]['shipping_price'];

			}



		}



        //Get product from cart

		if (count($json) > 0) {



			$products = array();

			$quantity = array();

			foreach ($json as $row) {

			

				$query = "SELECT p.*,pso.product_option_id,pso.value as option_name,psov.product_option_value_id,psov.price as price_option_value,psov.price_prefix as price_prefix_option_value,psov.weight as weight_option_value,psov.weight_prefix as weight_prefix_option_value,psov.value as option_detil_name, c.name as category_name, c.slug as category_slug , ps.price as special, ps.date_end FROM product p LEFT JOIN category c ON p.category_id = c.category_id LEFT JOIN product_special ps ON p.product_id = ps.product_id LEFT JOIN product_option pso ON p.product_id = pso.product_id LEFT JOIN product_option_value psov ON pso.product_option_id = psov.product_option_id WHERE p.product_id = " . $row['product_id'];
				$result_json = $this->Model_crud->select_query($query);



				if(!empty($result_json)){

					foreach($result_json as $index => $value){

						$userdata = '';


						if ($this->session->userdata('uid')) {

							$userdata = $this->session->userdata('uid');

						}

						if ($this->session->userdata('guest_cart')) {

							$userdata = 'guess';

						}

						$products['data_single'][$value['product_id']] = array(

							'product_id'    => $value['product_id'],

							'type'          => $value['type'],

							'item_id'       => $value['item_id'],

							'content'       => $value['content'],

							'weight'        => $value['weight'],

							'size'          => $value['size'],

							'shape'         => $value['shape'],

							'clarity'       => $value['clarity'],

							'treatment'     => $value['treatment'],

							'origin'        => $value['origin'],

							'price'         => $value['price'],

							'quantity'      => $value['quantity'],

							'name'          => $value['name'],

							'description'   => $value['description'],

							'image'         => $value['image'],

							'stock'         => $value['stock'],

							'slug'          => $value['slug'],

							'category_id'   => $value['category_id'],

							'featured'      => $value['featured'],

							'sort_order'    => $value['sort_order'],

							'status'        => $value['status'],

							'date_added'    => $value['date_added'],

							'date_modified' => $value['date_modified'],

							'category_name' => $value['category_name'],

							'category_slug' => $value['category_slug'],

							'special'       => $value['special'],

							'date_end'      => $value['date_end'],

							'customer'      => $userdata

							);



						if(!empty($value['product_option_value_id'])){



							if(!empty($customer)){



								foreach($customer as $i => $v){



									if(!empty($v['cart'])){



										$cart = json_decode($v['cart']);



										if(is_array($cart[0]->option) && !empty($cart[0]->option)){



											$cart_value = $cart[0]->option;



											foreach($cart_value as $ci => $vi){



												if($value['product_option_value_id'] == $vi){



													$products['data_option'][$value['product_option_value_id']] = array(

														'product_id'                => $value['product_id'],

														'product_option_id'         => $value['product_option_id'],

														'product_option_value_id'   => $value['product_option_value_id'],

														'option_name'               => $value['option_name'],

														'option_detil_name'         => $value['option_detil_name'],

														'price_option_value'        => $value['price_option_value'],

														'price_prefix_option_value' => $value['price_prefix_option_value'],

														'weight_option_value'       => $value['weight_option_value'],

														'weight_prefix_option_value'=> $value['weight_prefix_option_value']

														);



												}



											}



										}



									}



								}



							} else {


								



								if(!empty($json)){

									foreach($json as $index => $val){

										if(isset($val['option']) && is_array($val['option'])){

											foreach($val['option'] as $key => $row){

												if($value['product_option_value_id'] == $row){

													$products['data_option'][$value['product_option_value_id']] = array(

														'product_id'                => $value['product_id'],

														'product_option_id'         => $value['product_option_id'],

														'product_option_value_id'   => $value['product_option_value_id'],

														'option_name'               => $value['option_name'],

														'option_detil_name'         => $value['option_detil_name'],

														'price_option_value'        => $value['price_option_value'],

														'price_prefix_option_value' => $value['price_prefix_option_value'],

														'weight_option_value'       => $value['weight_option_value'],

														'weight_prefix_option_value'=> $value['weight_prefix_option_value']

														);

												}

											}

										}

									}

								}

							}



						}



					}



					if(is_array($products['data_single']) && !empty($products['data_single'])){

						$products['data_single'] = array_values($products['data_single']);

					}



					if( !empty($products['data_option']) && is_array($products['data_option'])){

						$products['data_option'] = array_values($products['data_option']);

					}



				}



            //$quantity[] = $row['quantity'];

				$quantity[] = 1;

			}



			$data['products'] = $products;

			$data['quantity'] = $quantity;



		} else {



			$data['products'] = FALSE;

			$data['quantity'] = FALSE;



		}

		/* Get Cart End */



		/* Get Paypal Setting Start */

		$data['business_email'] = $this->Model_crud->select_where('setting', array('setting_id'=>3));

		$data['notify_url'] = $this->Model_crud->select_where('setting', array('setting_id'=>4));

		$data['return_url'] = $this->Model_crud->select_where('setting', array('setting_id'=>5));

		$data['cancel_url'] = $this->Model_crud->select_where('setting', array('setting_id'=>6));

		$data['currency_code'] = $this->Model_crud->select_where('setting', array('setting_id'=>7));

		$data['checkout_logo'] = $this->Model_crud->select_where('setting', array('setting_id'=>8));

		/* Get Paypal Setting End */

		  // Check if Products have item or not'


        if(!$data['products']) {  // if product empty

        	redirect('checkout/cart');

        }



        //Navigation

        $data['header'] = $this->Model_front->get_menu_header();

        $data['bottom'] = $this->Model_front->get_menu_bottom();

        

    
        $data['load_view'] = 'catalog/checkout/paypal';

        $this->load->view('template/frontend', $data);

    }

    

    public function notify() {


    	$raw_post_data = file_get_contents('php://input');
    	$raw_post_array = explode('&', $raw_post_data);
    	$myPost = array();
    	foreach ($raw_post_array as $keyval) {
    		$keyval = explode ('=', $keyval);
    		if (count($keyval) == 2)
    			$myPost[$keyval[0]] = urldecode($keyval[1]);
    	}
// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
    	$req = 'cmd=_notify-validate';
    	if (function_exists('get_magic_quotes_gpc')) {
    		$get_magic_quotes_exists = true;
    	}
    	foreach ($myPost as $key => $value) {
    		if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
    			$value = urlencode(stripslashes($value));
    		} else {
    			$value = urlencode($value);
    		}
    		$req .= "&$key=$value";
    	}

// Step 2: POST IPN data back to PayPal to validate
    	$ch = curl_init('https://ipnpb.paypal.com/cgi-bin/webscr');
    	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
// In wamp-like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "https://curl.haxx.se/docs/caextract.html" and set
// the directory path of the certificate as shown below:
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
    	$status_paypal = $this->input->post('payment_status');

    	if(isset($status_paypal) && $status_paypal == 'Completed'){

    		$product_id_string = $this->input->post('custom');
        $product_id_string = rtrim($product_id_string, ","); // remove last comma
        // Explode the string, make it an array, then query all the prices out, add them up, and make sure they match the payment_gross amount
        $id_str_array = explode(",", $product_id_string); // Uses Comma(,) as delimiter(break point)
        $customer_id    = '';
        $order_id       = '';
        $fullAmount = 0;

        if(is_array($id_str_array) && !empty($id_str_array)){

        	foreach ($id_str_array as $key => $value) {

                $id_quantity_pair = explode("-", $value); // Uses Hyphen(-) as delimiter to separate product ID from its quantity
                //$product_id = $id_quantity_pair[0]; // Get the product ID
                $customer_id = $id_quantity_pair[1];
                $order_id = $id_quantity_pair[2];
            }

            $order = $this->Model_front->get_order_notify_paypal($order_id);
            /* INSERT CUSTOMER TRANSACTION & UPDATE STATUS ORDER */
            if(!empty($order_id)){

            	if(!empty($order)){

            		$data_transaction = array();

            		foreach($order as $index => $value){

            			$data_transaction = array(
            				'order_id' => $order_id,
            				'customer_id' => $customer_id,
            				'description_shipping' => $value['shipping_comment'],
            				'description_payment'  => $value['payment_comment'],
            				'amount' => $value['value'],
            				'data_added' => date('Y-m-d H:i:s')
            				);
            		}

            		if(!empty($data_transaction)){
            			$this->Model_crud->insert('customer_transaction',$data_transaction);
            		}

            	}

                //if($product_id_string){
            	$update_status = array(
            		'order_status' => 'Completed',
            		'review_slug'  => $this->tokenkeycomplete(),
            		'review_status'  => 'Pending'
            		);
            	$this->Model_crud->update('order',$update_status,array('order_id' => $order_id));

            	$title = 'Thank you for purchasing our product - Joscelyn Opal';
            	$query_order = $this->Model_crud->select_where('order',array('order_id' => $order_id));

            	if(!empty($query_order)){

            		$data_email = array();
            		foreach($query_order as $index => $value){

            			$country_name = $this->Model_crud->select_where('country', array('country_id'=>$value['shipping_country_id']));
            			$zone_name = $this->Model_crud->select_where('zone', array('zone_id'=>$value['zone_id']));
            			$total_with_shipping = $value['total'];
            			$shipping_price = 0;
            			$shipping_price = $country_name[0]['shipping_price'];
            			$shipping_country_name = '';
            			$shipping_country_name = $country_name[0]['name'];
            			$total_with_shipping = $value['total'] + $shipping_price;
            			$review_slug = base_url('review/'.$value['review_slug']);

            			$data_email = array(
            				'order_id' => $order_id,
            				'date_added' => $value['date_added'],
            				'payment_method' => $value['payment_method'],
            				'shipping_method' => $value['shipping_method'],
            				'telephone' => $value['telephone'],
            				'ip' => $value['ip'],
            				'order_status' => $value['order_status'],
            				'payment_comment' => $value['payment_comment'],
            				'shipping_comment' => $value['shipping_comment'],
            				'shipping_address' => $value['company'].'<br>'.$value['address_1'].'<br>'.$value['address_2'].'<br>'.$value['city'].' '.$value['postcode'].'<br>'.$zone_name[0]['name'].'<br>'.$country_name[0]['name'],
            				'total_amount' => $value['total'],
            				'shipping_country_name' => $shipping_country_name,
            				'shipping_price' => $shipping_price,
            				'total_amount' => $total_with_shipping
            				);

            			$query_order_product = $this->Model_crud->select_where('order_product',array('order_id' => $order_id));
            			$query_order_option = $this->Model_crud->select_where('order_option',array('order_id' => $order_id));

            			$this->_sendMail($value['email'], $title, $data_email, $query_order_product, $value['total'], $query_order_option,$review_slug);

            		}

            	}

            }

        }

    }

    if ( !($res = curl_exec($ch)) ) {
    	error_log("Got " . curl_error($ch) . " when processing IPN data");
    	curl_close($ch);
    	exit;
    }
    curl_close($ch);


}



public function tokenkeycomplete() {



	$chars = array(

		'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',

		'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',

		'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',

		'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',

		'0', '1', '2', '3', '4', '5', '6', '7', '8', '9');



	shuffle($chars);



	$num_chars = count($chars) - 1;

	$token = '';



    for ($i = 0; $i < $num_chars; $i++){ // <-- $num_chars instead of $len

    	$token .= $chars[mt_rand(0, $num_chars)];

    }



    return $token;

}

function _sendMail($seg1 = '', $seg2 = '', $seg3 = '', $seg4 = '', $seg5 = '',$seg6 = '',$seg7 = '') {
	$email = $seg1;
	$title = $seg2;
	$data_email = $seg3;
	$data_cart = $seg4;
	$total = $seg5;
	$option = $seg6;
	$review_slug = $seg7;
        //recipients
	$to = $email;

        //subject
	$subject = $title;

        // message
	$data = array();
	$data['title'] = $title;
	$data['store_url'] = base_url();
	$data['store_name'] = 'Joscelyn Opal';
	$data['logo'] = base_url('assets/images/general/logo_small.png');
	$data['text_greeting'] = 'Thank you for purchasing our product. Your payment has been processed. List of order:';
	$data['data_email'] = $data_email;
	$data['order_id'] = $data_email['order_id'];
	$data['option'] = $option;
	$data['shipping_country_name'] = $data_email['shipping_country_name'];
	$data['shipping_price'] = $data_email['shipping_price'];
	$data['date_added'] = date("d/m/Y", strtotime($data_email['date_added']));
	$data['payment_method'] = $data_email['payment_method'];
	$data['shipping_method'] = $data_email['shipping_method'];
	$data['email'] = $email;
	$data['telephone'] = $data_email['telephone'];
	$data['ip'] = $data_email['ip'];
	$data['order_status'] = $data_email['order_status'];
	$data['review_slug'] = $review_slug;

	$data['payment_comment'] = $data_email['payment_comment'];
	$data['shipping_comment'] = $data_email['shipping_comment'];

	$data['shipping_address'] = $data_email['shipping_address'];

	$data['products'] = $data_cart;
	$data['total'] = $total;
	$data['total_amount'] = $data_email['total_amount'];

	$message = $this->load->view('email/catalog_order',$data,TRUE);

        // To send HTML mail, the Content-type header must be set
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
	$headers .= 'From: Joscelynopal <store@joscelynopal.com>' . "\r\n";

        // Mail it
	mail($to, $subject, $message, $headers);
}

}