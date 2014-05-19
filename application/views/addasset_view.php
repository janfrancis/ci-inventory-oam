
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
                <a class="btn" href="my-profile.html"><i class="icon-user"></i> <?php echo  ucfirst($this->session->userdata('fname'));?></a>
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
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Assets <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="new-user.html">Asset 1</a></li>
                        <li class="divider"></li>
                        <li><a href="users.html">Asset 2</a></li>
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
              <li class="active"><a href="<?php echo base_url();?>asset/add_asset">Add Assets</a></li>
              <li><a href="<?php echo base_url();?>asset/modify_asset">Modify Assets</a></li>
            <?php
              if($this->session->userdata('role') == 'Admin'){
            ?>  
              <li><a href="<?php echo base_url();?>asset/delete_asset">Delete Assets</a></li>
            <?php }?>
              <li class="nav-header"><i class="icon-user"></i> Profile</li>
              <li><a href="<?php echo base_url();?>profile">My profile</a></li>
              <li><a href="<?php echo base_url();?>logout">Logout</a></li> 
            </ul>
          </div>
        </div>

        <div class="span2">
          <h1>IT Assets</h1>
              <div class="controls">
                      <select id="select" class="input-medium" name="category">
                         <option value="" title="null">--Choose Category--</option>
                        <?php if(isset($records)) : foreach($records as $row) : ?>
                          <option value="<?php echo $row->category_id;?>"><?php echo $row->category_name;?></option>
                        <?php endforeach;?>
                        <?php endif; ?>
                      </select>
                  </div>
              </div>



        <div class="span7">
          <div class="row-fluid">
            <div class="page-header">   
               <?php 
                  if ($message == null){

                }
                else{
                 /* echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                  echo '<div class="alert alert-danger">';
                   echo $message;
                  echo '</div>';*/
                  echo $message;
                } 

                ?>
                 <div id="asset_form"></div>  
    
              
          </div>
          <div class="row-fluid">
            
          </div>
        </div>
      </div>

      <div class="row-fluid" id="show_asset" style="display:none;">
          
        <div class="span12">
          <div class="page-header">
            <h1>Asset</h1>
          </div>
            <div id="table_result"></div>
        </div>
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
    <script type="text/javascript">
      $(document).ready(function() {
       
        $('#select').change(function(){

          var asset =  $(this).find("option:selected").attr('value');
          //alert(asset); 
          $.ajax({
              url: "<?php echo base_url();?>asset/asset_form",
              type: "post",  
              data: { 
                asset: asset,
              },   
              dataType: 'json',
              success: function(e) {
                console.log(e);
                $('#asset_form').html(e['asset_form']);
                $('#show_asset').show();
                $('#table_result').html(e['asset_table']);
                $('#table_asset').dataTable();

                $('#add_asset').validate({
                    errorElement: 'span',
                    errorClass: 'help-inline',
                    focusInvalid: false,
                    rules: {
                      asset_code: {
                        required: true,
                        remote: {
                          url: "<?php echo base_url();?>asset/asset_code_exist",
                          type: "post",
                          data: {
                            username: function() {
                              return $( "#asset_code" ).val();
                            }
                          }
                        }
                      },
                      i_p_address: {
                        //required: true,
                        ipv4 : true,  
                      },
                      
                    },
                 
                    messages: {
                      asset_code: {
                        remote : "This asset code is not available.",
                      }
                      
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
                      //alert("Add Successfully");
                      form.submit();
           
                    },
                    invalidHandler: function (form) {
                      //$("html, body").animate({ scrollTop: 0 }, "slow"); 
                      
                    },

                  });
              }
          })
        });


        
      
      });
    </script>
  </body>
</html>
