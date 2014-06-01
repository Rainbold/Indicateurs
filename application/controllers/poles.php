<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poles extends CI_Controller {

	// Var used to pass data to the views
	var $data = array();
	var $navbar = false;

	// Constructor
	function __construct()
	{
		parent::__construct();
	}

	// Adds a Pole
	public function add($id = 0)
	{
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		$this->load->library('session');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());
		else
		{
    		$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('poles_model', 'polesManager');
			
			// Rules on the different datas submitted to avoid security exploits
			$this->form_validation->set_rules('nom', '"Nom"', 'trim|required|encode_php_tags|xss_clean');
			$this->form_validation->set_rules('parent', '"Parent"', 'trim|required|encode_php_tags|xss_clean');
			if( $this->form_validation->run() )
			{
				$nom = $this->input->post('nom');
				$parent = $this->input->post('parent');

				$this->polesManager->poles_add($nom, $parent);
				redirect(site_url(array('welcome', 'index', $this->polesManager->poles_get_last_id())));
			}

			$this->data['navbar_display'] = false;
			$this->data['views'] = array();

			$dataPoleAdd = array('poles' => $this->polesManager->poles_get_list(), 'parent' => $id);
			array_push($this->data['views'], array('Poles/add', $dataPoleAdd) );
			$this->load->view('Misc/template', $this->data);
		}
	}

	public function edit($id)
	{
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		$this->load->library('session');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());
		else
		{
    		$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('poles_model', 'polesManager');
			
			// Rules on the different datas submitted to avoid security exploits
			$this->form_validation->set_rules('nom', '"Nom"', 'trim|required|encode_php_tags|xss_clean');
			$this->form_validation->set_rules('parent', '"Parent"', 'trim|required|encode_php_tags|xss_clean');
			$this->form_validation->set_rules('id', '"Id"', 'trim|required|encode_php_tags|xss_clean');
			if( $this->form_validation->run() )
			{
				$nom = $this->input->post('nom');
				$parent = $this->input->post('parent');
				$id = $this->input->post('id');

				$this->polesManager->poles_edit($id, $nom, $parent);
				redirect(site_url(array('welcome', 'index', $id)));
			}

			$this->data['navbar_display'] = false;
			$this->data['views'] = array();

			$dataPoleAdd = array('poles' => $this->polesManager->poles_get_list($id), 'pole_edit' => $this->polesManager->poles_get_info($id));
			array_push($this->data['views'], array('Poles/add', $dataPoleAdd) );
			$this->load->view('Misc/template', $this->data);
		}
	}

	public function del($id)
	{
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		$this->load->library('session');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());
		else
		{
			$this->load->model('poles_model', 'polesManager');
			$this->load->model('ind_noms_model', 'indNomsManager');
			
			if($this->indNomsManager->ind_get_list_nb($id) <= 0) {
				$parent = $this->polesManager->poles_get_info($id)->parent;
				$this->polesManager->poles_del($id);
				redirect(site_url(array('welcome', 'index', $parent)));
			}
			redirect(site_url(array('welcome', 'index', $id)));
		}
	}
}
