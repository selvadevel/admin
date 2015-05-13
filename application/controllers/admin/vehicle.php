<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicle extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->tbl="vehicle";
		$this->breadcrumb=array($this->router->fetch_class()=>"Manage Vehicle","vehicle"=>"View Vehicle");
	}
	public function index()
	{
		$basicUrl=$this->config->item("basicUrl");
		$basicUrl['bread_crumb']=$this->breadcrumb();
		$this->table->create_table_header(array('name'=>"Vehicle Name",'description'=>"Description",'number'=>"Vehicle No"));
		$this->table->create_table_body(array('name'=>"Vehicle Name",'description'=>"Description",'number'=>"Vehicle No"));
		exit;
		$tbl_header=array("S NO","Vehicle Name","Vehicle Description","Created Date",array("Edit","Status","Delete"));
		$basicUrl['table']=$this->makeTable($query,$tbl_header);
		$this->parser->parse("admin/includes/header",$this->config->item("basicUrl"));
		$this->parser->parse("admin/includes/left_side",$this->config->item("basicUrl"));
		$this->parser->parse("admin/center",$basicUrl);
		$this->parser->parse("admin/includes/footer",$this->config->item("basicUrl"));
	}
	public function edit($id=FALSE){
		$this->breadcrumb=array($this->router->fetch_class()=>"Manage Vehicle","vehicle"=>"Add Vehicle");
		$basicUrl=$this->config->item("basicUrl");
		if($id){
			$row=get_data($this->tbl,array('id'=>base64_decode($id)))->row();
			$location_name=$row->name;
			$location_desc=$row->desc;
			$this->breadcrumb=array($this->router->fetch_class()=>"Manage Vehicle","vehicle"=>"Edit Vehicle");
		}else{
			$location_name="";
			$location_desc="";
		}
		if(isset($_POST['submit'])){
			if($_POST['submit']=="Save")
			$this->save($_POST,FALSE,array("name"=>$_POST['name']));
			else
			$this->save($_POST,array('id'=>base64_decode($id)),array('id <> '=>base64_decode($id),"name"=>$_POST['name']));
		}
		$basicUrl['bread_crumb']=$this->breadcrumb($this->breadcrumb);
		$basicUrl['location_name']=$location_name;
		$basicUrl['location_desc']=$location_desc;
		$this->parser->parse("admin/header",$this->config->item("basicUrl"));
		$this->parser->parse("admin/add_location",$basicUrl);
		$this->parser->parse("admin/footer",$this->config->item("basicUrl"));
	}
	
}