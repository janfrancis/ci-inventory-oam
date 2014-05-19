
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
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="<?php echo base_url();?>login">Admin</a></li>
              <li><a href="<?php echo base_url();?>login">Staff</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>


    <div class="container-fluid a">
      <div class="row-fluid">
        <div class="">
          <div align="center">
             <img width='350px'src="/CI/assets/image/taho.png"></a>

          </div>
          <div><strong><p align='center' style="font-size:25px" >OPEN ACCESS BPO</p></strong></div>
        </div>

      </div>
      <div class="row-fluid">
        <div class="span-12">
         <form class="form-inline" role="search">
            <div class="center" align="center">
              <input type="text" name="search" class="form-control" placeholder="Enter Asset Code" required/>
              <a onclick="submitSearch(); return false;" class="btn btn-default">Search</a>
              <div class="checkbox" style="margin-left:-175px;">
                <label>
                  <input type="checkbox" id="chk_advance"> Advance search
                  <input type="hidden" name="is_advance" value="inactive">
                </label>
              </div>
            </div>
          </form>
          <div class="row-fluid">
            <div class="span-3">
               <div id="advance_search" style="display:none;margin-left:auto;margin-right:auto;width:40%;">
                <form class="form-horizontal">
                  <fieldset>
                    <div class="control-group">
                      <label class="control-label" for="name">Keyword:</label>
                      <div class="controls">
                        <input type="text" class="input-medium" id="keyword" name="keyword">
                      </div>
                    </div>
                     
                     <div class="control-group">
                      <label class="control-label" for="name">Brand:</label>
                      <div class="controls">
                        <input type="text" class="input-medium" id="brand" name="brand">
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="name">Model:</label>
                      <div class="controls">
                        <input type="text" class="input-medium" id="model" name="model">
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label" for="name">Location:</label>
                      <div class="controls">
                        <input type="text" class="input-medium" id="location" name="location">
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label" for="name">Accountability:</label>
                      <div class="controls">
                        <input type="text" class="input-medium" id="accountability" name="accountability">
                      </div>
                      </div>
                      <div class='inline' align='left'>
                          <button class="btn btn-danger" style="margin-left:200px;"type="reset">Reset</button>
                          <a onclick="submitSearch(); return false;" class="btn btn-default">Search</a>
                        
                      </div>
                          
                  </fieldset>
                </form>
              </div>
              <div id="results"></div>
              <div id="results2" style="display:none;"></div>
            </div>
          </div>
         
        </div>

      </div>    
    </div>

    <div class="container-fluid">
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
                $('input[name="is_advance"]').val("active");
              }
              else{
                $('#advance_search').toggle();
                $('input[name="is_advance"]').val("inactive");
              }
          });

      }); 
      var submitSearch = function()
      {
        if($('input[name="is_advance"]').val()!='active') {
          if($('input[name="search"]').val().trim()=='')
          {
            alert('Please enter asset code');
            return false;
          }
        }

        $.ajax({
            url: "<?php echo base_url();?>home/search",
            type: "post",  
            data: { 
              search: $('input[name="search"]').val(),
              is_advance: $('input[name="is_advance"]').val(),
              keyword: $('input[name="keyword"]').val(),
              model: $('input[name="model"]').val(),
              brand: $('input[name="brand"]').val(),
              location: $('input[name="location"]').val(),
              accountability: $('input[name="accountability"]').val()
            },
            success: function(e) {
              $("#results").html(e);
              console.log(e);
            }
          });
      } 
      $('input').keypress(function(e)
      {
        if(e.which == 13) {
          submitSearch();
        }
      });
      var showDetails = function (num) {
        $.ajax({
            url: "<?php echo base_url();?>home/search_details",
            type: "post",  
            data: { 
              search: $('input[name="search"]').val(),
              is_advance: $('input[name="is_advance"]').val(),
              keyword: $('input[name="keyword"]').val(),
              model: $('input[name="model"]').val(),
              brand: $('input[name="brand"]').val(),
              location: $('input[name="location"]').val(),
              accountability: $('input[name="accountability"]').val(),
              id: num
            },
            success: function(e) {
              $("#results2").html(e);
              $('.modal-body').html(e);
              console.log(e);
            }
          });
        //$('.modal-body').html($('#'+value).html());
      }
    </script>
  </body>
</html>
 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Asset details</h3>
  </div>
  <div class="modal-body">
    
  </div>
  <div class="modal-footer">
    <button class="btn btn-success" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
