<?php

class Gifts_model extends CI_model {

	

	public function __construct() {
		parent::__construct();
	}
	
	public function send_gift($sender, $receiver, $gift)
	{

		$data = array(
		   'senderID' => $sender ,
		   'receiverID' => $receiver ,
		   'giftGiven' => $gift
		);

		$this->db->insert('gifts', $data); 
				
	}

}
