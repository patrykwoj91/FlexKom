<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/navbar');
		$this->load->view('main');
		$this->load->view('templates/footer');
	}
}