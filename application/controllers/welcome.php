<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	// Var used to pass data to the views
	var $data = array();
	var $username = 'admin';
	var $password = 'adminpass';

	// Constructor
	function __construct()
	{
		parent::__construct();
	}

	// Homepage's method
	public function index($id = 0)
	{
		$this->data['views'] = array();
		$this->data['navbar_display'] = true;

    	$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->load->model('poles_model', 'polesManager');

		$formSubmit = $this->input->post('submitForm');

		// Telling apart the signout and signin forms
		if( $formSubmit == 'formSignOut' )
		{
			$this->session->sess_destroy();
		}
		elseif( $formSubmit == 'formSignIn' ) 
		{
			// If the user is not already logged in...
			if( !$this->session->userdata('logged_in') )
			{
				// Rules on the different datas submitted to avoid security exploits
				$this->form_validation->set_rules('username', '"Username"', 'trim|required|encode_php_tags|xss_clean');
				$this->form_validation->set_rules('password', '"Password"', 'trim|required|alpha_dash|encode_php_tags|xss_clean');

				if( $this->form_validation->run() )
				{
					$username = $this->input->post('username');
					$password = $this->input->post('password');

					// If the user exists he can be logged in
					if( $username == $this->username && $password == $this->password )
					{
						$this->session->set_userdata('logged_in', TRUE);
					}
				}
			}
		}
		// If the user is not connected, then he is redirected to the login screen
		if( !$this->session->userdata('logged_in') )
		{
			array_unshift($this->data['views'], array('Misc/login', array()) );
		}
		else
		{
			$this->data['navbar'] = $this->polesManager->poles_get_nav($id);
			$dataIndex = array();
			if($id <= 0)
				$id = -1;
			$dataIndex['pole'] = $this->polesManager->poles_get_info($id);
			$dataIndex['sous_poles'] = $this->polesManager->poles_get_children($id);
			if($id <= 0)
				$dataIndex['orphelins'] = $this->polesManager->poles_get_orphans();
			array_unshift($this->data['views'], array('Home/index', $dataIndex) );
		}
	
		$this->load->view('Misc/template', $this->data);

	}
}
