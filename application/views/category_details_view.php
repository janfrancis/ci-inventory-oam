
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>OAMPI Inventory System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin panel developed with the Bootstrap from Twitter.">
    <meta name="author" content="travis">

    <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/site.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/DT_bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/font-awesome.css" rel="stylesheet">
    
  </head>
  <body>
   <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <!-- <a class="brand" href="#">Strass Administration</a> -->
            <a class="brand" href="#">ADMIN</a>
             <div class="btn-group pull-right">
                <a class="btn" href="my-profile.html"><i class="icon-user"></i> <?php echo  ucfirst($this->session->userdata('username'));?></a>
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url();?>profile">Profile</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url();?>logout">Logout</a></li>
              </ul>
            </div>

            <div class="nav-collapse">
              <ul class="nav">
                <li><a href="<?php echo base_url();?>dashboard">Home</a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="new-user.html">New User</a></li>
                        <li class="divider"></li>
                        <li><a href="users.html">Manage Users</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Roles <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="new-role.html">New Role</a></li>
                      <li class="divider"></li>
                      <li><a href="roles.html">Manage Roles</a></li>
                    </ul>
                </li>
                </ul>
           </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          <img style="float:left" class="brand" width='100px'src="/CI/assets/image/taho.png">
          <h2  style="text-align:left; line-height:100px;">OPEN ACCESS INVENTORY DASHBOARD</h2>
          <hr style="clear:both">
        </div>
      </div>

      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
            <?php
             if($this->session->userdata('role') == 'Admin'){
            ?>  
              <li class="nav-header"><i class="icon-wrench"></i> User</li>
              <li><a href="<?php echo base_url();?>users/add_admin">Add Admin</a></li>
              <li><a href="<?php echo base_url();?>users/add_staff">Add Staff</a></li>
            <?php }?>
              <li class="nav-header"><i class="icon-signal"></i> Assets</li>
             <?php
              if($this->session->userdata('role') == 'Admin'){
            ?>  
              <li><a href="<?php echo base_url();?>asset/add_category">Add Category</a></li>
            <?php }?>
              <li><a href="<?php echo base_url();?>asset/add_asset">Add Assets</a>
              <li><a href="<?php echo base_url();?>asset/modify_asset">Modify Assets</a></li>
            <?php
              if($this->session->userdata('role') == 'Admin'){
            ?>  
              <li><a href="<?php echo base_url();?>asset/delete_asset">Delete Assets</a></li>
            <?php }?>
              <li class="nav-header"><i class="icon-user"></i> Profile</li>
              <li><a href="<?php echo base_url();?>profile">My profile</a></li>
              <li><a href="#">Settings</a></li>
              <li><a href="<?php echo base_url();?>logout">Logout</a></li> 
            </ul>
          </div>
        </div>
        <div class="span9">
          <div class="row-fluid">
            <div class="page-header">
              <h1>Category Details<small></small></h1>
            </div>
  
          </div>
          <div class="row-fluid">
            <button class ="btn btn-danger" onclick="window.history.go(-1)" id="back_btn">Back</button>
            <button class="btn btn-info" id="add_details_btn">Add details</button>
            <button style="display:none" class="btn btn-danger" id="cancel_details_btn">Cancel</button>
            <br>
            <div style="display:none" id="add_details">
              <br>

             <!--  <div class="alert alert-info">Detail type :  </div> -->
              <form class="form-horizontal" id="details_form" method="post" action="<?php echo base_url().'asset/add_category_details' ?>">
                <input type="hidden" value="<?php echo base64_decode(base64_decode($this->uri->segment(3))); ?>" name="category_id">
                <div class="control-group">
                  <label class="control-label">Detail name</label>
                  <div class="controls">
                    <input type="text" name="detail_name" id="detail_name">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Detail type</label>
                  <div class="controls">
                    <select name="detail_type">
                      <option value=""></option>
                      <option value="text">text</option>
                      <option value="select">select</option>
                    </select> 

                  </div>
                </div>
                <div class="control-group" id="default_values">
                  <label class="control-label">Default Values</label>
                  <div class="controls">
                    <input type="text" name="detail_values">
                    <span class="help-block">Separate values by comma(s). e.g.: asset code, capacity</span>
                  </div>

                </div>                
                <div id="detail_value"></div>
                <div class="form-actions">
                  <input type="submit" class="btn btn-success" value="Add Category Detail" />
                  <input type="reset" class="btn btn-default" value="Reset" />
                </div>  
        
              </form>
            </div>
            <br>

            <table id="category_details" class="table table-striped table-bordered dataTable">
              <thead>
                <tr>
                   <th></th>
                   <th>Detail</th>
                   <th>Type</th>
                   <th>Default Value</th>
                   <th></th>  
                </tr>
              </thead>
              <tbody>
                <?php if(isset($record)) : foreach($record as $row) : ?>
                  <tr>
                    <td><?php echo $row->category_field_id?></td>
                    <td><?php echo $row->category_field_name?></td>
                    <td><?php echo $row->category_field_type?></td>
                    <td><?php echo $row->category_field_default?></td>
                    <td>
                      <button onclick="edit_category_field('<?php echo $row->category_field_id?>');" class="btn btn-small btn-success" title="Edit"><i class="fa fa-pencil"></i></button>
                      <button onclick="delete_category_field('<?php echo $row->category_field_id?>');" class="btn btn-small btn-danger" title="Delete"><i class="fa fa-times"></i></button>
                    </td>

                  </tr>
                <?php endforeach;?>
                <?php endif; ?>
              </tbody>
            </table>
          
          </div>
        </div>
      </div>

     </div>
      <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 id="myModalLabel">Edit</h3>
        </div>
        <div class="modal-body">
          <div id="edit_form"></div>
        </div>
        <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
          <button class="btn btn-primary" id="edit_btn_save">Save changes</button>
        </div>
      </div>
      
      <hr style="margin-top:100px;">
      <footer class="well">
        &copy; OAMPI
      </footer>

    </div>

    <script src="<?php echo base_url();?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.maskedinput.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/additional-methods.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/js/DT_bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.base64.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#default_values").hide();
        var oTable =  $('#category_details').dataTable({
        "aoColumns": [
          {"bVisible":false},null,null,null,
          { "bSortable": false },
        ],
        
      });
        jQuery.validator.setDefaults({
          debug: true,
          //success: "valid"
        });
        $('#add_user').validate({
          errorElement: 'span',
          errorClass: 'help-inline',
          focusInvalid: false,
          rules: {
            
          },
       
          messages: {
           
          },
      
          invalidHandler: function (event, validator) { //display error alert on form submit   
            $('.alert-error', $('.login-form')).show();
          },
      
          highlight: function (e) {
            $(e).closest('.control-group').removeClass('success').addClass('error');
          },
      
          success: function (e) {
            $(e).closest('.control-group').removeClass('error').addClass('success');
            $(e).remove();
          },
      
          errorPlacement: function (error, element) {
         

            if(element.is(':checkbox') || element.is(':radio')) {
              var controls = element.closest('.controls');
              if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
              else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
              error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chzn-select')) {
              error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
            }
            else error.insertAfter(element);
          },
          showErrors: function(errorMap, errorList) {
            $("#summary").html("<div class=\"alert alert-error\">Your form contains "
              + this.numberOfInvalids()
              + " errors, see details below.</div>");
              this.defaultShowErrors();
          },
          submitHandler: function (form) {
            alert("Processing ...");
            form.submit();

          },
          invalidHandler: function (form) {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            
          },

        });
      
        $( "#add_details_btn" ).click(function() {
           $('#add_details').toggle();
           $('#add_details_btn').hide();
           $('#cancel_details_btn').show();
           $('#details_form')[0].reset();
        });
        $( "#cancel_details_btn" ).click(function() {
           $('#add_details').toggle();
           $('#add_details_btn').show();
           $('#cancel_details_btn').hide();
           $('#details_form')[0].reset();
        });
      });
  
      $("select[name='detail_type']").change(function() {
        if($("select[name='detail_type']").val()=="select") {
          $("#default_values").show();
        }
        else {
          $("#default_values").hide();
        }
      });
    
    $( "#edit_btn_save" ).click(function(){
      
    })

    var edit_category_field = function(e){
      //alert(e);
      $.ajax({
            url: "<?php echo base_url();?>asset/view_category_field",
            type: "post",  
            data: { 
              id: e,
            },
            dataType: 'json',
            success: function(e) {
              console.log(e);
              $('#add_details').hide();
              $('#cancel_details_btn').hide();
              $('#add_details_btn').show();
              $("#edit_form").html(e);
              $("#myModal").modal("show");
            }
          })   
    
    }
    var delete_category_field = function(e){
      //alert(e);
      bootbox.confirm("Are you sure?", function(confirmed) {
        console.log("Confirmed: "+confirmed);
        if(confirmed == true){
           $.ajax({
              url: "<?php echo base_url();?>asset/delete_category_field",
              type: "post",  
              data: { 
                id: e,
              },
              success: function(e) {
                alert('Delete Successfully!');
                location.reload();
              }
            })   
        } 
        else
        {

        } 
      });
    }
    </script>
  </body>
</html>
