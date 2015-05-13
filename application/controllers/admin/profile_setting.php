<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class profile_setting extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->breadcrumb=array("profile_setting"=>"Profile Setting");
		$this->tbl="tbl_users";
	}
	public function index()
	{
		$this->load->helper("form");
		$basicUrl=$this->config->item("basicUrl");
		$basicUrl['bread_crumb']=$this->breadcrumb();
	    $basicUrl['user_name']="";
		$basicUrl['profile_image']="";
		$basicUrl['hidImage']="";
	    if(isset($_POST['submit'])){
	    	unset($_POST['submit']);
	    	if(isset($_POST['cpass'])){
	    		unset($_POST['npass'],$_POST['rnpass']);
				$getRow=get_data($this->tbl,array('id'=>$this->session->userdata('adminId')))->row();
				if(md5($_POST['cpass'])==$getRow->password){
					$this->save(array('password'=>md5($_POST['cpass'])),array('id'=>$this->session->userdata('adminId')));
				}
				else{
					$this->session->set_flashdata('error', 'Please enter valid current password...');
					redirect(current_url(),'refresh');
				}	
			}else{
				if($_FILES['profileImg']['name']!=""){
					$scsUpload=fileUpload($_FILES["profileImg"],"uploads/profile_images/");
		    		$file_name = isset($scsUpload) ? $scsUpload : $_POST['hideImg'];	
				}else{
					$file_name = $_POST['hideImg'];
				}
				$this->save(array('userName'=>$_POST['uname'],'profile_image'=>$file_name),array('id'=>$this->session->userdata('adminId')));
			}
		}
		else{
			$getRow=get_data($this->tbl,array('id'=>$this->session->userdata('adminId')))->row();
			$basicUrl['user_name']=$getRow->userName;
			$basicUrl['profile_image']=$getRow->profile_image;
			$basicUrl['hidImage']='<a class="fancybox" href="'.base_url().'uploads/profile_images/'.$getRow->profile_image.'"><img src="'.base_url("uploads/profile_images/")."/".$getRow->profile_image.'" alt="Profile Image" style="height:100px;" /></a>';
		}
		$this->parser->parse("admin/includes/header",$basicUrl);
		$this->parser->parse("admin/includes/left_side",$basicUrl);
		$this->parser->parse("admin/profile_setting",$basicUrl);
		$this->parser->parse("admin/includes/footer",$basicUrl);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */