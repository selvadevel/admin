<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Table extends CI_Table {
	public function __construct()
	{
		parent::__construct();
	}
	public function create_table_header($tbl_header){
		if(is_array($tbl_header)){
			$tbl_head_template="<thead><tr><th><input type='checkbox' id='selectAll'></th>";
			$i=1;
			foreach($tbl_header as $key => $value){
				if($i=="1")
				$tbl_head_template.="<th class='sorting_asc'><a href='#' onclick='return false' data-field='".$key."'>".$value."</a></th>";
				else
				$tbl_head_template.="<th><a href='#' onclick='return false' data-field='".$key."'>".$value."</a></th>";
				$i++;
			}
			return $tbl_head_template.="</tr></thead>";
		}
	}
	public function create_table_body($tbl_body){
		if(is_array($tbl_body)){
			$tbl_body_template="<tbody><tr><td><input type='checkbox' id='selectAll'></td>";
			$i=1;
			$select_field=array_keys($tbl_body);
			$query=select_data("vehicle",$select_field);
			var_dump($query->result());
			exit;
			/*foreach($tbl_body as $key => $value){
				if($i=="1")
				$tbl_body_template.="<td class='sorting_asc'><a href='#' onclick='return false' data-field='".$key."'>".$value."</a></td>";
				else
				$tbl_body_template.="<td><a href='#' onclick='return false' data-field='".$key."'>".$value."</a></td>";
				$i++;
			}*/
			return $tbl_body_template.="</tr></tbody>";
		}
	}
	public function add_table_row($row){
		
	}
	
}
