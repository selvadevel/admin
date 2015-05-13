<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Table extends My_Controller {
	//public static $MyMember = 99;
	public $field;
	 function __construct()
    {
        parent::__construct();
        $this->tbl="company";
       $this->field=array("shirts"=>"","username1"=>"","username"=>"","password"=>"","passconf"=>"","email"=>"");
    }
	public function index()
	{
		$tbl="";
		/*$query=$this->db->query("SELECT id,name,`desc`,DATE_FORMAT(created_date, '%d/%m/%Y') as created_date,status FROM ".$this->tbl);
		$tbl_header=array("S NO","category Name","category Desc","Created Date",array("Edit","Status","Delete"));
		$tbl=$this->makeTable($query,$tbl_header);*/
		$basicUrl=$this->config->item("basicUrl");
		$query=$this->db->query("select * from company");
		if($query->num_rows()){
			$i=1;
			foreach($query->result() as $row){
				$tbl.="<tr><td><input type='checkbox'></td><td>".$row->companyname."</td><td>".$row->created_date."</td></tr>";
				$i++;
			}
		}
		$basicUrl['tbl']=$this->config->item("basicUrl");
		$this->parser->parse('admin/includes/header',$this->config->item("basicUrl"));
		$this->parser->parse('admin/includes/left_side',$this->config->item("basicUrl"));
		$this->parser->parse('admin/table',array('tbl'=>$tbl));
		$this->parser->parse('admin/includes/footer',$this->config->item("basicUrl"));
	}

	public function edit($id=NULL){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$basicUrl['tbl']=$this->config->item("basicUrl");
		
		
		$this->set_all_rules();
		$this->manage_post_element();
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('myform');
		}
		else
		{
			$this->load->view('formsuccess');
		}
	}
	public function set_all_rules($arr=FALSE){
		
		foreach($this->field as $key => $value){
			$this->form_validation->set_rules($key, ucfirst($key), 'required');
		}
	}
	public function manage_post_element(){
		/*$field=$this->field;*/
		if ($this->form_validation->run() == FALSE)
		{
			//extract()
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */