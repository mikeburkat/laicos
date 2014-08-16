<?php
class Message_model extends CRUD_model {
	
	protected $_table = 'privateMessages';
	protected $_primary_key = 'postID';

	
	function __construct() {
		parent::__construct ();
	}
	
	function getParentMessage_model($userId) 
	{
		$query = $this->db->query ( 'SELECT DISTINCT pm.postID 
			FROM privateMessages as pm 
			INNER JOIN post as p ON p.postID=pm.postID 
			WHERE pm.userID=' . $userId . 
			' ORDER BY p.timeCreated desc;' );
		
		return $query->result ();
	}
	
	function getPrivateMessageParticipants($postId)
	{
		$query = $this->db->query ( 'SELECT * FROM user
			INNER JOIN
			(
				SELECT DISTINCT userID 
				FROM privateMessages where postID=' . $postId . 
			') as participants
			ON user.userID=participants.userID ;' );
		
		return $query->result ();
	}
	
	function getThreadFromPostID($postId) 
	{
		$query = $this->db->query ( 'select * from content
				INNER join
				(
					Select * from post
					INNER JOIN(
						SELECT childID FROM comment
						WHERE parentID = ' . $parentId .
					') as p
					ON p.childID=post.postID
				) as parents
				ON content.postID=parents.postID
				LEFT JOIN user
				on parents.userID=user.userID;' );
				
		return $query->result ();
	}
	
	function getPost($postId)
	{
		$query = $this->db->query ( 'select * from content
				INNER join
				(
					Select * from post
					WHERE postID = ' . $postId .
				') as post
				ON content.postID=post.postID
				LEFT JOIN user
				on post.userID=user.userID;' );
				
		return $query->result ();
	}
}
?>
