<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public function __construct()
	{
		
		parent::__construct();
		//$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
//$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
//$this->output->set_header('Pragma: no-cache');
		$this->load->helper("toolbar");
		if($this->session->userdata("adminId")=="")
		redirect("admin/login");
	}
	public function makeTable($query,$tbl_header,$bool=false){
		$this->load->library("table");
		
		/*$result=array();
		$arr_top=end($tbl_header);
		if($bool!=true){
			if($query->num_rows()){
				$j=1;
				foreach($query->result_array() as $row){
					if(is_array($arr_top)){
						$btn_link=$this->make_action_button($arr_top,$row['id'],$row['status']);
						$row['action']=$btn_link;
					}
					unset($row['id'],$row['status']);
					$result[]=array_merge(array("sno"=>$j),$row);
					$j++;
				}
			}
		}
		else{
			$result=$query;
		}
		$this->set_table_template($result);

		if(is_array($arr_top)){
			array_pop($tbl_header);
			$tbl_header[]="Action";
		}
		$this->table->set_heading($tbl_header);
		$table=$this->table->generate($result);
		return $table;*/
	}
	
	public function make_action_button($action,$id,$status){
		$btn_link=array();
		for($i=0;$i<count($action);$i++){
			if($action[$i]=="Edit" || $action[$i]=="Add"){
				$btn_link[] = action_button($action[$i],$id);
			}
			if($action[$i]=="Status"){
				$status=$status=="1" ? "Active" : "Deactive";
				$btn_link[] = action_button($action[$i],$id,$status);
			}
			if($action[$i]=="Delete"){
				$btn_link[] = action_button($action[$i],$id);
			}
			if($action[$i]=="Delete_1"){
				$btn_link[] = action_button($action[$i],$id);
			}
			if($action[$i]=="Apply"){
				$btn_link[] = action_button($action[$i],$id);
			}
			if($action[$i]=="Custom"){
				$btn_link[] = action_button($action[$i],$id);
			}
			if($action[$i]=="employee_status"){
				if($status=="1")
				$status="Waiting";
				elseif($status=="2")
				$status="Selected";
				else
				$status="Joined";
				$btn_link[] = action_button($action[$i],$id,$status);
			}
		}
		return implode($btn_link);
	}
	public function set_table_template($result){
		$this->load->library("table");
		$tmpl = array ('table_open'  => '<table id="itemList" class="table table-bordered">',
						'heading_row_start'   => '<tr>',
	                    'heading_row_end'     => '</tr>',
	                    'heading_cell_start'  => '<th><a href="#" data-field="companyname" data-direction="asc">',
	                    'heading_cell_end'    => '</a></th>');
		
		
		$this->table->set_template($tmpl); 
		
	}
	public function status($id){
		$status=get_data($this->tbl,array('id'=>base64_decode($id)))->row()->status;
		$status=$status=="1" ? "0" : "1";
		$upd=update_data($this->tbl,array('status'=>$status),array('id'=>base64_decode($id)));
		$cur_url=explode("Status",current_url());
		if($upd){
			$this->session->set_flashdata('success', 'Status Updated Successfully');
			redirect("admin/".$this->router->fetch_class(),'refresh');	
		}
		else{
			$this->session->set_flashdata('error', 'Error While Update Status');
			redirect(current_url(),'refresh');	
		}
	}
	public function delete($id=FALSE){
		$delete_data=array("11","5");
		$this->db->trans_start();
		$this->db->where_in('id',$delete_data);
		$del=$this->db->delete($this->tbl);
		$err_num=$this->db->_error_number();
		$this->db->trans_complete();
		if($del){
			$this->session->set_flashdata('success', 'Record Deleted Successfully');
			redirect("admin/".$this->router->fetch_class(),'refresh');
		}
		else if($err_num=="1451"){
			$this->session->set_flashdata('error', 'Error While Delete Record');
			redirect(current_url(),'refresh');	
		}
		else{
			$this->session->set_flashdata('error', 'Error While Delete Record');
			redirect(current_url(),'refresh');	
		}
	}

	
	public function breadcrumb($arr=FALSE){
        if(is_array($this->breadcrumb)){
        	//echo end($this->breadcrumb);
        	$top_value=end($this->breadcrumb);
        	$breadCrump='<ol class="breadcrumb"><li><a href="'.site_url("admin/dashboard").'"><i class="fa fa-dashboard"></i> Home</a></li>';
			 foreach($this->breadcrumb as $key => $value){
			 	if($top_value==$value)
			 	$breadCrump.='<li class="active">'.$value.'</li>';
			 	else
				$breadCrump.='<li><a href="'.$key.'">'.$value.'</a></li>';
			}	
			$breadCrump.="</ol>";
		}
		return $breadCrump;
	}
	public function save($ins,$whr=FALSE,$unique_field=FALSE){
		if($whr==FALSE){
			$ins['created_by']=$this->session->userdata('adminId');
			$ins['updated_by']=$this->session->userdata('adminId');
			$ins['updated_date']=date("Y-m-d H:i:s");
			$ins['status']="1";
			unset($ins['submit']);
			if($unique_field!=FALSE){
				$this->checkunique($unique_field);
			}	
			$ins=insert_data($this->tbl,$ins);
			if($ins){
				$this->session->set_flashdata('success', 'Record Inserted Successfully');
				redirect("admin/".$this->router->fetch_class(),'refresh');
			}
			else{
				$this->session->set_flashdata('error', 'Error While Insert Record');
				redirect(current_url(),'refresh');	
			}
		}else{
			$ins['updated_by']=$this->session->userdata('adminId');
			$ins['updated_date']=date("Y-m-d H:i:s");
			if($unique_field!=FALSE){
				$this->checkunique($unique_field);
			}
			unset($ins['submit']);	
			$upd=update_data($this->tbl,$ins,$whr);
			if($upd){
				$this->session->set_flashdata('success', 'Record Updated Successfully');
				redirect("admin/".$this->router->fetch_class(),'refresh');	
			}
			else{
				$this->session->set_flashdata('error', 'Error While Update Record');
				redirect(current_url(),'refresh');	
			}
		}
		
	}
	public function checkunique($whr){
		$num_row=get_data($this->tbl,$whr)->num_rows();
		if($num_row){
			$this->session->set_flashdata('error', 'Name already available');
			redirect(current_url(),'refresh');	
		}
	}
	
}
