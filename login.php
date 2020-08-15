<!doctype html>

<html>
  <head>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="bootstrap/font-awesome.min.css" />
    <link rel="stylesheet" href="custom_style.css" />
  </head>
  <body>
          
          <form action="" method="post" class="login">
            <h3 class="text-primary">ZRC</h3>
            <br><br>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user" style="width: 25px;"></i></span>
                <input type="text" class="form-control" name="username" placeholder="Enter User Name" required="true">
              </div>
              <br>
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock" style="width: 25px;"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Password" required="true">
              </div>
              <br>
              <br/>
              <div class="input-group">
                <input type="hidden" name="allowed" value="allowed">
                <input type="submit" class="form-control btn btn-primary float-right" value="signin" name="login">
                <br/><br/>
            
              </div>

          </form>
    
    <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>

<?php
include("handler.php");
?>