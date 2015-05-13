<?php

class Login extends CI_Controller {
	
	function index()
	{
		$this->load->view('login');	
	}
	
	public function validateCredentials()
	{
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('username','Username', 'required|trim|max_length[50]|xss_clean');
		$this->form_validation->set_rules('password','Password', 'required|trim|max_length[200]|xss_clean|callback_checkCredentials');
	
		if($this->form_validation->run() == TRUE){
			
			//add some fields to session , username, is_logged_in to access it later TODO: add user id to session to know what user is logged	
			$data = array (
					'username' => $this->input->post('username'),
					'is_logged_in' => true
			);
				
			$this->session->set_userdata($data);
	
			echo '<p class="alert alert-success" role="alert"> <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>  You have been logged in.</p>';

		  	if ( !$this->input->is_ajax_request())
    		{
        		redirect('admin_panel/home');
    		}
    		else
    		{
    			echo '<span class="redirect"> admin_panel/home </span>';
    		}
			
			
		}
		else 
		{	
			echo validation_errors('<p class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ');  // return login page again if validation false
		}
	}
	
	function checkCredentials() //user user's model validate() to check credentials
	{
		$this->load->model('user_model'); //load model
		$query = $this->user_model->validate(); // user function
		
		if ($query) //if user's credentials valid
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('checkCredentials', 'Sorry login or password is not correct.');
			return FALSE;
		}
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('main');
	}
}