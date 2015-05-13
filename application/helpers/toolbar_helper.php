<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function action_button($type,$id=NULL,$status=NULL){
	$CI =& get_instance();

	if($type=="Custom"){
		return anchor($CI->router->fetch_class().'/delete/'.base64_encode($id), "<i class='fa fa-times'></i>Delete",_parse_attributes(array('class'=>'btn btn-default btn-sm','data-original-title'=>"Delete",'data-toggle'=>'tooltip')));
		//return "<a class='btn btn-default btn-sm' data-toggle='modal' data-target='#myModal_".$id."'><i class='fa fa-times' data-original-title='Delete' data-toggle='tooltip'></i>Delete</a>";
	}
	if($type=="Edit" || $type=="Add"){
		return anchor($CI->router->fetch_class().'/'.$type.'/'.base64_encode($id), "<i class='fa fa-edit'></i>",_parse_attributes(array('class'=>'btn btn-default btn-sm','data-original-title'=>$type,'data-toggle'=>'tooltip')));
	}
	if($type=="Status"){
		return anchor($CI->router->fetch_class().'/'.$type.'/'.base64_encode($id), "<i class='glyphicon glyphicon-cog'></i>",_parse_attributes(array('class'=>'btn btn-default btn-sm','data-original-title'=>$status,'data-toggle'=>'tooltip')));
	}
	if($type=="employee_status"){
		return anchor($CI->router->fetch_class().'/'.$type.'/'.base64_encode($id),$status['0'],_parse_attributes(array('class'=>'btn btn-default btn-sm','data-original-title'=>$status,'data-toggle'=>'tooltip')));
	}
	
	if($type=="Delete"){
		return "<a class='btn btn-default btn-sm' data-toggle='modal' data-target='#myModal_".$id."'><i class='fa fa-times' data-original-title='Delete' data-toggle='tooltip'></i></a><div id='myModal_".$id."' data_id=".base64_encode($id)." class='modal fade'><div class='modal-dialog'><div class='modal-content'><div class='modal-body'><button type='button' class='close' data-dismiss='modal'>&times;</button><h4>Do You Want Remove Record ?</h4></div><div class='modal-footer'><button data-dismiss='modal' type='button' class='btn btn-primary'>Cancel</button><button type='button' class='btn btn-primary delConf'>OK</button></div></div></div></div>";
	}
	if($type=="Save"){
		return '<button type="submit" class="btn btn-primary" name="submit" value="'.$type.'">'.$type.'</button>';
	}
	if($type=="Update"){
		return '<button type="submit" class="btn btn-primary" name="submit" value="'.$type.'">'.$type.'</button>';
	}
	if($type=="Cancel"){
		return '&nbsp<a href="'.site_url("admin/".$CI->router->fetch_class()).'"><button type="button" class="btn btn-primary">Cancel</button></a>';
	}
	if($type=="Apply"){
		return anchor($CI->router->fetch_class().'/'.$type.'/'.base64_encode($id), "<i class='glyphicon glyphicon-plus-sign'></i>",_parse_attributes(array('class'=>'btn btn-default btn-sm','data-original-title'=>$type,'data-toggle'=>'tooltip')));
	}
	if($type=="Select"){
		return anchor($CI->router->fetch_class().'/'.$type.'/'.base64_encode($id), "<i class='glyphicon glyphicon-ok'></i>".$type,_parse_attributes(array('class'=>'btn btn-default btn-sm','data-original-title'=>$type,'data-toggle'=>'tooltip')));
	}
	if($type=="Delete_1"){
		return anchor($CI->router->fetch_class()."/delete_employee/".base64_encode($id), "<i class='fa fa-times'></i>",_parse_attributes(array('class'=>'btn btn-default btn-sm','data-original-title'=>"Delete",'data-toggle'=>'tooltip')));
		//return "<a class='btn btn-default btn-sm' data-toggle='modal' data-target='#myModal_".$id."'><i class='fa fa-times' data-original-title='Delete' data-toggle='tooltip'></i>Delete</a>";
	}
	if($type=="Download"){
		return anchor(base_url("/uploads/resume/".$id), "<i class='glyphicon glyphicon-download-alt'></i>",_parse_attributes(array('class'=>'btn btn-default btn-sm','data-original-title'=>$status,'data-toggle'=>'tooltip')));
		//return '<a  target="_blank" href="'.base_url("/uploads/resume/".$id).'" download>Download</a>'
	}
	
}
