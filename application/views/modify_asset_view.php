
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
            <a class="brand" href="#">ADMIN</a>
           
            <div class="btn-group pull-right">
                <a class="btn" href="my-profile.html"><i class="icon-user"></i> <?php echo  ucfirst($this->session->userdata('username'));?></a>
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="my-profile.html">Profile</a></li>
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
              <li class="active"><a href="<?php echo base_url();?>asset/modify_asset">Modify Assets</a></li>
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



        <div class="span9">
          <div class="row-fluid">
            <div class="well">
              <h4>Search Asset to Modify :</h4><br>
              <form class="form-search">
                <input type="text" class="input-xlarge search-query" id="asset_tag" placeholder="Asset Tag" />
                <button type="submit" class="btn" id="search_btn">Search</button>
              </form>
              <div id="update_asset_div" style="display:none" >
                <div class="alert alert-success" id="update_success" style="display:none;">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>Well Done!</strong> Asset successfully updated.
                </div>
                <div id="modify_asset"></div>
              </div>
            </div>

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
    <script src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/additional-methods.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {

        $( "#search_btn" ).click(function(event) {
            event.preventDefault();
            id = $('#asset_tag').val();
           
             $.ajax({  
                url: "<?php echo base_url();?>asset/asset_view",
                async : true,
                type: "post",  
                data: { 
                  id: id,
                },   
                dataType: 'json',
                success: function(e) {
                //data is the html of the page where the request is made.
               
                
                  console.log(e);
                  $('#update_asset_div').show();
                  $('#modify_asset').html(e);

                  $("#update_asset").submit(function() {
                      var url = "<?php echo base_url()?>asset/update_asset"; // the script where you handle the form input.
                      $.ajax({
                             type: "POST",
                             url: url,
                             data: $("#update_asset").serialize(), // serializes the form's elements.
                             success: function(data)
                             {
                                 console.log(data); // show response from the php script.
                                 alert("Updated Successfully!");
                             }
                           });
          
                      return false; // avoid to execute the actual submit of the form.
                  });                         
                }
              });
            return false;
        });
        jQuery.validator.addMethod("phone", function (value, element) {
          return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
        }, "Enter a valid phone number.");
        

        jQuery.validator.addMethod("nameValidation", function (value, element) {
          return this.optional(element) || /^[a-z\-.,\s]+$/i.test(value);
        }, "Name must not contain special characters except comma, dash and period.");

        jQuery.validator.setDefaults({
          debug: true,
          //success: "valid"
        });
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
            //form.submit();
            var asset_code = $('#asset_code').val(); 
            var ip_address = $('#ip_address').val(); 
            var serial = $('#serial').val(); 
            var brand = $('#brand').val(); 
            var model = $('#model').val(); 
            var type = $('#type').val(); 
            var loc = $('#location').val(); 
            var status = $('#status').val(); 
            var note = $('#note').val();
            var dataString = 'asset_code=' + asset_code + '&ip_address=' +ip_address+ '&serial=' +serial+ '&brand=' +brand+ '&model=' +model+ '&type=' +type+ '&loc=' +loc+ '&status=' +status+ '&note=' +note; 
            console.log(dataString);
            $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>asset/update_asset",
              data: dataString,
              success: function(e) {
                //alert('Asset Successfully Updated!');
                //$().show();    
                console.log(e);
                $('.control-group').removeClass('error');
                $('.control-group').removeClass('success');
                $('.help-block').text(''); 
                $('#update_asset_div').toggle('fast');
              }
            });
          },
          invalidHandler: function (form) {
            //$("html, body").animate({ scrollTop: 0 }, "slow"); 
            
          },

        });
        
        
      });
      function clearInputs(data){
        $("#fetch_result :input").each(function(){
          $(this).val('');
        });
      }
    </script>
  </body>
</html>
