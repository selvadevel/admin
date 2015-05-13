<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_data($tbl,$arr=NULL,$limit=NULL,$offset=NULL){
	$CI =& get_instance();
	$query = $CI->db->get_where($tbl, $arr, $limit, $offset);
	return $query;
}
function select_data($tbl,$arr=NULL){
	$CI =& get_instance();
	if ( ! is_null($arr)){
		$query = $CI->db->query("select ".implode(',',$arr)." from ".$tbl);
		return $query;
	}
	
}
function get_table($tbl){
	$CI =& get_instance();
	$query = $CI->db->get($tbl);
	return $query;
}
function insert_data($tbl,$arr=NULL){
	$CI =& get_instance();
	$query = $CI->db->insert($tbl, $arr);
	return $query;
}
function update_data($tbl,$arr=NULL,$upd){
	$CI =& get_instance();
	$query = $CI->db->update($tbl, $arr, $upd);
	return $query;
}
function delete_data($tbl,$arr=NULL){
	$CI =& get_instance();
	$query = $CI->db->delete($tbl,$arr); 
	return $query;
}

function send_email(){
		$CI =& get_instance();
		$CI->load->library("email");
		 if(isset($_POST['submit']))
        {      
        $username=$_POST['name'];   	
        $email=$_POST['email'];   	
        $mobile=$_POST['mobile'];   	
        $message=$_POST['message'];   	
		$subject="Your Password Details";
		$msg="<p> Dear User<br><br>
					Username: ".$username."<br><br>
					Mobile: ".$mobile."<br><br>
					Email: ".$email."<br><br>
					Description: <br><br>
					".$message." <br><br> </p>";
		$getsmtp_hostname="seeyonanimation.com";   		 
  		$getsmtp_hostpass="DS%#&2YR";   					  
  		 $getsmtp_hostusername="seeyonanimation";
		$config['protocol'] = 'smtp'; // mail, sendmail, or smtp    The mail sending protocol.
		$config['smtp_host'] = $getsmtp_hostname; // SMTP Server Address.
		$config['smtp_user'] = $getsmtp_hostusername; // SMTP Username.
		$config['smtp_pass'] = $getsmtp_hostpass; // SMTP Password.
		$config['smtp_port'] = '25'; // SMTP Port.
		$config['smtp_timeout'] = '5'; // SMTP Timeout (in seconds).
		$config['wordwrap'] = TRUE; // TRUE or FALSE (boolean)    Enable word-wrap.
		$config['wrapchars'] = 76; // Character count to wrap at.
		$config['mailtype'] = 'html'; // text or html Type of mail. If you send HTML email you must send it as a complete web page. Make sure you don't have any relative links or relative image paths otherwise they will not work.
		$config['charset'] = 'utf-8'; // Character set (utf-8, iso-8859-1, etc.).
		$CI->email->initialize($config);	 
		$CI->email->from($email);
		$CI->email->to("info@seeyonanimation.com");
		$CI->email->subject($subject);
		$CI->email->message($msg);
		$CI->email->send(); 		
			redirect("home","refresh");
		}
		else
		{
			return false;
		}	
	}
	function fileUpload($file,$target_dir){
	 $CI =& get_instance();
	 
				$ext=array("image/jpeg","image/png","image/jpg","image/gif");
				if(!in_array($file['type'],$ext)){
					$CI->session->set_flashdata('error', 'Invalid Format...');
					redirect(current_url(),'refresh');
				}
				if($file['size']>1024*1024*2){
					$CI->session->set_flashdata('error', 'Maximum file upload limit 2 MB...');
					redirect(current_url(),'refresh');
				}
				if($file["name"]!=""){
					$temp = explode(".",$file["name"]);
					$fileName = rand(1,9999999).'_.'.end($temp);
					$target_file = $target_dir .$fileName;
					move_uploaded_file($file["tmp_name"],$target_file);
					return $fileName;
				}
	}
	
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */