<?php
	
	$this->load->helper(array('url', 'assets', 'verif', 'security'));
	$this->load->view('Misc/header');
	
	if( $this->session->userdata('logged_in') && $navbar_display )
		$this->load->view('Misc/navbar', $navbar);
	
	if($views)
		foreach($views as $page)
			$this->load->view($page[0], $page[1]);
	$this->load->view('Misc/footer');
?>