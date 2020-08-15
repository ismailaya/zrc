
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>

    <div class="wraper">
      <div class="row container-fluid">
        <?php
        if(isset($_GET["fail"])){
          echo "<div class='text-danger'><b>".$_GET["fail"]."</b></div>";
        }

        if(isset($_POST["edit_route"])){
          $title = $_POST["title"];
          $id = $_POST["route_id"];
          $sql = "UPDATE route SET route_title = :title WHERE route_id=:id";
          $query = $pdo->prepare($sql);
          $res = $query->execute(array("title"=>$title,"id"=>$id));

          if($res){
            header("location:view_route.php?success=Route Changed Successfull");
          }
          else {
            echo "<script>alert('Fail To Delete Route');</script>";
          }
        }


        if(isset($_POST["id_to_edit"])){

        ?>

        <form action="" method="post" onsubmit="return validate()" name="route">
          <h4 class="text-lg">Edit Route</h4>
         <div class="row container-fluid bg-f5" style="padding: 20px;">


          <br/>
          <div class="row col-lg-12">

            <div class="col-lg-3 text-red">
              <label>
                <b>Route Title:</b>
              </label>
              <input class="form-control" name="route_id" type="text" value="<?php echo $_POST["id_to_edit"];?>" style="display: none;">
              <input class="form-control" name="title" type="text" value="<?php echo $_POST['title'];?>" placeholder="Enter Route Name" required="true" autocomplete="off">
            </div>

          </div>
          <br/><br/><br/><br/><br/>
          <div class="col-lg-12 text-red">
            <input type="submit" value="SAVE" class="btn btn-success" name="edit_route" >
            <input type="reset" value="RESET" class="btn btn-success">
          </div>

        </div>

      </form>

      <script>
        function validate(){
          var title = document.forms.route.title.value;
          if(!/^\w+\-\w+$/.test(title)){
            alert("Invalid Route Format");
          }
          else{
            return true;
          }
          
          return false;
        }
      </script>

      <?php
        }
      ?>

      </div>
    </div>

    <script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
