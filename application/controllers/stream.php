<?php
Class Stream extends Auth_Controller
{
	var $data = null;

	public function __construct()
	{
		parent::__construct();

		//global $site_name;
		$data = array('projectName' => site_name);
		$this->load->vars($data);
		$this->load->library('session');

		//$this->load->helper('form'); //loading form helper to use with settings.

	}
	
	function index(){
		$this->load->model('User_model');
		$this->load->helper('form');
		$data ['title'] = "Broadcast";
		$session_data = $this->session->userdata('logged_in');
		$userID = $session_data['userID'];
		$data['stream_id'] = $this->User_model->get_user_setting($userID,'lastStream');
		
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'templates/menu', $data );
		$this->load->view ( 'stream_view', $data );
		//var_dump($data);
		if ( empty($data['stream_id']) ) 
		{
			//not currently broadcasting
		}
		else
		{
			$this->load->view('stream_stop_view',$data);
			$this->load->view ( 'stream_yt_view', $data );
		}
		$this->load->view ( 'templates/footer', $data );
	}
	function stop()
	{
		$this->load->model('User_model');
		$session_data = $this->session->userdata('logged_in');
		$userID = $session_data['userID'];
		$this->User_model->set_user_setting($userID,'lastStream',null);
		redirect('stream','refresh');
	}
	function yt($id)
	{
		$this->load->helper('form');
		$data ['projectName'] = 'Laicos';
		$data ['title'] = "Watch Youtube Stream";
		$data ['stream_id'] = $id;
		
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'templates/menu', $data );
		$this->load->view ( 'stream_yt_view', $data );
		$this->load->view ( 'templates/footer', $data );
	}

	function set() {
		$this->load->model('User_model');
		$session_data = $this->session->userdata('logged_in');
		$userID = $session_data['userID'];
		$this->User_model->set_user_setting($userID,'lastStream',$this->input->post('video_url'));
		$rurl1 = 'stream/';
		//$rurl2 = $rurl1.$this->input->post('video_url');
		redirect($rurl1,'refresh');
	}
}
?>
