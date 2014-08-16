<?php
Class Post extends Auth_Controller
{
	var $data = null;

	public function __construct()
	{
		parent::__construct();
		//global $site_name;
		$data = array('projectName' => site_name);
		$this->load->vars($data);
		$this->load->library('session');
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		$this->load->model('User_model');
		$this->load->model('Post_model');
		$this->load->model('Group_model');
		$this->load->model('Content_model');
		$this->load->model( 'user_wall_model' );
		$this->load->model( 'Group_Wall_model' );
		$this->load->model( 'Comment' );
	}
	function index()
	{

	}
	function create() {
		$data ['title'] = "Create a Post";
		$session_data = $this->session->userdata('logged_in');
		$userID = $session_data['userID'];


		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'templates/menu', $data );
		//var_dump($data);
		// post form should allow user to select between a friend's wall or a group they are member of
		// should be able to select text, image, or video
		$data['friend_list'] = $this->User_model->get_user_friends($userID);
		$data['group_list'] = $this->User_model->get_user_groups($userID);
		//var_dump ($data['friend_list']);
		$this->load->view ( 'post_create_view', $data );
		$this->load->view ( 'templates/footer', $data );
	}

	function send()
	{
		$session_data = $this->session->userdata('logged_in');
		$data ['title'] = "Create a Post";
		$data ['error'] = '';

		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'templates/menu', $data );

		$content['type'] = $this->input->post('post_type');
		$content['message'] = $this->input->post('message');
		$content['userID'] = $session_data['userID'];
		$content['isComment'] = 0;
		$content['link_url'] = "";
		if ($content['type'] == "IMAGE")
		{
			//set filename -> FOR SOME REASON THIS STILL DOESN'T WORK!!
			$config['file_name'] = $session_data['userID'] . "_" . $_FILES['userfile']['name'];
			//echo $config['file_name'];
			//do upload
			$this->load->library('upload', $this->config);


			// check if upload worked, if it did get path
			if($this->upload->do_upload())
			{
				//echo $this->upload->data()['full_path'];
				$content['link_url'] = $this->upload->data()['file_name'];
			}
			else
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view ( 'post_error_view', $error );
			}
		}
		if ($content['type'] == "VIDEO") {
			$content['link_url'] = $this->input->post('embedID');
		}

		// create new content with $content
		// link post with content, user
		$postID = $this->Post_model->add_post_to_db($content);
		// add to appropriate wall below
		if ($this->input->post('where') == "ownWall")
		{
			$this->user_wall_model->insert([
				'userID' => $session_data['userID'],
				'postID' => $postID
			]);
		}
		else if ($this->input->post('where') == "friendWall")
		{
			$this->user_wall_model->insert([
				'userID' => $this->input->post('friendID'),
				'postID' => $postID
			]);
		}
		else if ($this->input->post('where') == "groupWall")
		{
			$this->Group_Wall_model->insert([
				'clubID' => $this->input->post('groupID'),
				'postID' => $postID
			]);
		}
		else
		{
			$this->load->view ( 'post_error_view', $error );
		}
		$this->load->view ( 'templates/footer', $data );
		redirect('/post/show/'.$postID);
	}

	function show($postID)
	{
		$session_data = $this->session->userdata('logged_in');
		$data ['title'] = "Look at this";
		$data['myID'] = $this->session->userdata('userID');
		$data['myRole'] = $this->session->userdata('role');
		$data['myStatus'] = $this->session->userdata('status');
		$data['myPrivacy'] = $this->session->userdata('privacy');
		$data['id'] = 0;
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'templates/menu', $data );
		//echo "<br//>";
		$data = $this->Comment->get_thread($postID);
		//var_dump($data);
		//var_dump($query['parentPosts']);
		$posterID = $data['parentPosts'][0] -> userID;
		$data['userID'] = $session_data['userID'];
		$data['postID'] = $data['parentPosts'][0] -> postID;
		$data['allowsComments'] = $data['parentPosts'][0] -> allowsComments;
		//if ($posterID == $data['userID'])
			$this->load->view('post_owner_view', $data);
		//var_dump($query);
		$this->load->view('post_show_view', $data);
		$this->load->view ( 'templates/footer', $data );
	}


function disable_comments($postId) {
		$session_data = $this->session->userdata('logged_in');
		$userID = $session_data['userID'];
		$query = $this->Comment->getPost($postId);
		//var_dump($query);
		$postID = $query[0] -> postID;
		if ($userID != $query[0] -> userID)
		{
			echo "Not your post! can't alter settings";
		}
		else
		{
			$this->Post_model->set_post($postID,"allowsComments",0);
			$url = "/post/show/".$postID;
			redirect($url,'refresh');
		}

}

function enable_comments($postId) {
		$session_data = $this->session->userdata('logged_in');
		$userID = $session_data['userID'];
		$query = $this->Comment->getPost($postId);
		//var_dump($query);
		$postID = $query[0] -> postID;
		if ($userID != $query[0] -> userID)
		{
			echo "Not your post! can't alter settings";
		}
		else
		{
			$this->Post_model->set_post($postID,"allowsComments",1);
			$url = "/post/show/".$postID;
			redirect($url,'refresh');
		}

}

function delete($postId)
{
	$session_data = $this->session->userdata('logged_in');
	$userID = $session_data['userID'];
	$query = $this->Comment->getPost($postId);
	//var_dump($query);
	$postID = $query[0] -> postID;
	if ($userID != $query[0] -> userID)
	{
		echo "Not your post! can't delete";
	}
	else
	{
		// Delete mechanics go here
		$url = "/post/show/".$postID;
		redirect($url,'refresh');
	}

}

	function history()
	{
		// get user posts
		$session_data = $this->session->userdata('logged_in');

		// store the userID from session in our array to send
		$data['userID'] = $session_data['userID'];
		$postArray = $this->User_model->get_user_posts($data['userID']);
		$data ['title'] = "Look at this";
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'templates/menu', $data );

		//var_dump($postArray);
		foreach ($postArray as $post) {
				$query = $this->Comment->get_thread($post['PostID']);
				$this->load->view('templates/thread', $query);
			}
			$this->load->view ( 'templates/footer', $data );
	}



}
?>
