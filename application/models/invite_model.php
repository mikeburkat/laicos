<?php

class Invite_model extends CRUD_model {
	
	protected $_table = 'invites';
	protected $_primary_key = 'invited';

	//-------------------------------------------------------------------------------------------------
	
	
	public function __construct() {
		parent::__construct();
	}


}