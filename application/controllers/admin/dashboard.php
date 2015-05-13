<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$basicUrl=$this->config->item("basicUrl");
		$this->parser->parse("admin/includes/header",$basicUrl);
		$this->parser->parse('admin/includes/left_side',$basicUrl);
		$this->parser->parse("admin/dashboard",$basicUrl);
		$this->parser->parse("admin/includes/footer",$basicUrl);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */