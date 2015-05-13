<?php
class Home extends CI_Controller{
	
	function __construct() 
	{
		parent::__construct();
		is_logged_in($this->session); //when accesing the page check for if user got session and is logged
	}
	
	function index() 
	{
		$this->load->view('templates/header');
		$data['username'] = $this->session->userdata('username');
		$this->load->view('templates/navbar', $data);
		$this->load->view('admin_panel/home');
		$this->load->view('templates/footer');
	}
}