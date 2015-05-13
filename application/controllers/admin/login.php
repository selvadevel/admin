<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$basicUrl=$this->config->item("basicUrl");
		$basicUrl['sesMsg']="";
		$this->load->model("login_model");
		if($this->session->userdata("adminId")!="")
		redirect("admin/dashboard");
		if(isset($_POST['submit'])){
			$this->login_model->chckLogin($_POST);	
		}
		if($this->session->flashdata('errMsg')!=""){
			$basicUrl['sesMsg']='<label id="password-error" class="error" for="password">'.$this->session->flashdata("errMsg").'</label>';	
		}
		$this->parser->parse("admin/login",$basicUrl);
	}
	public function forget_password(){
		$basicUrl=$this->config->item("basicUrl");
		$this->parser->parse("admin/forget_password",$basicUrl);
	}
	public function logout(){
		update_data("tbl_users",array("updated_date"=>date("Y-m-d H:i:s")),array('id'=>$this->session->userdata('adminId')));
		$this->session->sess_destroy();
		redirect("admin/login","refresh");
	}
	/*public function viewRecordAssign(){
		return array('table'=>'tbl_record','message'=>
		)
	}
	public function addRecord(){
		$required='required="true"';
		$breadcrump="Add News Image";
		$uri=$this->uri->segment(3);
		$btn="Add";
		$title="";
		$uploadImg="";
		$yearMsg="";
		$monthMsg="";
		$volumnMsg="";
		$newsDate="";
		$hidImage="";
		if($uri){
			$required="";
			$breadcrump="Edit News Image";
			$btn="Update";
			$gerRow=get_data('tbl_record',array('id'=>$uri))->row();
			$title=$gerRow->title;
			$uploadImg=$gerRow->imageUrl;
			$yearMsg=$gerRow->year;
			$monthMsg=$gerRow->month;
			$volumnMsg=$gerRow->volumn;
			$newsDate=$gerRow->newsDate;
			$hidImage='<a class="fancybox" href="'.base_url().'uploads/'.$gerRow->thumbUrl.'"><img src="'.base_url("uploads/thumb/")."/".$gerRow->thumbUrl.'" alt="thumb" /></a>';
		}
		if(isset($_POST['submit']) && $_POST['submit']=="Update"){
			/*if($_FILES["uploadImg"]["name"]==""){
				$ext=array("image/jpeg","image/png","image/jpg","image/gif");
				if(!in_array($_FILES['uploadImg']['type'],$ext)){
					$this->session->set_flashdata('scsMsg', 'Invalid Format...');
					redirect('admin/addRecord/'.$uri,'refresh');
				}
			}*/
			/*$chckAvail=get_data('tbl_record',array('year'=>$_POST['year'],'month'=>$_POST['month'],'volumn'=>$_POST['volumn'],"id !="=>$uri));
			if($chckAvail->num_rows()){
				$this->session->set_flashdata('scsMsg', 'News image already available, Please change date or volumn...');
				redirect('admin/addRecord/'.$uri,'refresh');
			}*/
			/*if($_FILES["uploadImg"]["name"]!=""){
				$target_dir = "uploads/";
				//$fileName=microtime()."_".basename($_FILES["uploadImg"]["name"]);
				$str=preg_replace('/\s+/', '_',$_POST['title']);
				$temp = explode(".",$_FILES["uploadImg"]["name"]);
				$fileName = rand(1,99999).'_'.$str.'_'.$_POST['year'].'_'.$_POST['month'].'_'.$_POST['volumn'].'.'.end($temp);
				$target_file = $target_dir .$fileName;
				$thumb_path = $target_dir ."/thumb/".$fileName;
				move_uploaded_file($_FILES["uploadImg"]["tmp_name"],$target_file);
				$this->createThumb($target_file,$thumb_path,50,50);
			}else{
				$fileName=$_POST['hiduploadImg'];
			}
			$chckIns=update_data('tbl_record',array('title'=>$_POST['title'],'userId'=>$this->session->userdata('adminId'),'thumbUrl'=>$fileName,'imageUrl'=>$fileName,'updatedBy'=>$this->session->userdata('adminId'),'updatedDate'=>date("Y-m-d H:i:s"),'newsDate'=>$_POST['newsDate'],'year'=>$_POST['year'],'month'=>$_POST['month'],'volumn'=>$_POST['volumn']),array('id'=>$uri));
			if($chckIns){
				$this->session->set_flashdata('scsMsg', 'News Image Added Successfully...');
				redirect('admin/viewRecord','refresh');
			}
			
		}
		if(isset($_POST['submit']) && $_POST['submit']=="Add"){
			if(isset($_FILES["uploadImg"])){
				$ext=array("image/jpeg","image/png","image/jpg","image/gif");
				if(!in_array($_FILES['uploadImg']['type'],$ext)){
					$this->session->set_flashdata('scsMsg', 'Invalid Format...');
					redirect('admin/addRecord','refresh');
				}
				if($_FILES['uploadImg']['size']>20000)){
					$this->session->set_flashdata('scsMsg', 'Invalid Format...');
					redirect('admin/addRecord','refresh');
				}
			}*/
			/*$chckAvail=get_data('tbl_record',array('year'=>$_POST['year'],'month'=>$_POST['month'],'volumn'=>$_POST['volumn']));
			if($chckAvail->num_rows()){
				$this->session->set_flashdata('scsMsg', 'News image already available, Please change date or volumn...');
				redirect('admin/addRecord','refresh');
			}*/
			/*$target_dir = "uploads/";
			//$fileName=microtime()."_".basename($_FILES["uploadImg"]["name"]);
			$str=preg_replace('/\s+/', '_',$_POST['title']);
			$temp = explode(".",$_FILES["uploadImg"]["name"]);
			$fileName = rand(1,99999).'_'.$str.'_'.$_POST['year'].'_'.$_POST['month'].'_'.$_POST['volumn'].'.'.end($temp);
			$target_file = $target_dir .$fileName;
			$thumb_path = $target_dir ."/thumb/".$fileName;
			move_uploaded_file($_FILES["uploadImg"]["tmp_name"],$target_file);
			$this->createThumb($target_file,$thumb_path,50,50);
			$chckIns=insert_data('tbl_record',array('title'=>$_POST['title'],'userId'=>$this->session->userdata('adminId'),'thumbUrl'=>$fileName,'imageUrl'=>$fileName,'status'=>"1",'createdBy'=>$this->session->userdata('adminId'),'updatedBy'=>$this->session->userdata('adminId'),'updatedDate'=>date("Y-m-d H:i:s"),'created_date'=>date("Y-m-d H:i:s"),'newsDate'=>$_POST['newsDate'],'year'=>$_POST['year'],'month'=>$_POST['month'],'volumn'=>$_POST['volumn']));
			if($chckIns){
				$this->session->set_flashdata('scsMsg', 'News Image Added Successfully...');
				redirect('admin/viewRecord','refresh');
			}
			
		}
		$basicUrl=array("base_url"=>base_url(),"site_url"=>site_url(),'hidImage'=>$hidImage,'required'=>$required,'breadcrump'=>$breadcrump,'title'=>$title,'uploadImg'=>$uploadImg,'btn'=>$btn,'year'=>$this->selectBoxYear($yearMsg,$monthMsg,$volumnMsg),'newsDate'=>$newsDate);
		$this->parser->parse("admin/header",array("base_url"=>base_url(),"site_url"=>site_url()));
		$this->parser->parse("admin/addRecord",$basicUrl);
		$this->parser->parse("admin/footer",array("base_url"=>base_url(),"site_url"=>site_url()));
	}
	public function logout(){
		update_data("tbl_users",array("updated_date"=>date("Y-m-d H:i:s")),array('id'=>$this->session->userdata('adminId')));
		$this->session->sess_destroy();
		redirect("admin");
	}
	public function del(){
		$delId=$this->uri->segment(3);
		if($delId){
			$delCnf=delete_data('tbl_record',array('id'=>$delId));
			if($delCnf){
				$this->session->set_flashdata('scsMsg', 'Record Deleted Successfully...');
				redirect('admin/viewRecord','refresh');	
			}
		}
	}
	function createThumb($filepath, $thumbPath, $maxwidth, $maxheight, $quality=75)
	{   
	            $created=false;
	            $file_name  = pathinfo($filepath);  
	            $format = $file_name['extension'];
	            // Get new dimensions
	            $newW   = $maxwidth;
	            $newH   = $maxheight;

	            // Resample
	            $thumb = imagecreatetruecolor($newW, $newH);
	            $image = imagecreatefromstring(file_get_contents($filepath));
	            list($width_orig, $height_orig) = getimagesize($filepath);
	            imagecopyresampled($thumb, $image, 0, 0, 0, 0, $newW, $newH, $width_orig, $height_orig);

	            // Output
	            switch (strtolower($format)) {
	                case 'png':
	                imagepng($thumb, $thumbPath, 9);
	                $created=true;
	                break;

	                case 'gif':
	                imagegif($thumb, $thumbPath);
	                $created=true;
	                break;

	                default:
	                imagejpeg($thumb, $thumbPath, $quality);
	                $created=true;
	                break;
	            }
	            imagedestroy($image);
	            imagedestroy($thumb);
	            return $created;    
	}
	function selectBoxYear($yearMsg,$monthMsg,$volumnMsg){
		$month=array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		$curYear=date("Y");
		$selectBox='<div class="form-group"><label>Year&nbsp</label><select required="true" name="year"><option value="">select</option>';
		for($i="1940";$i<=$curYear;$i++){
			if($yearMsg==$i)
			$selectBox.='<option selected="true" value='.$i.'>'.$i.'</option>';
			else
			$selectBox.='<option value='.$i.'>'.$i.'</option>';
		}
		$selectBox.='</select>';  
		$selectBox.=' :<label> Month</label><select required="true"  name="month"><option value="">select</option>';
		for($j="0";$j<"12";$j++){
			if($monthMsg==$j)
			$selectBox.='<option  selected="true" value='.$j.'>'.$month[$j].'</option>';
			else
			$selectBox.='<option value='.$j.'>'.$month[$j].'</option>';
		}
		$selectBox.='</select>';  
		$selectBox.=' :<label> Volumn</label><select required="true"  name="volumn"><option value="">select</option>';
		for($k="1";$k<="10";$k++){
			if($volumnMsg==$k)
			$selectBox.='<option  selected="true" value='.$k.'>'.$k.'</option>';
			else
			$selectBox.='<option value='.$k.'>'.$k.'</option>';
			
		}  
		return $selectBox.='</select></div>';                                                
	}
	function getMonth($id){
		$month=array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		return $month[$id];
	}*/
	/*function changeStatus(){
		$uri=$this->uri->segment(3);
		$getRow=get_data('tbl_record',array('id'=>$uri))->row();
		if($getRow->status=="1")
		update_data('tbl_record',array('status'=>"0"),array('id'=>$uri));
		else
		update_data('tbl_record',array('status'=>"1"),array('id'=>$uri));
		redirect('admin/viewRecord','refresh');
	}*/
	/*function profile_setting(){
		$breadcrump="Change Password";
		if(isset($_POST['submit'])){
			$getRow=get_data('tbl_users',array('id'=>$this->session->userdata('adminId')))->row();
			if(md5($_POST['cpass'])==$getRow->password){
				$updCnf=update_data('tbl_users',array('password'=>md5($_POST['rnpass'])),array('id'=>$this->session->userdata('adminId')));	
				if($updCnf){
					$this->session->set_flashdata('scsMsg', 'New Password Updated Successfully...');
					redirect('admin/profile_setting','refresh');
				}
			}
			else{
				$this->session->set_flashdata('errMsg', 'Please enter valid current password...');
				redirect('admin/profile_setting','refresh');
			}
		}
		$basicUrl=array("base_url"=>base_url(),"site_url"=>site_url(),'breadcrump'=>$breadcrump);
		$this->parser->parse("admin/header",array("base_url"=>base_url(),"site_url"=>site_url()));
		$this->parser->parse("admin/profile_setting",$basicUrl);
		$this->parser->parse("admin/footer",array("base_url"=>base_url(),"site_url"=>site_url()));
	}*/
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */