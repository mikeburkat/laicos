<?php

class Hearts_model extends CRUD_model {
	
	protected $_table = 'hearts';
	protected $_primary_key = 'postID';

	//-------------------------------------------------------------------------------------------------
	
	
	public function __construct() {
		parent::__construct();
	}


}