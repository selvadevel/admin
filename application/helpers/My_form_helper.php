<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function form_error($field = '', $prefix = '', $suffix = '')
	{
		if(isset($_POST['manual_post']))
		{
			return '';
		}
		
		if (FALSE === ($OBJ =& _get_validation_object()))
		{
			return '';
		}
		
		return $OBJ->error($field, $prefix, $suffix);
	}
function set_field_value($field = '', $default = '')
	{
		$CI =& get_instance();
		//echo $field;
		$id=$CI->uri->segment(3);
		if($id!=NULL && count($_POST)==0){
			$_POST[$field]=get_data($CI->tbl,array('id'=>$id))->row()->$field;
			/*$_POST['manual_post']="selva";
			$_POST['username']="selva";*/
		}
		if (FALSE === ($OBJ =& _get_validation_object()))
		{
			if ( ! isset($_POST[$field]))
			{
				return $default;
			}

			return form_prep($_POST[$field], $field);
		}

		return form_prep($OBJ->set_value($field, $default), $field);
	}