 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo reset($this->breadcrumb);?>
            <!--<small>preview of simple tables</small>-->
          </h1>
          <ol class="breadcrumb">
             {bread_crumb}
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo end($this->breadcrumb);?></h3>
                  <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin pull-right">
                      <li><a href="#">ADD</a></li>
                      <li><a href="#">Edit</a></li>
                      <li><a href="#">Delete</a></li>
                      <li><a href="#">Trash</a></li>
                    </ul>
                  </div>
               
                </div><!-- /.box-header -->
                <div class="box-body">
                   <div class="row">
                   <div class="col-xs-6">
                  		<div class="dataTables_filter" id="example1_filter">
                  			<div class="input-group">
		                      	<input type="text" name="table_search" class="form-control input-sm" style="width: 150px;" placeholder="Search">
		                      	<div class="input-group-btn" style="display:initial">
		                        	<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
		                      	</div>
                    		</div>
                  		</div>
                  	</div>
                  	<div class="col-xs-6">
                  		<div class="dataTables_length dataTables_filter">
                  			<label style="float: right;font-weight: normal;">
                  				<select name="example1_length" size="1" aria-controls="example1" id="limit">
                  					<option value="10" selected="selected">10</option>
                  					<option value="25">25</option><option value="50">50</option>
                  					<option value="100">100</option>
                  				</select> records per page
                  			</label>
                  		</div>
                  	</div>
                  </div>
                 {table}
                 <!-- <input type="hidden" name="limit_end" id="limit_end" value="<?php echo $limit_end; ?>"/>
                  <input type="hidden" name="order" id="order" value="<?php echo $order; ?>"/>
                  <input type="hidden" name="order_type" id="order_type" value="<?php echo $order_type; ?>"/>
                  <input type="hidden" name="limit_start" id="limit_start" value="<?php echo $limit_start; ?>"/>-->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul>
                </div>
              </div><!-- /.box -->

             
            </div><!-- /.col -->
           
          </div><!-- /.row -->
         
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
    <!-- jQuery 2.1.3 -->
    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script>
    	$(document).ready(function(){
    		site_url='<?php echo site_url();?>';
    		$.ajax({
			    url : site_url+"/admin/table",
			    type: "POST",
			    data : {order:"asc"},
			    success: function(data, textStatus, jqXHR)
			    {
			        //data - response from server
			    }
			});
			$('#selectAll').click (function () {
			     var checkedStatus = this.checked;
			    $('#itemList tbody tr').find('td:first :checkbox').each(function () {
			        $(this).prop('checked', checkedStatus);
			     });
			});
			$("#itemList thead tr th a").click(function(){
				alert()
			});
    	});
    </script>
    <script>
	$(document).ready(function() {
		$("#example1").dataTable({
        	"iDisplayLength": 10,
        	"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
        });
		site_url="<?php echo $this->router->fetch_class();?>";
		$(document).on("click",".delConf",function(){
		    delId=$(this).closest(".modal").attr('data_id');
		    window.location = site_url+"/delete/"+delId;
		});	
	});
</script> 