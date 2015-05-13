<?php
class Product_availability extends CI_Controller {
	function __construct() {
		parent::__construct ();
		is_logged_in ( $this->session ); // when accesing the page check for if user got session and is logged
	}
	function index() {
		$this->load->view ( 'admin_panel/product_availability' );
	}
	
	/**
	 * Funkcja zwraca dostêpnosc (ilosc) produktu w oddzia³ach.
	 * Wykorzystuje po³¹czenie z centralna baza danych aby wyciagnac ilosc produktów w oddzia³ach z bazy centralnej.
	 * Iloœæ produktu we w³asnym oddziale pobierana jest z bazy lokalnej.
	 */
	function getByName() {
		// naglowek tabeli
		$data ['fields'] = array (
				'adres' => 'Address',
				'miasto' => 'City',
				'ilosc' => 'Amount' 
		);
		$this->load->model ( 'product_model' );
		
		$product_name = $this->input->post ( 'product_name' );
		
		/*echo "<pre>";
		 print_r($product_name);
		 echo "</pre>";*/
		
		if (isset ( $product_name )) {
			$product_exists = $this->product_model->getByName ( $product_name );
		}
		
		if (isset ( $product_exists )) {
			$this->load->model( 'user_model' );
			$this->load->model( 'employee_model' );
			
			$user = $this->user_model->getByUsername($this->session->userdata('username'));
			$employee = $this->employee_model->getByUserID($user[uzytkownikID]);
			
			$local = $this->product_model->getLocalAvailability ( $product_name, $employee[oddzialID] );
			$results = $local;
			try {
				$remote = $this->product_model->getRemoteAvailability ( $product_name, $employee[oddzialID] );
			} catch ( Exception $e ) {
				$data ['message'] = 'SOAP Error: ' . $e->getMessage () . '. <strong>Loading only local data. </strong>';
				$this->load->view ( 'templates/messages/error', $data );
			}
			
			if (isset ( $remote )) {
				$results = array_merge ( $local, $remote );
			}
			
			if (count ( $results ) == 0) {
				$data ['message'] = 'Given product is unavailable.';
				$this->load->view ( 'templates/messages/warning', $data );
			} else {
				$data ['rows'] = $results;
				$data ['num_results'] = count ( $results );
				$data ['table_name'] = 'product_availability';
				if (isset ($remote))
				{
					$data ['message'] = 'Showing <strong>local</strong> and <strong> remote </strong> availability for product ' . '<strong>' . $product_name . '</strong>';
					$this->load->view ( 'templates/messages/success', $data );
				}
				$this->load->view ( 'templates/table', $data );
			}
		}
		else
		{
			$data ['message'] = 'Given product name do not exists in database. Try again.';
			$this->load->view ( 'templates/messages/error', $data );
		}
	}
}