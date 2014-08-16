<?php

class Friends extends Auth_Controller {
	 var $data = null;
	 public function __construct()
       {
            parent::__construct();
			// load any global variables and add them to our view
            //global $site_name;
			$data = array('projectName' => site_name);
			$this->load->vars($data);
       }
    public function index()
    {

      $data['title'] = "Index level";

	  $this->load->view('templates/header',$data);
	  $this->load->view('templates/menu',$data);
	  // default friends view??
	  $this->load->view('templates/footer',$data);

	}

	public function browse()
    {

	  $data['title'] = "Browse Friends";

      $userID = $this->session->userdata('userID');
      // just redirect to user's browse page for now
	  	$url = "/user/show/".$userID;
			redirect($url,'refresh');
    }

	public function message()
    {

	  $data['title'] = "Send a Message";
	  $this->load->view('templates/header',$data);
      $this->load->view('templates/menu',$data);

      // should be able to start, end or add a message to a conversation
	  // work with convoMaps between users

	  $this->load->view('templates/footer',$data);
    }

	public function add()
    {

			redirect('user/browser/','refresh');
    }
}
?>
