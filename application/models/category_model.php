<?php
class Category_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function getRemoteCategories() {
		$this->load->library ( 'JaxWsSoapClient' );
		
		$this->soap_client = new JaxWsSoapClient ();
		
		$result = $this->soap_client->getKategoriaProducenci(array('kategoria' => 'Telefony Komorkowe'));
		return $result->return;
	}
}