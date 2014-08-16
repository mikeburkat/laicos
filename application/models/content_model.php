<?php

class Content_model extends CRUD_model {
	
	protected $_table = 'content';
	protected $_primary_key = 'postID';

	//-------------------------------------------------------------------------------------------------
	
	
	public function __construct() {
		parent::__construct();
	}


}