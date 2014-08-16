<?php

class User_Wall_model extends CRUD_model {
	
	protected $_table = 'userWall';
	protected $_primary_key = 'userID';

	//-------------------------------------------------------------------------------------------------
	
	
	public function __construct() {
		parent::__construct();
	}


}