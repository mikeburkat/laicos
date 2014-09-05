<?php

// TODO change back to Auth_Controller to use login authentification.
class User extends CI_Controller {

	var $data = null;

	public function __construct()
	{
		parent::__construct();
			//global $site_name;
		// 		$user_id = $this->session->userdata('user_id');
		// 		if (!$user_id) {
		// 			$this->logout();
		// 		}

		$this->load->helper('form'); //loading form helper to use with settings.
		$this->load->model('User_model');
	}

	public function index() {
		$data['projectName'] = site_name;
		$data['title'] = "User Profile";

		$data['myID'] = $this->session->userdata('userID');
		$data['myRole'] = $this->session->userdata('role');
		$data['myStatus'] = $this->session->userdata('status');
		$data['myPrivacy'] = $this->session->userdata('privacy');

		$data['id'] = $this->session->userdata('userID');
		$data['stream_id'] = $this->User_model->get_user_setting($data['id'],'lastStream');
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('user_view',$data);
		$this->load->view('templates/footer',$data);
	}

	public function show($id = null) {
		
		
		
		$data['projectName'] = site_name;
		$data['title'] = "User Profile";

		$data['myID'] = $this->session->userdata('userID');
		$data['myRole'] = $this->session->userdata('role');
		$data['myStatus'] = $this->session->userdata('status');
		$data['myPrivacy'] = $this->session->userdata('privacy');

		$data['id'] = $id;
		
		if ($id) {
			$this->load->model ( 'user_model' );
			$exists = $this->user_model->get($id);
			if (!$exists) {
				$this->load->view('templates/header',$data);
				$this->load->view('templates/menu',$data);
				echo "<br><br><br><br><center>This user does not exits</center>";
				$this->load->view('templates/footer',$data);
				return;
			}
		}
		
		$data['stream_id'] = $this->User_model->get_user_setting($id,'lastStream');
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('user_view',$data);
		$this->load->view('templates/footer',$data);
	}

	public function settings() {
		$data ['projectName'] = 'Laicos';
		$data['title'] = "Settings";
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('settings_view',$data);
		$this->load->view('templates/footer',$data);
	}
	
	public function browser() {
		$data ['projectName'] = 'Laicos';
		$data ['title'] = "User Profile";
		
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'templates/menu', $data );
		$this->load->view ( 'user_browser_view', $data );
		$this->load->view ( 'templates/footer', $data );
	}
	
	public function gifts() {

		$myID = $this->session->userdata('userID');

		$data ['projectName'] = 'Laicos';
		$data ['title'] = "Gift Exchange";
		$data ['friends'] = $this->User_model->get_user_friends($myID);
		$data ['myGifts'] = $this->User_model->get_user_gifts($myID);
		
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'templates/menu', $data );
		$this->load->view ( 'gifts_view', $data );
		$this->load->view ( 'templates/footer', $data );
	}

	
	

	public function logout() {
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect("/");
	}
	
	public function invite()
	{
		$data ['projectName'] = 'Laicos';
		$data ['title'] = "Invite a friend!";
		
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'templates/menu', $data );
		$this->load->view ( 'invite_view', $data );
		$this->load->view ( 'templates/footer', $data );
	}
	
}
?>
