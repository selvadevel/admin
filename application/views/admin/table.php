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
                      <li><a href="<?php echo current_url().'edit';?>"><span class="glyphicon glyphicon-plus"></span>New</a></li>
                      <li id="edit-data"><a href="#"><span class="glyphicon glyphicon-edit"></span>Edit</a></li>
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
                  				<input type="text" name="word" id="word" class="form-control input-sm" style="width: 150px;" placeholder="Search">
		                      	<div class="input-group-btn clear-button" style="display:initial">
		                        	<button class="btn btn-sm btn-default" id="remove_search"><i class="glyphicon glyphicon-remove"></i></button>
		                      	</div>
                    		</div>
                  		</div>
                  	</div>
                  <div class="col-xs-3">
                  		<div class="dataTables_length dataTables_filter">
                  			<select name="example1_length" size="1" class="form-control"  aria-controls="example1" id="limit">
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
                  <?php 
                  
						$thead="";

						if(array_key_exists('check_box',$this->tbl_config_field)){

							$thead.='<th><input type="checkbox" id="selectAll"></th>';

							unset($this->tbl_config_field['check_box']);

						}
						
						$i=1;
						
						foreach($this->tbl_config_field as $key => $value){
							//($key);
							$temp = $i==1 ? '<th class="sorting_asc"><a href="#" onclick="return false" data-field="'.$key.'" data-direction="asc">'.$value.'</th>' : '<th><a href="#" onclick="return false" data-field="'.$key.'">'.$value.'</th>';
							
							$thead.=$temp;
							
							$i++;
							
						}
                   ?>
                  <table class="table table-bordered" id="itemList">
                  	<thead>
	                    <tr>
	                      <!--<th><input type="checkbox" id="selectAll"></th>
	                      <th class="asc"><a href="#" onclick="return false" data-field="id" data-direction="asc">ID<i class="icon-arrow-up-3"></i></a></th>
	                      <th><a href="#" onclick="return false" data-field="create_date">Company</th>
	                      <th><a href="#" onclick="return false" data-field="create_date">parent Name</th>-->
	                      <?php echo $thead;?>
	                    </tr>
                    </thead>
                    <tbody>
                    	
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix" id="results">
                 
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
			$('#selectAll').click (function () {
			     var checkedStatus = this.checked;
			    $('#itemList tbody tr').find('td:first :checkbox').each(function () {
			        $(this).prop('checked', checkedStatus);
			     });
			});
    	});
    </script>
    
     <script>
        $(document).ready(function(){
            site_url='<?php echo site_url();?>';
            $('#selectAll').click (function () {
                 var checkedStatus = this.checked;
                $('#itemList tbody tr').find('td:first :checkbox').each(function () {
                    $(this).prop('checked', checkedStatus);
                 });
            });
            $(document).on("click","#itemList thead tr th a",function(){
               className=$(this).closest("th").attr("class");
               $($(this).closest("thead").find("th")).each(function(){
                   $(this).attr("class","");
               });
               if(className=="sorting_asc"){
               	$(this).closest("th").addClass("sorting_desc");
			   	 $(this).closest("th").find("a").attr("data-direction","desc");
			   }
               else if(className=="sorting_desc"){
               	$(this).closest("th").addClass("sorting_asc");
               	 $(this).closest("th").find("a").attr("data-direction","asc");
			   }
               else{
               	$(this).closest("th").addClass("sorting_asc");
			   	$(this).closest("th").find("a").attr("data-direction","asc");
			   }
               post_data();
            });
            $(document).on("change","#limit",function(){
                    post_data();
                    //$("#results").on( "click", ".pagination a");
            });
            $(document).on("keyup","#word",function(){
                    post_data();
                    //$("#results").on( "click", ".pagination a");
            }) 
            $(document).on("click","#remove_search",function(){
                   $("#word").val("");
                   post_data();
                    //$("#results").on( "click", ".pagination a");
            })
            function post_data(limit_start){
                $("#itemList thead tr th").each(function(){
                    active_class=$(this).attr("class");
                    if(active_class!="" && active_class!==undefined){
                        order_by=$(this).find("a").attr("data-direction");
                        order_by_name=$(this).find("a").attr("data-field");
                    }
                });
                limit=$("#limit").val();
                if (typeof(limit_start)==='undefined')
                limit_start=1;
                word=$("#word").val();
                trHTML="";
                $.ajax({
                    url : site_url+"/admin/table/table_response",
                    type: "POST",
                    data : {order_by_name:order_by_name,order_by:order_by,limit:limit,limit_start:limit_start,word:word},
                    success: function(data)
                    {
                        trHTML="";
                        obj = JSON.parse(data);
                        $("#results").html(obj.pagination);
                        table=obj.table;
                        $.each(table, function (i, item) {
		                	trHTML += '<tr>';
		                	$.each(item, function (j, itemm) {
		                		if(j=="id")
		                		trHTML +='<td><input type="checkbox" row-id="'+itemm+'" class="checkbox"></td>';
		                		else
		                		trHTML += '<td>'+itemm+'</td>';
		                	});
		                	trHTML += '</tr>';
		                   // trHTML += '<td><input type="checkbox" id="selectAll"></td><td>' + item.id + '</td><td>' + item.name + '</td><td>' + item.parent + '</td>';
		                   
		                });
                        $("#itemList tbody").html(trHTML);
                    }
                });
            }
        $.ajax({
             url : site_url+"/admin/table/table_response",
             type: "POST",
             data:{"limit_start":"1","limit":"10",'order_by':"asc",'order_by_name':"name"},
             success: function(data){
                trHTML="";
                obj = JSON.parse(data);
                $("#results").html(obj.pagination);
                table=obj.table;
                $.each(table, function (i, item) {
                	trHTML += '<tr>';
                	$.each(item, function (j, itemm) {
                		if(j=="id")
                		trHTML +='<td><input type="checkbox" row-id="'+itemm+'" class="checkbox"></td>';
                		else
                		trHTML += '<td>'+itemm+'</td>';
                	});
                	trHTML += '</tr>';
                   // trHTML += '<td><input type="checkbox" id="selectAll"></td><td>' + item.id + '</td><td>' + item.name + '</td><td>' + item.parent + '</td>';
                   
                });
                $("#itemList tbody").html(trHTML);
            }
        });
        $("#results").on("click",".pagination a",function(){
            var page = $(this).attr("data-page");
            post_data(page);
        });
        $("#edit-data").click(function(){
		  checkbox_id=$('input:checkbox:checked').attr("row-id");
		  if(typeof checkbox_id=="undefined")
		  alert("Please select checkbox...");
		  else
		  window.location="<?php echo current_url();?>/edit/"+checkbox_id;
		});
        

        });
    </script>
