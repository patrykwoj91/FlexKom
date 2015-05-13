<?php
class Client_model extends CI_Model {
	function getByUserID ($userID)
	{
		$this->load->library ( 'JaxWsSoapClient' );
			
		$this->soap_client = new JaxWsSoapClient ();
			
		$params = array (
				'uzytkownikID' => $userID
		);
		
		$result = $this->soap_client->getKlientPrzezUzytkownikID ($params);
		
		
		return $result->return;
	}
	
}
