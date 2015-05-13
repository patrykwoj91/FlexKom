<?php
class Product_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function getAll() {
		$query = $this->db->get ( 'produkty' );
		return $query->result ();
	}
	function getRemoteProducts() {
		$this->load->library ( 'JaxWsSoapClient' );
			
		$this->soap_client = new JaxWsSoapClient ();
			
		$result = $this->soap_client->getProdukty ();
		return $result->return;
	}
	
	function getRemoteCategoryProducts($categoryID, $start, $amount)
	{
		$this->load->library ( 'JaxWsSoapClient' );
			
		$this->soap_client = new JaxWsSoapClient ();
			
		$params = array (
				'producentID' => $categoryID,
				'poczatek' => $start,
				'ilosc' => $amount
		);
		
		$result = $this->soap_client->getProduktyProducent ($params);
		return $result->return;
	}
	
	function getByName($product_name) {
		$query = $this->db->get_where ( 'produkty', array (
				'nazwa' => $product_name 
		), 1 );
		if ($query->num_rows () > 0) {
			return $query->first_row ( 'array' );
		}
		return NULL;
	}
	function getLocalAvailability($product_name, $oddzialID) {
		$query = $this->db->get_where ( 'produkty', array (
				'nazwa' => $product_name 
		), 1 );
		
		if ($query->num_rows () > 0) {
			$result = $query->first_row ( 'array' );
			$product_id = $result ['produktID'];
			
			$this->db->select ( 'oddzialy.adres AS adres, oddzialy.miasto as miasto, produktyoddzialy.ilosc AS ilosc' );
			$this->db->from ( 'produktyoddzialy' );
			$this->db->join ( 'oddzialy', 'produktyoddzialy.oddzialID = oddzialy.oddzialID' );
			$this->db->where ( 'produktyoddzialy.oddzialID', $oddzialID );
			$this->db->where ( 'produktID', $product_id );
			$query = $this->db->get ();
			
			$result = $query->result ();
			return $result;
		}
	}
	function getRemoteAvailability($product_name, $oddzialID) {
		$query = $this->db->get_where ( 'produkty', array (
				'nazwa' => $product_name 
		), 1 );
		
		if ($query->num_rows () > 0) {
			$result = $query->first_row ( 'array' );
			$product_id = $result ['produktID'];
			
			$this->load->library ( 'JaxWsSoapClient' );
			
			$this->soap_client = new JaxWsSoapClient ();
			
			$params = array (
					'oddzialID' => $oddzialID,
					'produktID' => $product_id 
			);
			
			$result = $this->soap_client->getIloscProduktuInneOddzialy ( $params );
			return $result->return;
		}
	}
	
	function adjustLocalAmount($productID, $oddzialID, $new_amount)
	{
		$data = array(
				'ilosc' => $new_amount,
				'zsynchronizowano' => '0'
		);
		
		$this->db->where('produktID', $productID);
		$this->db->where('oddzialID', $oddzialID);
		$update = $this->db->update('produktyoddzialy', $data);
		return $update;
	}
	
	function getNonSynchronized()
	{
		$query = $this->db->get_where ( 'produktyoddzialy', array (
				'zsynchronizowano' => 0
		));
	
		if ($query->num_rows () > 0) {
			return $query->result ();
		}
		return NULL;
	}
	
	function setSynchronized($productID, $oddzialID)
	{
		$data = array(
				'zsynchronizowano' => 1
		);
		
		$this->db->where('produktID', $productID);
		$this->db->where('oddzialID', $oddzialID);
		$update = $this->db->update('produktyoddzialy', $data);
		return $update;
	}
	
	function getByID($productID)
	{
		$this->load->library ( 'JaxWsSoapClient' );
		$this->soap_client = new JaxWsSoapClient ();
			
		$params = array (
				'produktID' => $productID
		);
			
		$result = $this->soap_client->getProdukt ( $params );
		return $result->return;
	}
	
	function getSpecialOfferts()
	{
		$this->load->library ( 'JaxWsSoapClient' );
		$this->soap_client = new JaxWsSoapClient ();
			
		$result = $this->soap_client->get3NajgorzejSprzedajaceProdukty();
		return $result->return;
	}
}