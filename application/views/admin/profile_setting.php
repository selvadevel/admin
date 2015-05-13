<script type="text/javascript" src="{base_url}js/jquery.validate.js"></script>
        <!-- page script -->
    <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><?php echo reset($this->breadcrumb);?>
                       <!-- <small>Control panel</small>-->
                    </h1>
                    <ol class="breadcrumb">
                         {bread_crumb}
                    </ol>
                </section>
        		<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title"><?php echo end($this->breadcrumb);?></h3>                                    
                                </div><!-- /.box-header -->
                                <?php 
                                 $this->load->view('admin/includes/message');
                                ?>
                                <!-- form start -->
                                <form action="" method="POST" id="basic_info" name="basic_info" enctype="multipart/form-data">
                                <div class="box-body">
                                        <div class="form-group">
                                            <label>User Name</label><span class="required" aria-required="true">*</span>
                                            <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter User Name" value="{user_name}">
                                        </div>
                                         <div class="form-group">
                                            <label >Profile Image</label><span class="required" aria-required="true">*</span>
                                            <input type="file"  name="profileImg">
                                            <input type="hidden"  name="hideImg" value={profile_image}>
                                        </div>
                                        {hidImage}
				                            <!--<img alt="User Image" id="imageDiv" style="height: 80px;" src="<?php echo base_url('img/user.jpg');?>">-->
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                         <?php 
                                        echo action_button("Update");
		                                 echo action_button("Cancel");
                                        ?>
                                    </div>
                                </form>
                                <div class="box-header">
                                    <h3 class="box-title">Change Password</h3>
                                </div><!-- /.box-header -->
                                <form action="" method="POST" id="profile_setting" name="profile_setting" >
                                   <div class="box-body">
                                        <div class="form-group">
                                            <label >Current Password</label><span class="required" aria-required="true">*</span>
                                            <input type="password" class="form-control" id="cpass" name="cpass" placeholder="Enter Current Password">
                                        </div>
                                         <div class="form-group">
                                            <label >New Password</label><span class="required" aria-required="true">*</span>
                                            <input type="password" class="form-control" id="npass" name="npass" placeholder="Enter New Password">
                                        </div>
                                        <div class="form-group">
                                            <label >Re-enter New Password</label><span class="required" aria-required="true">*</span>
                                           <input type="password" class="form-control" id="rnpass" name="rnpass" placeholder="Re-enter New Password">
                                        </div>
				                            <!--<img alt="User Image" id="imageDiv" style="height: 80px;" src="<?php echo base_url('img/user.jpg');?>">-->
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <?php 
                                        echo action_button("Update");
		                                 echo action_button("Cancel");
                                        ?>
                                    </div> 
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
                <!-- Main content -->
          
            </aside><!-- /.right-side -->   
<script>
	$(document).ready(function(){
		$('#profile_setting').validate({
		            rules : {
		                cpass : {
		                	required: true,
		                    minlength : 5
		                },
		                npass : {
		                	required: true,
		                    minlength : 5
		                },
		                 rnpass : {
		                	required: true,
		                    minlength : 5,
		                    equalTo : "#npass"
		                },
		            }	
            	});
            	$('#basic_info').validate({
		            rules : {
		                uname : {
		                	required: true,
		                    minlength : 5
		                },
		            }	
            	});
	})
</script>