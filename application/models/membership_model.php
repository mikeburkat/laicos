<?php

class Membership_model extends CRUD_model {
	
	protected $_table = 'membership';
	protected $_primary_key = 'userID';

	//-------------------------------------------------------------------------------------------------
	
	
	public function __construct() {
		parent::__construct();
	}
	
}