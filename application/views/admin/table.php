 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Simple Tables
            <small>preview of simple tables</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Simple</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header">
                    <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin">
                      <li><a href="#"><span class="glyphicon glyphicon-plus"></span>New</a></li>
                      <li><a href="#"><span class="glyphicon glyphicon-edit"></span>Edit</a></li>
                      <li><a href="#"><span class="glyphicon glyphicon-copy"></span>Copy</a></li>
                      <li><a href="#"><span class="glyphicon glyphicon-ok-sign"></span>Publish</a></li>
                      <li><a href="#"><span class="glyphicon glyphicon-remove-sign"></span>Unpublish</a></li>
                      <li><a href="#"><span class="glyphicon glyphicon-trash"></span>Trash</a></li>
                      <li><a href="#"><span class="glyphicon glyphicon-empty-trash"></span>Empty trash</a></li>
                      <li><a href="#"><span class="glyphicon glyphicon-trash"></span>Show trash</a></li>
                    </ul>
                  </div>
               
                </div><!-- /.box-header -->
                <div class="box-body">
                   <div class="row margin-top-10">
                   <div class="col-xs-9">
                  		<div class="dataTables_filter" id="example1_filter">
                  			<div class="input-group">
                  				<input type="text" name="table_search" class="form-control input-sm" style="width: 150px;" placeholder="Search">
                  				<select name="example1_length" size="1" aria-controls="example1" class="form-control option-select">
                  				<option value="0" selected="selected">Select</option>
                  				<option value="1">option1</option>
                  				<option value="2">option2</option>
                  				<option value="3">option3</option>
                  				<option value="4">option4</option>
                  				<option value="5">option5</option>
                  				<option value="6">option6</option>
                  				<option value="7">option7</option>
                  				<option value="8">option8</option>
                  				<option value="9">option9</option>
                  				<option value="10">option10</option>
                  				</select>
		                      	<div class="input-group-btn" style="display:initial">
		                        	<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
		                      	</div>
		                      	<div class="input-group-btn clear-button" style="display:initial">
		                        	<button class="btn btn-sm btn-default"><i class="glyphicon glyphicon-remove"></i></button>
		                      	</div>
                    		</div>
                  		</div>
                  	</div>
                  <div class="col-xs-3">
                  		<div class="dataTables_length dataTables_filter">
                  			<select name="example1_length" size="1" class="form-control"  aria-controls="example1">
                  				<option value="10" selected="selected">10</option>
                  				<option value="25">25</option><option value="50">50</option>
                  				<option value="100">100</option>
                  			</select>
                  			<label style="float: right;font-weight: normal;">
                  			 records per page
                  			</label>
                  		</div>
                  	</div>
                  </div>
                  <table class="table table-bordered" id="itemList">
                  	<thead>
	                    <tr>
	                      <th><input type="checkbox" id="selectAll"></th>
	                      <th class="sorting_asc"><a href="#" data-field="companyname" data-direction="asc">Company<i class="icon-arrow-up-3"></i></a></th>
	                      <th><a href="#" data-field="create_date">Created_date</th>
	                      
	                    </tr>
                    </thead>
                    <tbody>
                    	<?php echo $tbl;?>
                    </tbody>
                  </table>
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