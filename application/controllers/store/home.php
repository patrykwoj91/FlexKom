<?php
class Home extends CI_Controller{
	
	function __construct() 
	{
		parent::__construct();
	}
	
	function index() 
	{
		$this->load->model('category_model');
		
		$results = $this->category_model->getRemoteCategories();
		
		$this->load->view('templates/header');
		$data['username'] = $this->session->userdata('username');
		$this->load->view('store/navbar', $data);
		$data ['categories'] = $results;
		$data ['num_categories'] = count ( $results );
		$this->load->view('store/home', $data);
		$this->load->view('templates/footer');
	}
	
	function products()
	{
		$categoryID = $this->input->post('categoryID');
		$this->load->model('product_model');
		$this->load->library('pagination');
		
		$results = $this->product_model->getRemoteCategoryProducts($categoryID, '0', '100000');
		
		/*echo "<pre>";
		print_r($results);
		echo "</pre>";*/
		
		$config["base_url"] = base_url() . "store/home/products";
		$config["total_rows"] = count ( $results );
		$config["per_page"] = 9;
		$config["uri_segment"] = 4;
		$choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = round($choice);
		
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = "<li class='pagination_page_link'>";
		$config['num_tag_close'] = "</li>";
		$config['cur_tag_open'] = "<li class='disabled pagination_page_link'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li class='pagination_page_link'> ";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li class='pagination_page_link'>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li class='pagination_page_link'>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li class='pagination_page_link'>";
		$config['last_tagl_close'] = "</li>";
		
		$this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["products"] = $this->product_model->getRemoteCategoryProducts($categoryID, $page, $config["per_page"]);
        $data["links"] = $this->pagination->create_links();
        $data["catID"] = $categoryID;
        
		$this->load->view("store/products", $data);
	}
	
	function special_offerts(){
		$this->load->model('product_model');
		
		$results = $this->product_model->getSpecialOfferts();
;		
		$this->load->view("store/products");
	}
}