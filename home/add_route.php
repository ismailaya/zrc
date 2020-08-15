
<?php include("header.php"); ?>
<?php include("menu.php"); ?>

<div class="wraper">
  <div class="row container-fluid">
    <?php
    if(isset($_GET["fail"])){
      echo "<div class='text-danger'><b>".$_GET["fail"]."</b></div>";
    }


if(isset($_POST["add_route"])){
$title = $_POST["route_title"];


$sql = "INSERT INTO route VALUES(NULL,:title,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,1,1)";
$query = $pdo->prepare($sql);
$res = $query->execute(array("title"=>$title));


if($res){
  header("location:view_route.php?success=Route Added Successfull");
}
else {
  echo "<script>alert('Fail To Add Route');</script>";
}
}
?>

        <form action="" method="post" onsubmit="return validate()" name="route">
          <h4 class="text-lg">Add Route</h4>
         <div class="row container-fluid bg-f5" style="padding: 20px;">


          <br/>
          <div class="row col-lg-12">

            <div class="col-lg-3 text-red">
              <label>
                <b>Route Title:</b>
              </label>
              <input class="form-control" name="route_title" type="text" value="" placeholder="Enter Route Title" autocomplete="off">
            </div>
            

          </div>
          <br/><br/><br/><br/><br/>
          <div class="col-lg-12 text-red">
            <input type="submit" value="SAVE" class="btn btn-success" name="add_route" >
            <input type="reset" value="RESET" class="btn btn-success">
          </div>

        </div>

      </form>

      <script>
        function validate(){
          var title = document.forms.route.route_title.value;
          if(!/^\w+\-\w+$/.test(title)){
            alert("Invalid Route Format");
          }
          else{
            return true;
          }
          
          return false;
        }
      </script>

      </div>
    </div>

    <script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
