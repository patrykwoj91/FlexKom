<?php
class Synchronization extends CI_Controller{

	function __construct() 
	{
		parent::__construct();
		is_logged_in($this->session); //when accesing the page check for if user got session and is logged
	}

	function index()
	{
		$this->load->view('admin_panel/synchronization');
	}

	/*
	 * Baza dla funkcji synchronizujacej
	 */
	function synchronize()
	{
		$this->load->model('order_model');
		$this->load->model('product_model');

		$orders = $this->order_model->getNonSynchronized();
		$products_amount = $this->product_model->getNonSynchronized();
		
		if (isset($orders) || isset($products_amount))
		{
			$this->load->library ( 'JaxWsSoapClient' );
			
			try{
				$this->soap_client = new JaxWsSoapClient();
				
				foreach ($orders as $order)
				{
					$params = array (
							'produktID' => $order->produktID,
							'klientID' => NULL,
							'oddzialID' =>$order->oddzialID,
							'pracownikID' => $order->pracownikID
					);
						
					$result_orders = $this->soap_client->dodajZamowienie ( $params );
					
					if (strcmp($result_orders->return,'true') == 0)
					{
						$this->order_model->setSynchronized($order->zamowienieID);
					}
				}
				
				foreach ($products_amount as $product_amount)
				{
					$params = array (
							'oddzialID' => $product_amount->oddzialID,
							'produktID' => $product_amount->produktID,
							'ilosc' => $product_amount->ilosc
					);
					
					$result_amount = $this->soap_client->uaktualnijProduktyOddzialy ( $params );
					
					if (strcmp($result_amount->return,'true') == 0)
					{	
						$this->product_model->setSynchronized($product_amount->produktID,$product_amount->oddzialID);
					}
				}
				
				$data ['message'] = 'Synchronization success.';
				$this->load->view ( 'templates/messages/success', $data );
				return;
				
			}catch (Exception $e){
				$data ['message'] = 'SOAP Error: ' . $e->getMessage();
				$this->load->view ( 'templates/messages/error', $data );
				return;
			}
		}
		else {
			$data ['message'] = 'Nothing to synchronize.';
			$this->load->view ( 'templates/messages/warning', $data );
		}
	}
}
