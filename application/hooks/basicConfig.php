<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class basicConfig extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

	}
	public function index()
	{
		$this->config->set_item('basicUrl', array("base_url"=>base_url(),"site_url"=>site_url()));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */