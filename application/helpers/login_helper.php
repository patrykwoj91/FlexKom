<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('is_logged_in'))
{
	function is_logged_in(&$session) //check in session if that user is logged_in
	{
		$is_logged_in = $session->userdata('is_logged_in');
	
		if (!isset($is_logged_in) || $is_logged_in != TRUE) // if is_logged_in is not set or not true - variable is part of session - then do not pass
		{
			echo 'You don\'t have permission to access this page.  <a href="../../FlexKom">Login</a>';
			die();
		}
	}
}