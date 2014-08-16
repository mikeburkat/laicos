<?php

class Comment_model extends CRUD_model {
	
	protected $_table = 'comment';
	protected $_primary_key = 'parentID';

	//-------------------------------------------------------------------------------------------------
	
	
	public function __construct() {
		parent::__construct();
	}


}