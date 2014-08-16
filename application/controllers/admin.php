<?php

// TODO change back to Auth_Controller to use login authentification.
class Admin extends Auth_Controller {

	var $data = null;

	public function __construct()
	{
		parent::__construct();
		////global $site_name;
		$this->load->helper('form'); //loading form helper to use with settings.
	}

	public function index() {
		$data['projectName'] = site_name;
		$data['title'] = "User Profile";
		
		$data['id'] = $this->session->userdata('userID');
		$data['myID'] = $this->session->userdata('userID');
		$data['myRole'] = $this->session->userdata('role');
		$data['myStatus'] = $this->session->userdata('status');
		$data['myPrivacy'] = $this->session->userdata('privacy');

		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('admin_view',$data);
		$this->load->view('templates/footer',$data);
	}

	
}
?>
