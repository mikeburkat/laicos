<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   //global $site_name;
 }

 function index()
 {
   $data['title'] = "Login Required";
   $this->load->view('templates/header',$data);
   $this->load->helper(array('form'));
   $this->load->view('home_view');
   $this->load->view('login_view');
   $this->load->view('templates/footer',$data);
 }

}

?>
