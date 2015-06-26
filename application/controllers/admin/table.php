<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Table extends My_Controller {
	
	
	
	//public static $MyMember = 99;
	public $field;
	 function __construct()
    {
        parent::__construct();
        $this->tbl="test";
        $this->tbl_config_field=array(
        							'check_box'=>TRUE,
	        						'name'=>'Company',
	        						'parent'=>'Parent Name',
	        						'id'=>'ID'
        						);
        						
       $this->field=array("shirts"=>"","username1"=>"","username"=>"","password"=>"","passconf"=>"","email"=>"");
    }
	public function index()
	{
		$tbl="";
		/*$query=$this->db->query("SELECT id,name,`desc`,DATE_FORMAT(created_date, '%d/%m/%Y') as created_date,status FROM ".$this->tbl);
		$tbl_header=array("S NO","category Name","category Desc","Created Date",array("Edit","Status","Delete"));
		$tbl=$this->makeTable($query,$tbl_header);*/
		$basicUrl=$this->config->item("basicUrl");
		$query=$this->db->query("select * from test order by name asc");
		if($query->num_rows()){
			$i=1;
			foreach($query->result() as $row){
				$tbl.="<tr><td><input type='checkbox'></td><td>".$row->name."</td><td>".$row->parent."</td></tr>";
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
	
	public function table_response(){
		
		extract($_POST);
		
		$current_page=$limit_start;
		
		$item_per_page=$limit;
		
		$page_position = (($limit_start-1) * $item_per_page);
		
		
		if(array_key_exists('check_box',$this->tbl_config_field)){

			unset($this->tbl_config_field['check_box']);
			
			$this->tbl_config_field["'check_box' as check_box"]="";
		}
	
		$result=$this->db->query("select ".implode(",",array_keys($this->tbl_config_field))." from ".$this->tbl." order by ".$order_by_name." ".$order_by." limit ".$page_position.",".$limit);
		
		$total_records=$this->db->query("select * from ".$this->tbl)->num_rows();
		
		$total_pages=ceil($total_records/$limit);
		
		echo json_encode(array('table'=>$result->result_array(),"pagination"=>$this->paginate_function($item_per_page, $current_page, $total_records, $total_pages)));
	}
	public function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
	{
		
	    $pagination = '';
	    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
	        $pagination .= '<ul class="pagination">';
	       
	        $right_links    = $current_page + 3;
	        $previous       = $current_page - 3; //previous link
	        $next           = $current_page + 1; //next link
	        $first_link     = true; //boolean var to decide our first link
	       
	        if($current_page > 1){
	            $previous_link = ($previous==0)?1:$previous;
	            $pagination .= '<li class="first"><a onclick="return false" href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
	            $pagination .= '<li><a onclick="return false" href="#" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
	                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
	                    if($i > 0){
	                        $pagination .= '<li><a onclick="return false" href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
	                    }
	                }  
	            $first_link = false; //set first link to false
	        }
	       
	        if($first_link){ //if current active page is first link
	            $pagination .= '<li class="first active"><a href="#" onclick="return false">'.$current_page.'</a></li>';
	        }elseif($current_page == $total_pages){ //if it's the last active link
	            $pagination .= '<li class="last active"><a href="#" onclick="return false">'.$current_page.'</a></li>';
	        }else{ //regular current link
	            $pagination .= '<li class="active"><a href="#" onclick="return false">'.$current_page.'</a></li>';
	        }
	        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
	            if($i<=$total_pages){
	                $pagination .= '<li><a onclick="return false" href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
	            }
	        }
	        if($current_page < $total_pages){
	        	
	                $next_link = ($i > $total_pages)? $total_pages : $i;
	                $pagination .= '<li><a  onclick="return false" href="#" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
	                $pagination .= '<li class="last"><a onclick="return false" href="#" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
	                
	        }
	       
	        $pagination .= '</ul>';
	    }
	    return $pagination; //return pagination links
	}
	public function makeTable(){
		$this->load->library("table");
		$this->set_table_template($result);
		return $this->table->set_heading($tbl_header);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
