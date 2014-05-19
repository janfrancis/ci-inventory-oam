<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Signin</title>
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/font-awesome.min" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/signin.css" rel="stylesheet">
    <style type="text/css">
        .red {
            color: red!important;
        }
    </style>
  </head>

  <body>

    <div class="container">
      <div class="span6" align='center'><h1>OPEN ACCESS BPO</h1><h3>INVENTORY SYSTEM</h3></div><br>

    	<div class="col-md-5">
        <a href="<?php echo base_url();?>home"><img style='margin-left:200px;' width='350px'src="/CI/assets/image/taho.png"></a>
      </div>
	    	
        <div class="col-md-7">
	    			<form class="form-signin" role="form" action="<?php echo base_url();?>verify_user" method="POST">
		        		<h3 class="form-signin-heading">Login</h2>
                <?php if($this->session->flashdata('error_msg')) echo $this->session->flashdata('error_msg'); ?><br>
		        		Username: <input type="username" class="form-control" placeholder="Username" name="username" required autofocus>
			        	Password: <input type="password" class="form-control" placeholder="Password" name="password" required>
					     
               <p><a href="#">Forgot Password?</a></p>

			        
			        		<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		      		</form>
		  	</div>
      

    </div> 
  </body>
</html>