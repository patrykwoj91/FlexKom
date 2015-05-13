<?php
class User_login extends CI_Controller {
	function __construct() {
		parent::__construct ();
	}
	function index() {
		$this->load->view ( 'store/user_login' );
	}
	public function validateCredentials() {
		$this->load->library ( 'form_validation' );
		
		$this->form_validation->set_rules ( 'username', 'Username', 'required|trim|max_length[50]|xss_clean' );
		$this->form_validation->set_rules ( 'password', 'Password', 'required|trim|max_length[200]|xss_clean|callback_checkCredentials' );
		
		if ($this->form_validation->run () == TRUE) {
			
			// add some fields to session , username, is_logged_in to access it later TODO: add user id to session to know what user is logged
			$data = array (
					'username' => $this->input->post ( 'username' ),
					'is_logged_in' => true 
			);
			
			$this->session->set_userdata ( $data );
			
			//TODO: powoduje ze login/logout wczytuje sie w modal - possible fix: 
			//	- zamiast podmieniac fragment z loginem/logoutem refresh metoda load z jQuery
			// - funkcja modal hide zamykac modal po zalogowaniu ? - jak okreslic czy zalogowano? - jak sie nie da to zostawic alerty i reczne zamykanie
			
			//echo '<p class="alert alert-success" role="alert"> <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>  You have been logged in.</p>';
			
			if (! $this->input->is_ajax_request ()) {
				 redirect ( 'home' );
			} else {
				$data['username'] = $this->session->userdata('username');
				$this->load->view('store/login_part', $data);
			}
		} else {
			echo validation_errors ( '<p class="alert alert-danger" role="alert"> <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ' ); // return login page again if validation false
		}
	}
	function checkCredentials() { // user user's model validate() to check credentials
	                              // TODO: Walidacja z webservice
		$this->load->model ( 'user_model' ); // load model
		$query = $this->user_model->remoteValidate (); // user function
		
		if ($query) { // if user's credentials valid
			return TRUE;
		} else {
			$this->form_validation->set_message ( 'checkCredentials', 'Sorry login or password is not correct.' );
			return FALSE;
		}
	}
	function logout() {
		$this->cart->destroy();
		$this->session->sess_destroy ();
		redirect ( 'store/home' );
	}
	function signup() { // if signup is accessed, load signup_view
		$this->load->view ( 'includes/header' );
		$this->load->view ( 'signup_form' );
		$this->load->view ( 'includes/footer' );
	}
	function create_member() { // if create_member is used (button that submits signup_form, load form validation
		$this->load->library ( 'form_validation' );
		// field name, error message, validation rules
		
		$this->form_validation->set_rules ( 'first_name', 'Name', 'trim|required' );
		$this->form_validation->set_rules ( 'last_name', 'Last Name', 'trim|required' );
		$this->form_validation->set_rules ( 'email_address', 'Email Address', 'trim|required|valid_email' );
		
		$this->form_validation->set_rules ( 'username', 'Username', 'trim|required|min_lenght[4]|max_lenght[15]' );
		$this->form_validation->set_rules ( 'password', 'Password', 'trim|required|min_lenght[5]|max_lenght[32]' );
		$this->form_validation->set_rules ( 'confirm_password', 'Password Confirmation', 'trim|required|matches[password]' );
		
		if ($this->form_validation->run () == FALSE) { // run validation on form fields
			$this->signup (); // if invalid move again to signup
		} else {
			$this->load->model ( 'user_model' ); // if valid user user's model function to add member to database and load successful message view
			if ($query = $this->user_model->create_member ()) {
				$this->load->view ( 'includes/header' );
				$this->load->view ( 'signup_successful' );
				$this->load->view ( 'includes/footer' );
			} else {
				$this->load->view ( 'signup_form' ); // if database connection wasnt set or there was some problem adding a field to database move to signup form again
			}
		}
	}
}