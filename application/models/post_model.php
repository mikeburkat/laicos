<?php

class Post_model extends CRUD_model {

	protected $_table = 'post';
	protected $_primary_key = 'post.postID';

	//-------------------------------------------------------------------------------------------------


	public function __construct() {
		parent::__construct();

	}

	function add_post_to_db($post)
	{
		$this->load->model('Content_model');
		
		
		$postID = $this->Post_model->insert([
			'timeCreated' => date('Y-m-d H:m:s'),
			'userID' => $post['userID']
		]);
		
		$this->Content_model->insert([
			'postID' => $postID,
			'type' => $post['type'],
			'text' => $post['message'],
			'link_url' => $post['link_url']
		]);
		//echo "content id: " . $contentID;

		//echo "post id: " . $postID;
		return $postID;
	}

	public function set_post($postID,$setting,$value)
	{
		$this->load->database();
		$data = array(
		$setting => $value,
		);

		$this->db->where('postID', $postID);
		$this->db->update('post', $data);
	}

}
