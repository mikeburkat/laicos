<?php

class Newsfeed_model extends CRUD_model {
	
	protected $_table = 'newsfeed';
	protected $_primary_key = 'postID';

	//-------------------------------------------------------------------------------------------------
	
	
	public function __construct() {
		parent::__construct();
	}


}