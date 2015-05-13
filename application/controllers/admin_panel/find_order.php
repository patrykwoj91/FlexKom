<?php
class Find_order extends CI_Controller {
	function __construct() {
		parent::__construct ();
		is_logged_in ( $this->session ); // when accesing the page check for if user got session and is logged
	}
	function index() {
		$this->load->view ( 'admin_panel/find_order' );
	}
	
	/**
	 * Funkcja generuje tabele zamowien danego uzytkownika
	 */
	function getByUsername() {
		// naglowek tabeli
		$data ['fields'] = array (
				'zamowienieID' => 'Order ID',
				'produktID' => 'Product ID',
				'status' => 'Status',
				'dataZlozeniaZamowienia' => 'Order Date' 
		);
		
		$this->load->model ( 'order_model' );
		$this->load->model ( 'user_model' );
		
		// uzytkownik pobrany z formularza
		$username = $this->input->post ( 'username' );
		
		// jesli wpisano uzytkownika
		if (isset ($username)) 
		{
			try 
			{
				$username_exists = $this->user_model->remoteUserExists( $username );
			}
			catch (Exception $e) 
			{
				$data ['message'] = 'SOAP Error: ' . $e->getMessage();
				$this->load->view ( 'templates/messages/error', $data );
				return;
			}
		}
		
		if ($username_exists) 
		{
			try 
			{
				$results = $this->order_model->getRemoteUserOrders ( $username );
			}
			catch (Exception $e)
			{
				$data ['message'] = 'SOAP Error: ' . $e->getMessage();
				$this->load->view ( 'templates/messages/error', $data );
			}
			
			if (! isset ( $results )) 
			{
				$data ['message'] = 'No orders for username ' . $username;
				$this->load->view ( 'templates/messages/warning', $data );
			} 
			else 
			{
				$data ['rows'] = $results;
				$data ['num_results'] = count ( $results );
				$data ['table_name'] = 'find_order_table';
				$data ['message'] = 'Found ' . '<strong>'.count( $results ).'</strong>' . ' orders for username ' . '<strong>'.$username.'</strong>';			
				$this->load->view ( 'templates/messages/success', $data );
				$this->load->view ( 'templates/table', $data );
			}
			
			 /*echo "<pre>";
			 print_r($results);
			 echo "</pre>";*/
		} 
		else 
		{
			$data ['message'] = 'Given username do not exists in database. Try again.';
			$this->load->view ( 'templates/messages/error', $data );
		}
	}
}