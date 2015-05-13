<?php
class New_order extends CI_Controller {
	function __construct() {
		parent::__construct ();
		is_logged_in ( $this->session ); // when accesing the page check for if user got session and is logged
	}
	function index() {
		$this->load->model ( 'product_model' );
		
		$results = $this->product_model->getAll ();
		
		$data ['rows'] = $results;
		$data ['num_rows'] = count ( $results );
		
		$this->load->view ( 'admin_panel/new_order', $data );
	}
	function add_product() {
		$this->load->model ( 'product_model' );
		$this->load->model ( 'user_model' );
		$this->load->model ( 'employee_model' );
		
		$amount = $this->input->post ( 'amount' );
		$product = $this->product_model->getByName ( $this->input->post ( 'product_name' ) );
		
		$user = $this->user_model->getByUsername($this->session->userdata('username'));
		$employee = $this->employee_model->getByUserID($user[uzytkownikID]);
		
		$availability = $this->product_model->getLocalAvailability($product[nazwa], $employee[oddzialID]);
		$store_amount = $availability[0]->ilosc;
		
		if (intval($store_amount) >= intval($amount))
		{
			//dodawanie do koszyka sesji
			$cart_data = array(
					'id'      => intval($product[produktID]),
					'qty'     => intval($amount),
					'price'   => floatval($product[cena]),
					'name'    => $product[nazwa]
			);
		
			$this->cart->insert($cart_data);
			$myLastElement = end(array_values($this->cart->contents()));
			$this->load->view('admin_panel/product_list_row', $myLastElement );
		}
		else
		{
			echo "brak takiej ilosci - cos tu wyswietlic";
		}
	}
	function add() {
		$this->load->model ( 'product_model' );
		$this->load->model ( 'order_model' );
		$this->load->model ( 'employee_model' );
		$this->load->model ( 'user_model' );
		
		$items = $this->cart->contents();
		
		$user = $this->user_model->getByUsername($this->session->userdata('username'));
		$employee = $this->employee_model->getByUserID($user[uzytkownikID]);
		
		foreach ($items as $item)
		{
			$availability = $this->product_model->getLocalAvailability($item[name],$employee[oddzialID]);
			$old_amount = $availability[0]->ilosc;
			
			if (intval($old_amount) >= intval($item[qty]))
			{
				for ($i = 0 ; $i < intval($item[qty]) ; $i++)
				{
					$this->order_model->addLocalOrder($item[id], $employee[pracownikID], $employee[oddzialID]);
				}
				$new_amount = intval($old_amount) -  intval($item[qty]);
				$this->product_model->adjustLocalAmount($item[id],$employee[oddzialID], intval($new_amount));
			}
		}
		
		$this->cart->destroy();	
	}
}