<?php
class Comment extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
	
	function getParentPosts() 
	{
		//$this->load->database ();
		$query = $this->db->query ( 'select * from content
				INNER join
				(
					Select * from post
					INNER JOIN
					(
						SELECT DISTINCT parentID FROM comment
					) as p
					ON p.parentID=post.postID
				) as parents
				ON content.postID=parents.postID
				LEFT JOIN user
				on parents.userID=user.userID;' );
		
		return $query->result ();
	}
	
	function getChildPosts() 
	{
		//$this->load->database ();
		$query = $this->db->query ( 'select * from content
				INNER join
				(
					Select * from post
					INNER JOIN
					(
						SELECT DISTINCT childID FROM comment
					) as p
					ON p.childID=post.postID
				) as parents
				ON content.postID=parents.postID
				LEFT JOIN user
				on parents.userID=user.userID;' );
		
		return $query->result ();
	}
	
	function getPostByUser($userId)
	{
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
	
	function createThread($parentId)
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
	
	function get_thread($parentId)
	{
		$query['parentPosts'] = $this->Comment->getPost($parentId);
		$query['childPosts'] = $this->Comment->createThread($parentId);
		$query['parentId'] = $parentId;
		return $query;
	
	}
	
	public function get_latest_group_post($userID)
	{
		$query = $this->db->query ( 'SELECT MAX(PostID) as PostID FROM clubWall
				WHERE clubID IN (
				SELECT clubID FROM membership
				WHERE userID =' . $userID .
					')' );
		$row = $query->result_array ();
		//var_dump($row[0]);
		return $row[0];
	}
	
	public function get_latest_friend_post($userID)
	{
		$query = $this->db->query ( 'SELECT MAX(PostID) as PostID FROM userWall
				WHERE userID IN (
				SELECT userID2 FROM relationship
				WHERE userID1 =' . $userID .
					')' );
		$row = $query->result_array ();
		//var_dump($row[0]);
		return $row[0];
	}
	
}
?>