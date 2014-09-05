<?php
class Api extends CI_Controller {
	
	// -------------------------------------------------------------------------------------------------
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model' );
		$this->load->model ( 'relationship_model' );
		$this->load->model ( 'group_model' );
		$this->load->model ( 'membership_model' );
		$this->load->model ( 'has_tag_model' );
		$this->load->model ( 'tag_model' );
		$this->load->model ( 'comment_model' );
		$this->load->model ( 'content_model' );
		$this->load->model ( 'post_model' );
		$this->load->model ( 'user_wall_model' );
		$this->load->model ( 'group_wall_model' );
		$this->load->model ( 'hearts_model' );
		$this->load->model ( 'newsfeed_model' );
		$this->load->model ( 'role_change_requests_model' );
		$this->load->model ( 'invite_model' );
		
	}
	
	// -------------------------------------------------------------------------------------------------
	public function get_user_info() {
		$id = $this->input->post ( 'user_id' );
		
		if ($id != null) {
			$result = $this->user_model->get ( $id );
		} else {
			// $result = $this->user_model->get([
			// 'user_id' => $this->session->userdata('user_id')
			// ]);
			$result = $this->user_model->get ( 7 );
		}
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	public function get_relationship() {
		$result = $this->relationship_model->get ( [ 
				'userID1' => $this->input->post ( 'userID1' ),
				'relationship.status' => $this->input->post ( 'status' ) 
		], [ 
				'user' => 'userID2 = userID' 
		] );
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	public function get_membership() {
		$result = $this->membership_model->get ( [ 
				'userID' => $this->input->post ( 'userID' ),
				'role' => $this->input->post ( 'role' ) 
		], [ 
				'club' => 'membership.clubID = club.clubID' 
		] );
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	public function get_group_info() {
		$id = $this->input->post ( 'clubID' );
		
		if ($id != null) {
			$result = $this->group_model->get ( $id );
		} else {
			$result = NULL;
		}
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	public function get_group_owner() {
		$id = $this->input->post ( 'clubID' );
		
		if ($id != null) {
			$result = $this->group_model->get ( [ 
					'clubID' => $id 
			], [ 
					'user' => 'founderID = userID' 
			] );
		} else {
			$result = NULL;
		}
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	public function get_group_members() {
		$id = $this->input->post ( 'clubID' );
		
		if ($id != null) {
			$result = $this->membership_model->get ( [ 
					'clubID' => $id,
					'membership.role' => 'member' 
			], [ 
					'user' => 'membership.userID = user.userID' 
			] );
		} else {
			$result = NULL;
		}
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	public function get_group_tags() {
		$id = $this->input->post ( 'clubID' );
		
		if ($id != null) {
			$result = $this->has_tag_model->get ( [ 
					'clubID' => $id 
			], [ 
					'tag' => 'tag.tagID = has_tag.tagID' 
			] );
		} else {
			$result = NULL;
		}
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	public function get_groups() {
		$result = $this->group_model->get ();
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	public function get_tags() {
		$result = $this->tag_model->get ();
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	public function get_groups_of_tag() {
		$ids = $this->input->post ( 'tagIDs' );
		$numberIDs = count ( $ids );
		$this->db->select ( 'club.clubID, name, count(name)' );
		$this->db->where_in ( 'tagID', $ids );
		$this->db->from ( 'has_tag' );
		$this->db->join ( 'club', 'has_tag.clubID = club.clubID' );
		$this->db->group_by ( 'name' );
		$this->db->having ( 'count(name) = ' . $numberIDs );
		
		$result = $this->db->get ();
		// print_r($this->db->last_query());
		
		$this->output->set_output ( json_encode ( $result->result_array () ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	public function get_tags_of_groups() {
		$ids = $this->input->post ( 'clubIDs' );
		$exclude = $this->input->post ( 'tagIDs' );
		
		$this->db->select ( 'tag.tagID, name' );
		$this->db->distinct ();
		$this->db->or_where_in ( 'clubID', $ids );
		$this->db->where_not_in ( 'tag.tagID', $exclude );
		$this->db->from ( 'has_tag' );
		$this->db->join ( 'tag', 'has_tag.tagID = tag.tagID' );
		
		$q = $this->db->get ();
		
		$this->output->set_output ( json_encode ( $q->result_array () ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	public function create_group() {
		$id = $this->input->post ( 'userID' );
		$name = $this->input->post ( 'name' );
		$description = $this->input->post ( 'description' );
		$postAllowed = $this->input->post ( 'posting' );
		
		$present = $this->group_model->get([ 'name' => $name ]);
		
		if ($present) {
			$this->output->set_output ( json_encode ( 0 ) );
			return;
		}
		
		$result = $this->group_model->insert ( [ 
				'name' => $name,
				'description' => $description,
				'founderID' => $id,
				'posts_allowed_by_members' => $postAllowed 
		] );
		
		if ($result) {
			$this->membership_model->insert ( [ 
					'clubID' => $result,
					'userID' => $id,
					'role' => 'owner' 
			] );
		}
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	public function sort_users_by_filter() {
		$sortBy = $this->input->post ( 'sortBy' );
		$order = $this->input->post ( 'order' );
		
		$this->db->select ( 'userID, firstName, lastName' );
		$this->db->from ( 'user' );
		$this->db->where ( 'privacy != ', 'private' );
		$this->db->order_by ( $sortBy, $order );
		
		$result = $this->db->get ();
		
		$this->output->set_output ( json_encode ( $result->result_array () ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	public function get_all_filters() {
		$filters = array (
				'age',
				'alphabetical first name',
				'alphabetical last name' 
		)
		;
		
		$this->output->set_output ( json_encode ( $filters ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	public function get_all_users() {
		$result = $this->user_model->get ();
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function add_relationship() {
		$myID = $this->input->post ( 'myID' );
		$otherID = $this->input->post ( 'id' );
		$status = $this->input->post ( 'status' );
		
		$alreadyPresent = $this->relationship_model->get ( [ 
				'userID1' => $myID,
				'userID2' => $otherID,
				'status' => $status 
		] );
		
		$result = " ";
		$rows = 0;
		if (! empty ( $alreadyPresent )) {
			$result = 'You are already ' . $status;
			
		} else {
			$this->db->trans_start();
			$this->relationship_model->insert ( [ 
					'userID1' => $myID,
					'userID2' => $otherID,
					'status' => $status 
			] );
			$this->db->trans_complete();
			$completed = $this->db->trans_status();
			
			if ($completed == 1) {
				$result = 'You are now ' . $status;
			}
		}
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function remove_relationship() {
		$myID = $this->input->post ( 'myID' );
		$otherID = $this->input->post ( 'id' );
		$status = $this->input->post ( 'status' );
		
		$result = " ";
		
		// gard against unsafe deletion
		if ($myID == null || $otherID == null || $status == null) {
			$result = 'There is a parameter missing';
			$this->output->set_output ( json_encode ( $result ) );
			return;
		}
	
		$alreadyPresent = $this->relationship_model->get ( [
			'userID1' => $myID,
			'userID2' => $otherID,
			'status' => $status
		] );
	
		
		$rows = 0;
		if (! empty ( $alreadyPresent )) {
			
			$removed = $this->relationship_model->delete ( [
				'userID1' => $myID,
				'userID2' => $otherID,
				'status' => $status
			] );
			
			$this->relationship_model->delete ( [
				'userID1' => $otherID,
				'userID2' => $myID,
				'status' => $status
			] );
			
			$result = 'You are not ' . $status . ' anymore';
			
		} else {
			$result = 'You were not ' . $status . ' friends anyway';
		}
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function add_membership() {
		$myID = $this->input->post ( 'myID' );
		$clubID = $this->input->post ( 'groupID' );
		$role = $this->input->post ( 'role' );
	
		$alreadyPresent = $this->membership_model->get ( [
			'userID' => $myID,
			'clubID' => $clubID,
			'role' => $role
		] );
	
		$result = " ";
		$rows = 0;
		if (! empty ( $alreadyPresent )) {
			$result = 'You are already a ' . $role;
				
		} else {
			$this->db->trans_start();
			$this->membership_model->insert ( [
				'userID' => $myID,
				'clubID' => $clubID,
				'role' => $role
			] );
			$this->db->trans_complete();
			$completed = $this->db->trans_status();
				
			if ($completed == 1) {
				$result = 'You are now a ' . $role;
			}
		}
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function remove_membership() {
		$myID = $this->input->post ( 'myID' );
		$clubID = $this->input->post ( 'groupID' );
		$role = $this->input->post ( 'role' );
	
		$result = " ";
	
		// gard against unsafe deletion
		if ($myID == null || $clubID == null || $role == null) {
			$result = 'There is a parameter missing';
			$this->output->set_output ( json_encode ( $result ) );
			return;
		}
	
		$alreadyPresent = $this->membership_model->get ( [
				'userID' => $myID,
				'clubID' => $clubID,
				'role' => $role
				] );
	
		$rows = 0;
		if (! empty ( $alreadyPresent )) {
				
			$removed = $this->membership_model->delete ( [
					'userID' => $myID,
					'clubID' => $clubID,
					'role' => $role
					] );
				
			$result = 'You are not ' . $role . ' anymore';
				
		} else {
			$result = 'You were not ' . $role . ' anyway';
		}
		$this->output->set_output ( json_encode ( $result ) );
	}

	// -------------------------------------------------------------------------------------------------
	
	public function accept_membership_request() {
		$myID = $this->input->post ( 'myID' );
		$clubID = $this->input->post ( 'groupID' );
		
		$alreadyPresent = $this->membership_model->get ( [
				'userID' => $myID,
				'clubID' => $clubID,
				'role' => "member pending"
		] );
		
		$result = 0;
		if ( $alreadyPresent ) {
		
			$result = $this->membership_model->update ( 
					[
						'role' => "member"
					],
					[
						'userID' => $myID,
						'clubID' => $clubID,
					] );
		} 
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function delete_group_tree() {
		
		$myID = $this->input->post ( 'myID' );
		$clubID = $this->input->post ( 'groupID' );
		
		$result = 0;
		// gard against unsafe deletion
		if ($myID == null || $clubID == null) {
			$result = 'There is a parameter missing';
			$this->output->set_output ( json_encode ( $result ) );
			return;
		}
		
		// check if user is owner
		$founder = $this->group_model->get([
			'clubID' => $clubID,
			'founderID' => $myID
		]); 
		if (! $founder) {
			$result = "You are not the owner of this group, you can't delete it";
			$this->output->set_output ( json_encode ( $result ) );
			return;
		}
		
		$posts = $this->group_wall_model->get($clubID);
		
		foreach($posts as $row) {
			$this->delete_post($row['postID']);
		}
		
		$result = $this->group_model->delete($clubID);
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
		
	public function get_newsfeed() {
		$userID = $this->input->post('userID');
		
		
		$where = [
		'newsfeed.userID' => $userID,
		'isComment = ' => 0
		];
		
		$result = $this->newsfeed_model->get($where);
		
// 		print_r($this->db->last_query());
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	public function get_post() {

		$postID = $this->input->post('postID');
		
		$where = [
		'isComment = ' => 0
		];
		$where['post.postID'] = $postID;

		$result = $this->post_model->get($where,
		[
			'user' => 'user.userID = post.userID',
			'content' => 'post.postID = content.postID'

		], ['post.postID' => 'desc']);
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function get_user_wall_posts() {
		$userID = $this->input->post('userID');
		$postID = $this->input->post('postID');
		
		
		$where = [
		'userWall.userID' => $userID,
		'isComment = ' => 0
		];
		
		if ($postID) {
			$where['userWall.postID'] = $postID;
		}
		
		$result = $this->user_wall_model->get($where,
		[
			'post' => 'userWall.postID = post.postID',
			'user' => 'user.userID = post.userID',
			'content' => 'post.postID = content.postID'
		], ['post.postID' => 'desc']);
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function get_group_wall_posts() {
		$clubID = $this->input->post('groupID');
		$postID = $this->input->post('postID');
	
	
		$where = [
		'clubWall.clubID' => $clubID,
		'isComment = ' => 0
		];
	
		if ($postID) {
			$where['clubWall.postID'] = $postID;
		}
	
		$result = $this->group_wall_model->get($where,
				[
				'post' => 'clubWall.postID = post.postID',
				'user' => 'user.userID = post.userID',
				'content' => 'post.postID = content.postID'
				], ['post.postID' => 'desc']);
	
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function get_child_posts() {
		$parentIDs = $this->input->post('parentIDs');
		
		
		$this->db->where_in('parentID', $parentIDs);
		$this->db->from('comment');
		$this->db->join( 'post', 'post.postID = comment.childID' );
		$this->db->join( 'content', 'post.postID = content.postID' );
		$this->db->join( 'user', 'user.userID = post.userID' );
		
		$result = $this->db->get ();
		
		$this->output->set_output ( json_encode ( $result->result_array() ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function get_one_child_post() {
		$postID = $this->input->post('postID');
	
		$result = $this->post_model->get($postID, [
			'content' => 'post.postID = content.postID',
			'comment' => 'post.postID = comment.childID',
			'user' => 'user.userID = post.userID'
		]);
	
	
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function add_user_wall_post() {
		$posterID = $this->input->post('posterID');
		$targetID = $this->input->post('targetID');
		$message = $this->input->post('message');
		$image = $this->input->post('image');
		$video = $this->input->post('video');
		
		
		$postID = $this->post_model->insert([
				'timeCreated' => date('Y-m-d H:m:s'),
				'userID' => $posterID
				]);
		
		$contentID = "";
		
		// add message to database
		if ($message) {
			$contentID = $this->content_model->insert([
					'postID' => $postID,
					'type' => 'TEXT',
					'text' => $message
					]);
		} 
		
		// add image to database, and save image to file
		else if ($image) {
			
			$contentID = $this->content_model->insert([
					'postID' => $postID,
					'type' => 'IMAGE'
// 					, 'attachment' => $image
					]);
			
			$image = str_replace('data:image/jpeg;base64,', '', $image);
			$image = str_replace(' ', '+', $image);
			$imageData = base64_decode($image);
			$source = imagecreatefromstring($imageData);
			$imageName = 'uploads/' . $contentID . ".jpg";
			$imageSave = imagejpeg($source, $imageName, 100);
			imagedestroy($source);
			
		} 
		
		// add video link to database
		else if ($video) {
			$contentID = $this->content_model->insert([
					'postID' => $postID,
					'type' => 'VIDEO',
					'link_url' => $video
					]);
		}
		
		if ($contentID) {
			
			$result = $this->user_wall_model->insert([
				'userID' => $targetID,
				'postID' => $postID
			]);
		
		}
		
		$this->output->set_output ( json_encode ( $postID ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function add_group_wall_post() {
		$posterID = $this->input->post('posterID');
		$targetID = $this->input->post('targetID');
		$message = $this->input->post('message');
		$image = $this->input->post('image');
		$video = $this->input->post('video');
	
		$postID = $this->post_model->insert([
				'timeCreated' => date('Y-m-d H:m:s'),
				'userID' => $posterID
				]);
		
		$contentID = "";
	
		// add message to database
		if ($message) {
			$contentID = $this->content_model->insert([
					'postID' => $postID,
					'type' => 'TEXT',
					'text' => $message
					]);
		}
	
		// add image to database, and save image to file
		else if ($image) {
				
			$contentID = $this->content_model->insert([
					'postID' => $postID,
					'type' => 'IMAGE'
// 					, 'attachment' => $image
					]);
				
			$image = str_replace('data:image/jpeg;base64,', '', $image);
			$image = str_replace(' ', '+', $image);
			$imageData = base64_decode($image);
			$source = imagecreatefromstring($imageData);
			$imageName = 'uploads/' . $postID . ".jpg";
			$imageSave = imagejpeg($source, $imageName, 100);
			imagedestroy($source);
				
		}
	
		// add video link to database
		else if ($video) {
			$contentID = $this->content_model->insert([
					'postID' => $postID,
					'type' => 'VIDEO',
					'link_url' => $video
					]);
		}
	
		if ($contentID) {
				
			$result = $this->group_wall_model->insert([
					'clubID' => $targetID,
					'postID' => $postID
					]);
	
		}
	
		$this->output->set_output ( json_encode ( $postID ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function add_comment_to_post() {
		$posterID = $this->input->post('posterID');
		$postID = $this->input->post('postID');
		$message = $this->input->post('message');
	
		$childID = $this->post_model->insert([
				'timeCreated' => date('Y-m-d H:m:s'),
				'userID' => $posterID,
				'isComment' => 1
		]);
		
		$contentID = $this->content_model->insert([
				'type' => 'TEXT',
				'text' => $message,
				'postID' => $childID
		]);
		
		$result = $this->comment_model->insert([
				'parentID' => $postID,
				'childID' => $childID
		]);
	
		$this->output->set_output ( json_encode ( $childID ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function check_relationship() {
		$myUserID = $this->input->post('myUserID');
		$pageUserID = $this->input->post('pageUserID');
		
		$relationships = $this->relationship_model->get([
			'userID1' => $myUserID,
			'userID2' => $pageUserID
		]);
		
		$this->output->set_output ( json_encode ( $relationships ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function check_membership() {
		$clubID = $this->input->post('groupID');
		$userID = $this->input->post('userID');
	
		$relationships = $this->membership_model->get([
			'clubID' => $clubID,
			'userID' => $userID
		]);
	
		$this->output->set_output ( json_encode ( $relationships ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function check_privacy() {
		$userID = $this->input->post('userID');
	
		$relationships = $this->user_model->get([
			'userID' => $userID
		],
		null,
		null,
		['privacy']
		);
	
		$this->output->set_output ( json_encode ( $relationships ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function get_pending_relationships() {
		$userID = $this->input->post('userID');
		
		$relationships = $this->relationship_model->get([
			'userID2' => $userID
		], 
		['user' => 'userID = userID1'],
		null,
		'userID, userID2, relationship.status, firstName, lastName',
		['relationship.status' => 'pending']
		);
		
		$this->output->set_output ( json_encode ( $relationships ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function accept_relationship_request() {
		$userID1 = $this->input->post('userID1');
		$userID2 = $this->input->post('userID2');
		$status = $this->input->post('status');
		
		$result = $this->relationship_model->update([
			'status' => $status
		],
		[
			'userID1' => $userID1,
			'userID2' => $userID2,
			'status' => $status . " pending"
		]);
		
		if ($result) {
			$this->relationship_model->insert([
				'userID1' => $userID2,
				'userID2' => $userID1,
				'status' => $status
			]);
		}
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function decline_relationship_request() {
		$userID1 = $this->input->post('userID1');
		$userID2 = $this->input->post('userID2');
		$status = $this->input->post('status');
		
		$result = $this->relationship_model->delete([
			'userID1' => $userID1,
			'userID2' => $userID2,
			'status' => $status . " pending"
		]);
		
		$this->output->set_output ( json_encode ( $result ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function get_hearted_state() {
		$postIDs = $this->input->post('postIDs');
		$userID = $this->input->post('userID');
	
		$this->db->where_in('postID', $postIDs);
		$this->db->where('userID', $userID);
		$this->db->from('hearts');
	
		$result = $this->db->get();
	
		$this->output->set_output ( json_encode ( $result->result_array() ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function get_heart_counts() {
		$postIDs = $this->input->post('postIDs');
	
		$this->db->select('postID, COUNT(postID) as total');
		$this->db->where_in('postID', $postIDs);
		$this->db->from('hearts');
		$this->db->group_by('postID');
	
		$result = $this->db->get ();
		
// 		print_r($this->db->last_query());
	
		$this->output->set_output ( json_encode ( $result->result_array() ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function add_to_hearted() {
		$userID = $this->input->post('userID');
		$postID = $this->input->post('postID');
		
		$alreadyPresent = $this->hearts_model->get([
			'userID' => $userID,
			'postID' => $postID
		]);
		
		$result = 0;
		if (!$alreadyPresent)
		$result = $this->hearts_model->insert([
			'userID' => $userID,
			'postID' => $postID
		]);
	
		$this->output->set_output ( json_encode ( $result ) );
	}

	// -------------------------------------------------------------------------------------------------
	
	public function remove_from_hearted() {
		$userID = $this->input->post('userID');
		$postID = $this->input->post('postID');
	
		$result = $this->hearts_model->delete([
			'userID' => $userID,
			'postID' => $postID
		]);
	
		$this->output->set_output ( json_encode ( $result ) );
	}

	// -------------------------------------------------------------------------------------------------
	
	public function delete_post($postID = null) {
		if (! $postID) {
			$postID = $this->input->post('postID');
		}
		
		$parentIDs = $this->comment_model->get($postID);
		
		if ($parentIDs) {
		foreach ($parentIDs as $_key => $_value) {
				$this->db->or_where('postID', $_value['childID']);
			}
			$this->db->delete('post');
		}
		
		$result = $this->post_model->delete([
			'postID' => $postID
		]);
		
		
		$this->output->set_output ( json_encode ( $result ) );
	}

	// -------------------------------------------------------------------------------------------------
	
	public function confirm_post_ownership() {
		$postIDs = $this->input->post('postIDs');
		$userID = $this->input->post('userID');
		
		$this->db->where('userID', $userID);
		$this->db->where_in('postID', $postIDs);
		$this->db->from('post');
		
		$result = $this->db->get ();
	
		$this->output->set_output ( json_encode ( $result->result_array() ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function share_post() {
		$postID = $this->input->post('postID');
		$userID = $this->input->post('userID');
		
		$present = $this->user_wall_model->get([
			'postID' => $postID,
			'userID' => $userID
		]);
		
		$result = 0;
		if (!$present) {
			$result = $this->user_wall_model->insert([
				'postID' => $postID,
				'userID' => $userID
			]);
		}
		
		$this->output->set_output ( json_encode ( $result ) );
	}

	// -------------------------------------------------------------------------------------------------
	
	public function get_role_requests() {
		$userID = $this->input->post('userID');
		$role = $this->input->post('role');
		
		// check if there are requests for a user and role
		if ($userID && $role) {
			$request = $this->role_change_requests_model->get([
				'userID' => $userID,
				'requested_role' => $role
			]);
			$this->output->set_output ( json_encode ( $request ) );
			return;
		} 
		
		// return all pending requests
		else {
			$requests = $request = $this->role_change_requests_model->get([
				'answer' => 'pending'
			], [
				'user' => 'user.userID = roleChangeRequests.userID'
			]);
			$this->output->set_output ( json_encode ( $requests ) );
			return;
		}
	}
	

	// -------------------------------------------------------------------------------------------------
	
	public function add_request_role() {
		$userID = $this->input->post('userID');
		$role = $this->input->post('role');
	
		// check if already present
		$present = $this->role_change_requests_model->get([
			'userID' => $userID,
			'requested_role' => $role
		]);
		
		$answer = '';
		if ($present) {
			$answer = "You already requested this, you must wait for response.";
		} 
		
		else {
			$success = $this->role_change_requests_model->insert([
				'userID' => $userID,
				'requested_role' => $role
			]);
			
			if ($success) {
				$answer = "success";
			} else {
				$answer = "Database failed to insert the request for unknown reason.";
			}
		}
		
		$this->output->set_output ( json_encode ( $answer ) );
		
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function set_role() {
		$userID = $this->input->post('userID');
		$role = $this->input->post('role');
		$answer = $this->input->post('answer');
	
		$success = $this->role_change_requests_model->update(
			[
				'answer' => $answer
			],
			[
				'userID' => $userID,
				'requested_role' => $role
			]);
		
		if ($success && $answer == "accepted") {
			$success = $this->user_model->update(
				[
				'role' => $role
				],
				[
				'userID' => $userID
			]);
		}
		
		if ($success) {
			$answer = "success";
		} else {
			$answer = "Database failed to process the request for unknown reason.";
		}
		
		$this->output->set_output ( json_encode ( $answer ) );
	
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function set_status() {
		$userID = $this->input->post('userID');
		$status = $this->input->post('status');
	
		$success = $this->user_model->update(
				[
				'status' => $status
				],
				[
				'userID' => $userID
				]);
	
		$answer = "";
		if ($success) {
			$answer = "success";
		} else {
			$answer = "Database failed to process the request for unknown reason.";
		}
	
		$this->output->set_output ( json_encode ( $answer ) );
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function add_invite() {
		$userID = $this->input->post('userID');
		$email = $this->input->post('email');
				
		// copied from thomas.
		$base = site_url();
		$secreturl = MD5($email);
		
		$present = $this->invite_model->get([
				'invited' => $email
		]);
		
		if ($present) {
			$answer = 'Generated URL for '.$email.'<br/> '.$base.'registration/index/'.$present[0]['invitedurl'];
			$this->output->set_output ( json_encode ( $answer ) );
			return;
		}
		
		$result = $this->invite_model->insert([
			'invited' => $email,
			'invitedurl' => $secreturl,
			'timestamp' => date('Y-m-d H:m:s'),
			'inviter' => $userID
		]);
		
		if ($result) {
			$answer = 'Generated URL for '.$email.'<br/> '.$base.'registration/index/'.$secreturl;
			$this->output->set_output ( json_encode ( $answer ) );
		} else {
			$this->output->set_output ( json_encode ( "Error in database insertion." ) );
		}
		
		
	}
	
	// -------------------------------------------------------------------------------------------------
	
	public function get_membership_requests() {
		$userID = $this->input->post('userID');
		
		$requests = $this->group_model->get( [
			'founderID' => $userID,
			'membership.role' => 'member pending'
		],[
			'membership' => 'club.clubID = membership.clubID',
			'user' => 'membership.userID = user.userID'
		], 
		null, [
			'club.clubID', 'name', 'firstName', 'lastName', 'user.userID'
		]);
		
		
		$this->output->set_output ( json_encode ( $requests ) );
	}
	
	
	
	
	
}












