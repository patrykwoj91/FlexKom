<?php

class Employee_model extends CI_Model {
	function getByUserID ($userID)
	{
		$query = $this->db->get_where ( 'pracownicy', array (
				'uzytkownikID' => $userID ));
		
		if ($query->num_rows () > 0) {
			return $query->first_row ( 'array' );
		}
		return NULL;
	}
}
