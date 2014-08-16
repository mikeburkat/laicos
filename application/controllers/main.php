<?php
class Main extends Auth_Controller {

	 var $data = null;

	 public function __construct()
  {
	        parent::__construct();
					// load any global variables and add them to our view
	        //global $site_name;

					$data = array('projectName' => site_name);
					$this->load->vars($data);
					$this->load->library('session');
		}
		public function debug()
		{
			//$this->load->library('session');
			//print_r($this->session->all_userdata());
			//var_dump($this->session->userdata('logged_in'));
			var_dump($this->session->userdata('redir'));
			//$CI =& get_instance();
			// We need to use $CI->session instead of $this->session
			//$user = $this->session->userdata('logged_in');
			//echo $user["userID"];
			//if  ($this->session->userdata('logged_in')){echo "true";}

		}
    public function index()
    {
		// $data array is what gets sent to the view, needs things added to it
		$data['title'] = "Laicos - A hearty place";

		if (is_logged_in()){
			redirect('main/welcome/','refresh');
		}
		else {
			redirect('login/','refresh');
		}

	}

	public function welcome()
  {
		$data['title'] = "Your Hearty Place";
		// get the session array (has userID, email) directly
		$session_data = $this->session->userdata('logged_in');

		// store the userID from session in our array to send
		$data['userID'] = $session_data['userID'];
		
		$data['myID'] = $this->session->userdata('userID');
		$data['myRole'] = $this->session->userdata('role');
		$data['myStatus'] = $this->session->userdata('status');
		$data['myPrivacy'] = $this->session->userdata('privacy');
		$data['id'] = 0;


		// alternatively use userID to get info on client which helper function which returns array
		$this->load->model('User_model');
		$user = $this->User_model->get_user_array($data['userID']);

		// add what you want from user to the array
		$data['displayName'] = $user['displayName'];
		$data['firstName'] = $user['firstName'];
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('main_view',$data);
		



		$this->load->view('templates/footer',$data);
	}

	public function parentposts()
	{

		$data['title'] = "Parent Posts";

	    $this->load->model('Comment');

		$query['tableData'] = $this->Comment->getParentPosts();

		$this->load->view('templates/header',$data);
    $this->load->view('templates/table', $query);
		$this->load->view('templates/footer',$data);
	}

	public function childposts()
	{

		$data['title'] = "Child Posts";

	    $this->load->model('Comment');

		$query['tableData'] = $this->Comment->getChildPosts();

		$this->load->view('templates/header',$data);
        $this->load->view('templates/table', $query);
		$this->load->view('templates/footer',$data);
	}

	public function showthreadtable()
	{
		$data['title'] = "A Thread";

		$this->load->model('Comment');

		$this->load->view('templates/header',$data);

		$query['tableData'] = $this->Comment->getPost(3);
		$this->load->view('templates/table', $query);

		$query['tableData'] = $this->Comment->createThread(3);
        $this->load->view('templates/table', $query);

		$this->load->view('templates/footer',$data);

	}

	public function showthread()
	{


		$data['title'] = "A Thread";

		$this->load->model('Comment');

		$this->load->view('templates/header',$data);

		//get wall posts for user with id 10
		$parentPosts = $this->Message_model->getParentMessage_model(10);

		foreach($parentPosts as $parent)
		{
				$query['parentPosts'] = $this->Comment->getPost($parent->postID);
				$query['childPosts'] = $this->Comment->createThread($parent->postID);

				$this->load->view('templates/thread', $query);
		}

		$this->load->view('templates/footer',$data);

	}

}
?>
