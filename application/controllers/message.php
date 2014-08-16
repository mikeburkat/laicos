<?php
class Message extends CI_Controller {

	 var $data = null;

	 public function __construct()
	{
	    parent::__construct();
//global $site_name;
		$this->load->model('User_model');
		$this->load->helper(array('form', 'url'));
		$this->load->model('Post_model');
		$this->load->model('Message_model');
	}

	public function inbox()
	{
		$data['projectName'] = site_name;
		$this->load->model('Message_model');
		$session_data = $this->session->userdata('logged_in');
		$userId = $session_data['userID'];

		$parentPM = $this->Message_model->getParentMessage_model($userId);

		$data['title'] = "Private Messages";
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('templates/spacer',$data);
		
		$this->load->view('private_messages/new_pm_button');
		
		$data['myID'] = $this->session->userdata('userID');

		foreach($parentPM as $parent)
		{
			$data['participants'] = $this->Message_model->getPrivateMessageParticipants($parent->postID);
			$data['post'] = $this->Message_model->getPost($parent->postID);
			$this->load->view('private_messages/private_message_summary', $data);
		}

		$this->load->view('templates/footer',$data);
	}

	public function pm_thread($postId)
	{
		$data['projectName'] = site_name;
		$data['title'] = "A Private Message";
		$query['param_id'] = $postId;
		$query['myID'] = $this->session->userdata('userID');
		$query['myRole'] = $this->session->userdata('role');
		$query['myStatus'] = $this->session->userdata('status');
		$query['myPrivacy'] = $this->session->userdata('privacy');

		$query['id'] = $postId;
		
		$this->load->model('Comment');

		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);

		//$query['parentPosts'] = $this->Comment->getPost($postId);
		//$query['childPosts'] = $this->Comment->createThread($postId);

        $this->load->view('templates/thread', $query);

		$this->load->view('templates/footer',$data);

	}
	
	public function pm_create()
	{	
		$data['projectName'] = site_name;

		$session_data = $this->session->userdata('logged_in');
		$userID = $session_data['userID'];
		
		$data['friend_list'] = $this->User_model->get_user_friends($userID);
		
		$data['title'] = "Create Private Messages";
		
		$this->load->view('templates/header',$data);
		$this->load->view('templates/menu',$data);
		$this->load->view('templates/spacer',$data);
		
		$this->load->view('private_messages/private_message_creation');
		
		$this->load->view('templates/footer',$data);
	}
	
	public function send()
	{	
		$session_data = $this->session->userdata('logged_in');
		$data ['title'] = "Create a Post";
		$data ['error'] = '';

		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'templates/menu', $data );
		
	
		$content['type'] = "TEXT";
		$content['message'] = $this->input->post('message');
		$content['friendID'] = $this->input->post('friendID');
		$content['userID'] = $session_data['userID'];
		$content['isComment'] = 0;
		$content['link_url'] = "";
		
		#var_dump($content['friendID']);
		
		$postID = $this->Post_model->add_post_to_db($content);
		
		$insert['userID'] = $content['userID'];
		$insert['postID'] = $postID;
		//var_dump($insert);
		$this->Message_model->insert($insert);
		
		foreach ($content['friendID'] as $id){
			$insert['userID'] = $id;
			$insert['postID'] = $postID;
 			#var_dump($insert);
			$this->Message_model->insert($insert);
			}
		
		$this->load->view ( 'templates/footer', $data );
		redirect('/message/pm_thread/'.$postID);
	}
}
?>
