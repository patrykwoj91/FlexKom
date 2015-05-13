<?php
class Cart extends CI_Controller {
	function __construct() {
		parent::__construct ();
	}
	function index() {
		$this->load->view ( 'store/cart' );
	}
	
	function add_order() {
		$this->load->model ( 'client_model' );
		$this->load->model ( 'user_model' );
		$this->load->model ( 'order_model' );
		
		$items = $this->cart->contents();
	
		$user = $this->user_model->getByUsername($this->session->userdata('username'));
		$client = $this->client_model->getByUserID($user[uzytkownikID]);
	
		foreach ($items as $item)
		{		
				for ($i = 0 ; $i < intval($item[qty]) ; $i++)
				{		
					$result_add_order = $this->order_model->addRemoteOrder ( $item[id], $client->klientID, NULL, NULL );
				}
		}
		$this->cart->destroy();
		$this->load->view('templates/success_modal');
	}
}