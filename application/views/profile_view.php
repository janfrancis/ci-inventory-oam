
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
            <a class="brand" href="<?php echo base_url();?>dashboard">ADMIN</a>
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
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Assets<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <?php if(isset($records)) : foreach($records as $row) : ?>
                      <li><a href="<?php echo base_url().'category/asset_list/'.$row->category_id;?>"><?php echo $row->category_name;?></a> </li>
                    <?php endforeach;?>
                    <?php endif; ?>
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
              <li><a href="<?php echo base_url();?>asset/add_asset">Add Assets</a></li>
              <li><a href="<?php echo base_url();?>asset/modify_asset">Modify Assets</a></li>
            <?php
              if($this->session->userdata('role') == 'Admin'){
            ?>  
              <li><a href="<?php echo base_url();?>asset/delete_asset">Delete Assets</a></li>
            <?php }?>
              <li class="nav-header"><i class="icon-user"></i> Profile</li>
              <li class="active"><a href="<?php echo base_url();?>profile">My profile</a></li>
              <li><a href="<?php echo base_url();?>logout">Logout</a></li> 
            </ul>
          </div>
        </div>
        <div class="span9">
          <div class="row-fluid">
            <div class="page-header">
              <h1>My profile <small>Update info</small></h1>
            </div>
            <?php if(isset($records2)) : foreach($records2 as $row) : ?>
            <form class="form-horizontal" id="profile-form" method="POST" action="<?php echo base_url();?>profile">
               <?php 
                if ($message == null){

                }
                else{
                  /*echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                  echo '<div class="alert alert-danger">';
                   echo $message;
                  echo '</div>';*/
                  echo $message;
                  }

                ?>

              <fieldset>
                <div class="control-group">
                  <label class="control-label" for="fname">First name</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="fname" name="fname" value="<?php echo $row->fname;?>"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="lname">Last name</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="lname" name="lname" value="<?php echo $row->lname;?>"/>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label" for="department">Department</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="department" name="department" value="<?php echo $row->department;?>"/>
                  </div>
                </div>
                 <div class="control-group">
                  <label class="control-label" for="email">E-mail</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="email" name="email" value="<?php echo $row->email;?>"/>
                  </div>
                </div>
                 <div class="control-group">
                  <label class="control-label" for="phone">Phone</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="phone" name="phone" value="<?php echo $row->phone;?>"/>
                  </div>
                </div>
                <div class="form-actions">
                  <input type="submit" class="btn btn-success" value="Save Changes" />
                </div>          
              </fieldset>
            </form>
            <?php endforeach;?>
            <?php endif; ?>
          </div>
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
    <script type="text/javascript">
      $(document).ready(function() {
        jQuery.validator.addMethod("phone", function (value, element) {
          return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
        }, "Enter a valid phone number.");
        

        jQuery.validator.addMethod("nameValidation", function(value, element) {
          return this.optional(element) || /^[a-z\-.,\s]+$/i.test(value);
        }, "Name must not contain special characters except comma, dash and period.");

        jQuery.validator.setDefaults({
          debug: true,
          //success: "valid"
        });
        $('#profile-form').validate({
          errorElement: 'span',
          errorClass: 'help-inline',
          focusInvalid: false,
          rules: {
            fname: {
              required: true,
              minlength:2,
              nameValidation:true,
            },
            lname: {
              required: true,
              minlength:2,
              nameValidation:true,
            },
            department: {
              required: true,

            },
            
            email: {
              required: true,
              email:true,
              
            },
            
          },
      
          messages: {
            fname: {
              minlength: jQuery.format("At least {0} characters required."),

            },
            lname: {
              minlength: jQuery.format("At least {0} characters required."),
            },
            middle_name: {
              minlength: jQuery.format("At least {0} characters required."),
            },
            email: {
              required: "Please provide a valid email.",
              email: "Please provide a valid email.",
              remote: "This email is not available.",
            },
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
            //alert('SUBMIT FORM');
            form.submit();

          },
          invalidHandler: function (form) {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            
          },

        });
      
        
      });
    </script>
  </body>
</html>
