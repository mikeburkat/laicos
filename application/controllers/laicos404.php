<?php
class laicos404 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		//global $site_name;
    }

    public function index()
    {

        $this->output->set_status_header('404');
        $this->load->view('templates/header');
        $this->load->view('error_view');//loading in my template
        $this->load->view('templates/footer');
    }
}
?>
