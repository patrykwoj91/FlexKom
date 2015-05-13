<?php
class Item extends CI_Controller {
	function __construct() {
		parent::__construct ();
	}
	function index() {
		$this->load->model ( 'product_model' );
		
		$productID = $this->input->post ( 'productID' );
		$results = $this->product_model->getByID ( $productID );
		
		$data ['product'] = $results;
		$data ['productID'] = $productID;
		$this->load->view ( 'store/item', $data );
	}
	function addToCart() {
		$is_logged_in = $this->session->userdata( 'is_logged_in' );
		
		$productID = $this->input->post ( 'productID' );
		$amount = $this->input->post ( 'amount' );
		$this->load->model ( 'product_model' );
		
		if (! isset ( $is_logged_in ) || $is_logged_in != TRUE) // if is_logged_in is not set or not true - variable is part of session - then do not pass
		{
			
			$results = $this->product_model->getByID ( $productID );
			
			$data ['product'] = $results;
			$data ['productID'] = $productID;
			$data ['scripting'] = "<script> $('#login_click').click(); </script>";
			$this->load->view ( 'store/item', $data );
			
		} else {
			// dodawanie do koszyka sesji
			
			$results = $this->product_model->getByID ( $productID );
			
			$cart_data = array (
					'id' => intval ( $productID ),
					'qty' => intval ( $amount ),
					'price' => floatval ( $results->cena ),
					'name' => $results->nazwaProduktu 
			);
			
			$this->cart->insert ( $cart_data );
			
			$this->load->view ( 'store/cart');
		}
	}
}