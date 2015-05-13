<?php
class User_model extends CI_Model {
	function validate() // check if user with given login and password exists in database
{
		$this->db->where ( 'login', $this->input->post ( 'username' ) );
		$this->db->where ( 'haslo', md5 ( $this->input->post ( 'password' ) ) );
		$query = $this->db->get ( 'uzytkownicy' );
		
		if ($query->num_rows == 1) {
			return true;
		}
	}
	
	function remoteValidate() // check if user with given login and password exists in database
	{
		$this->load->library ( 'JaxWsSoapClient' );
		
		$this->soap_client = new JaxWsSoapClient ();
		
		$params = array (
				"login" => $this->input->post ( 'username' ),
				"haslo" =>  strval(md5( $this->input->post ( 'password' )))
		);
		
		$result = $this->soap_client->loginHaslo ( $params );
		
		/*echo "<pre>";
		print_r($params);
		print_r($result);
		echo "</pre>";*/
		
		return $result->return;
	}
	
	function remoteUserExists($username) {
		$this->load->library ( 'JaxWsSoapClient' );
		
		$this->soap_client = new JaxWsSoapClient ();
		
		$params = array (
				"username" => $username 
		);
		
		$result = $this->soap_client->sprawdzLogin ( $params );	
		
		return $result->return;
	}
	function create_member() // insert form data to uzytkownicy table - creates new member/user
	{
		$new_member_insert_data = array (
				'imie' => $this->input->post ( 'first_name' ),
				'nazwisko' => $this->input->post ( 'last_name' ),
				'email' => $this->input->post ( 'email_address' ),
				'login' => $this->input->post ( 'username' ),
				'haslo' => md5 ( $this->input->post ( 'password' ) ) 
		);
		
		$insert = $this->db->insert ( 'uzytkownicy', $new_member_insert_data );
		return $insert;
	}
	
	function getByUsername($username)
	{
		$query = $this->db->get_where ( 'uzytkownicy', array (
				'login' => $username) );

		if ($query->num_rows () > 0) {
			return $query->first_row ( 'array' );
		}
		return NULL;
	}
}
