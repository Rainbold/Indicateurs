<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ind extends CI_Controller {

	// Var used to pass data to the views
	var $data = array();
	var $navbar = false;

	// Constructor
	function __construct()
	{
		parent::__construct();
	}

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
			$this->load->model('ind_noms_model', 'indNomsManager');
			$this->load->model('poles_model', 'polesManager');
			
			// Rules on the different datas submitted to avoid security exploits
			$this->form_validation->set_rules('nom', '"Nom"', 'trim|required|encode_php_tags|xss_clean');
			$this->form_validation->set_rules('parent', '"Parent"', 'trim|required|encode_php_tags|xss_clean');
			if( $this->form_validation->run() )
			{
				$nom = $this->input->post('nom');
				$parent = $this->input->post('parent');

				$this->indNomsManager->ind_add($nom, $parent);
				
				redirect(site_url(array('ind', 'display', $this->indNomsManager->ind_get_last_id()->id)));
			}

			$this->data['navbar_display'] = false;
			$this->data['views'] = array();

			$dataPoleAdd = array('poles' => $this->polesManager->poles_get_list(), 'parent' => $id);
			array_push($this->data['views'], array('Ind/add', $dataPoleAdd) );
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
			$this->load->model('ind_noms_model', 'indNomsManager');
			
			// Rules on the different datas submitted to avoid security exploits
			$this->form_validation->set_rules('nom', '"Nom"', 'trim|required|encode_php_tags|xss_clean');
			$this->form_validation->set_rules('parent', '"Parent"', 'trim|required|encode_php_tags|xss_clean');
			$this->form_validation->set_rules('id', '"Id"', 'trim|required|encode_php_tags|xss_clean');
			if( $this->form_validation->run() )
			{
				$nom = $this->input->post('nom');
				$parent = $this->input->post('parent');
				$id = $this->input->post('id');

				$this->indNomsManager->ind_edit($id, $nom, $parent);
				redirect(site_url(array('welcome', 'index', $parent)));
			}

			$this->data['navbar_display'] = false;
			$this->data['views'] = array();

			$dataPoleAdd = array('poles' => $this->polesManager->poles_get_list(), 'ind_edit' => $this->indNomsManager->ind_get_info($id));
			array_push($this->data['views'], array('Ind/add', $dataPoleAdd) );
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
			$this->load->model('ind_noms_model', 'indNomsManager');
			$this->load->model('ind_model', 'indManager');
			
			$parent = $this->indNomsManager->ind_get_info($id)->parent;
			if($this->indManager->ind_get_nb_by_parent($id) <= 0)
				$this->indNomsManager->ind_del($id);
			redirect(site_url(array('welcome', 'index', $parent)));

		}
	}

	public function display($id, $year=-1)
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
			$this->load->model('ind_model', 'indManager');

			if($year < 1987)
				$year = date('Y', time());

			$this->data['navbar_display'] = true;
			$this->data['views'] = array();

			$indInf = $this->indNomsManager->ind_get_info($id);

			$this->data['navbar'] = $this->polesManager->poles_get_nav($indInf->parent);
			$dataInd = array('ind'=>$indInf, 'annee'=>$year, 'list'=>$this->indManager->ind_get_list($id, $year));


			array_push($this->data['views'], array('Ind/display', $dataInd) );
			$this->load->view('Misc/template', $this->data);
		}
	}

	public function add_val($id, $annee, $mois)
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
			$this->load->model('ind_noms_model', 'indNomsManager');
			$this->load->model('ind_model', 'indManager');
			$this->load->model('poles_model', 'polesManager');
			
			// Rules on the different datas submitted to avoid security exploits
			$this->form_validation->set_rules('valeur', '"Valeur"', 'trim|required|encode_php_tags|xss_clean|integer');
			$this->form_validation->set_rules('parent', '"Parent"', 'trim|required|encode_php_tags|xss_clean|integer');
			$this->form_validation->set_rules('mois', '"Mois"', 'trim|required|encode_php_tags|xss_clean|integer');
			$this->form_validation->set_rules('annee', '"Annee"', 'trim|required|encode_php_tags|xss_clean|integer');
			if( $this->form_validation->run() )
			{
				$valeur = $this->input->post('valeur');
				$parent = $this->input->post('parent');
				$mois = $this->input->post('mois');
				$annee = $this->input->post('annee');

				$this->indManager->ind_add($valeur, $parent, $mois, $annee);
				$last = $this->indManager->ind_get_last_id();
				redirect(site_url(array('ind', 'display', $last->parent, $last->annee)));
;			}

			$this->data['navbar_display'] = false;
			$this->data['views'] = array();

			$dataPoleAdd = array('parent' => $id);
			array_push($this->data['views'], array('Ind/add_val', $dataPoleAdd) );
			$this->load->view('Misc/template', $this->data);
		}
	}

	public function del_val($id)
	{
		// If the user is not connected, then he is redirected to the main page
		$this->load->helper('url');
		$this->load->library('session');
		if( !$this->session->userdata('logged_in') )
			redirect(base_url());
		else
		{
			$this->load->model('ind_model', 'indManager');
			
			$parent = $this->indManager->ind_get_info($id)->parent;
			$annee = $this->indManager->ind_get_info($id)->annee;
			$this->indManager->ind_del($id);
			redirect(site_url(array('ind', 'display', $parent, $annee)));
		}
	}

	public function edit_val($id)
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
			$this->load->model('ind_model', 'indManager');
			
			// Rules on the different datas submitted to avoid security exploits
			$this->form_validation->set_rules('valeur', '"Valeur"', 'trim|required|encode_php_tags|xss_clean|integer');
			$this->form_validation->set_rules('id', '"Id"', 'trim|required|encode_php_tags|xss_clean|integer');
			if( $this->form_validation->run() )
			{
				$valeur = $this->input->post('valeur');
				$id = $this->input->post('id');

				$this->indManager->ind_edit($id, $valeur);
			
				$parent = $this->indManager->ind_get_info($id)->parent;
				$annee = $this->indManager->ind_get_info($id)->annee;
				redirect(site_url(array('ind', 'display', $parent, $annee)));
			}

			$this->data['navbar_display'] = false;
			$this->data['views'] = array();

			$dataPoleAdd = array('ind_edit' => $this->indManager->ind_get_info($id));
			array_push($this->data['views'], array('Ind/add_val', $dataPoleAdd) );
			$this->load->view('Misc/template', $this->data);
		}
	}
}
