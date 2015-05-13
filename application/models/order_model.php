<?php
class Order_model extends CI_Model {
	function getRemoteUserOrders($username) {
		$this->load->library ( 'JaxWsSoapClient' );
		
		$this->soap_client = new JaxWsSoapClient ();
		
		$params = array (
				"username" => $username 
		);
		
		$result = $this->soap_client->getZamowieniaUzytkownika ( $params );
		return $result->return;
	}
	function addLocalOrder($productID, $employeeID, $oddzialID)
	{
		$data = array(
				'produktID' => $productID ,
				'pracownikID' => $employeeID,
				'oddzialID' => $oddzialID,
				'status' => 'oczekujacy',
				'zsynchronizowano' => '0'
		);
		
		$insert = $this->db->insert('zamowienia', $data);
		return $insert;
	}
	
	function addRemoteOrder($productID, $clientID, $oddzialID, $employeeID)
	{
		$this->load->library ( 'JaxWsSoapClient' );
		
		$this->soap_client = new JaxWsSoapClient ();
		
		$params = array (
				'produktID' => $productID,
				'klientID' => $clientID,
				'oddzialID' => $oddzialID,
				'pracownikID' => $employeeID
		);
		
		$result = $this->soap_client->dodajZamowienie ( $params );
		return $result->return;
	}
	function getNonSynchronized()
	{
		$query = $this->db->get_where ( 'zamowienia', array (
				'zsynchronizowano' => 0
		));
		
		if ($query->num_rows () > 0) {
			return $query->result ();
		}
		return NULL;
	}
	
	function setSynchronized($orderID)
	{
		$data = array(
				'zsynchronizowano' => '1'
		);
	
		$this->db->where('zamowienieID', $orderID);
		$update = $this->db->update('zamowienia', $data);
		return $update;
	}
	
}