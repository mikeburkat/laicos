<?php
session_start();
class Auth_Controller extends CI_Controller{
  function __construct()
  {
    parent::__construct();
    if ( ! is_logged_in())
    {
		$this->session->set_userdata('redir', current_url());
		redirect('/login','refresh');
    }
  }
}
?>
