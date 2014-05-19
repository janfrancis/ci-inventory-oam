
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
                <a class="btn" href="my-profile.html"><i class="icon-user"></i> <?php echo  ucfirst($this->session->userdata('fname'));?></a>
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
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="new-user.html">Admin</a></li>
                        <li class="divider"></li>
                        <li><a href="users.html">Staff</a></li>
                    </ul>
                </li>
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
              <!--<li><a href="<?php echo base_url();?>users/delete_user">Delete User</a></li>-->
              
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
              <li><a href="<?php echo base_url();?>profile">My profile</a></li>
              <li><a href="<?php echo base_url();?>logout">Logout</a></li> 
            </ul>
          </div>
        </div>
        <div class="span9">
          <div class="row-fluid">
            <div class="well hero-unit">
            <h1>Welcome, <?php echo  ucfirst($this->session->userdata('username'));?></h1>
            <br><p>Have a nice day!</p>
            <p><a class="btn btn-success btn-large" href="users.html">Manage Users &raquo;</a></p>
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
    <script type="text/javascript">
      $(document).ready(function() {
          $('#chk_advance').change(function() {
           
              if($(this).is(":checked")) {
                $('#advance_search').slideDown();
              }
              else{
                $('#advance_search').toggle();
              }
          });
      });
    </script>
  </body>
</html>
