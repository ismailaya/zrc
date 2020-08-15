
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>

    <div class="wraper">
      <div class="row container-fluid">
      <?php
        if(isset($_POST["route_id"])){
          $_SESSION["bus_route_id"] = $_POST["route_id"];
        }
          

          if(isset($_POST["search_id"])){
            $sql =  "SELECT * FROM bus WHERE route_id = :id AND bus_plate = :plate status=1";
            $bus = $pdo->prepare($sql);
            $bus->execute(array("id"=>$_SESSION["bus_route_id"],"plate"=>$_POST["search_id"]));
            
          }
          else {
            $sql =  "SELECT * FROM bus WHERE route_id = :id AND status=1";
            $bus = $pdo->prepare($sql);
            $bus->execute(array("id"=>$_SESSION["bus_route_id"]));
          }
          
        ?>
        <table class="table">

        <tr>
          <td>
            <form action="" method="post">
              <div class="input-group">
                  <input type="text" class="form-control bg-light text-secondary" placeholder="Search Bus By Plate Number" name="search_id" required>
                  <div class="input-group-addon" style="padding:0px;border: 0px solid;">
                      <button type="submit" class="btn btn-dark text-white" /><i class="fa fa-search"></i></button>
                  </div>
              </div>
            </form>
          </td>
          <td>
            <?php
            if(!isset($_POST["bus_to_edit"])){
            ?>
              <form action="" method="post">
                <div class="input-group">
                    <input type="text" class="form-control bg-light text-secondary" placeholder="Enter Plate Number" name="plate" required>
                    <div class="input-group-addon" style="padding:0px;border: 0px solid;">
                        <button type="submit" class="btn btn-default border-outline text-lg"><i class="fa fa-plus text-red"></i> Add Bus</button>
                    </div>
                </div>
              </form>
              <?php
              if(isset($_POST["plate"])){
                  $plate = $_POST["plate"];
                  
                  
                  $sql = "INSERT INTO bus VALUES(NULL,:plate,:routeId,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,1,1)";
                  $query = $pdo->prepare($sql);
                  $res = $query->execute(array("plate"=>$plate,"routeId"=>$_SESSION["bus_route_id"]));
                  
                  
                  if($res){
                    header("location:view_bus.php?success=Bus Added Successfull");
                  }
                  else {
                    echo "<script>alert('Fail To Add Route');</script>";
                  }
                }
          
          }
          elseif (isset($_POST["change_bus"])) {
          ?>
              <form action="" method="post">
                <div class="input-group">
                    <input type="text" class="form-control bg-light text-secondary" name="bus_id" value="<?php echo $_POST["id_to_edit"];?>" style="display: none;">
                    <input type="text" class="form-control bg-light text-secondary" name="plate_number" value="<?php echo $_POST["bus_to_edit"];?>" required>
                    <div class="input-group-addon" style="padding:0px;border: 0px solid;">
                        <button type="submit" class="btn btn-default border-outline text-lg"><i class="fa fa-edit text-primary"></i> Change</button>
                    </div>
                </div>
              </form>
              <?php
            }
            if(isset($_POST["plate_number"])){

                $plate = $_POST["plate_number"];
                $id = $_POST["bus_id"];
                $sql = "UPDATE bus SET bus_plate = :plate WHERE bus_id=:id";
                $query = $pdo->prepare($sql);
                $res = $query->execute(array("plate"=>$plate,"id"=>$id));
      
            
            }
            if(isset($_POST["id_to_delete"])){
              $sql = "DELETE FROM bus WHERE bus_id = :id";
              $query = $pdo->prepare($sql);
              $res = $query->execute(array("id"=>$_POST["id_to_delete"]));
            }

             ?>
          </td>
          <td>
            <a href=""><button class="btn btn-default text-lg"><i class="fa fa-asterisk text-red"></i> All</button></a>
          </td>
        </tr>
      </table>
      <div class="bg-success text-success">
        <?php
          if(isset($_GET["success"])){
            echo $_GET["success"];
          }
        ?>
      </div>
        <table class="table">
          <thead>
            <tr class="bg-lg">
              <td>Plate Number</td><td></td><td></td>
            </tr>
          </thead>

          <tbody>
          <?php
         foreach($bus->fetchAll() as $row) {

          ?>
            <tr>
              <td class="text-red text-uppercase"><?php echo $row["bus_plate"]; ?></td>

              <td>
                <form action="" method="post">
                  <input type="text" name="id_to_edit" value="<?php echo $row["bus_id"]; ?>" style="display: none;">
                  <input type="text" name="bus_to_edit" value="<?php echo $row["bus_plate"]; ?>" style="display: none;">
                  <button class="btn btn-success" type="submit" name="change_bus" style="height: 25px;line-height: 15px;" >
                    <i class="fa fa-edit"></i> Edit
                  </button>
                </form>
              </td>
              <td>
                <form action="" method="post" onsubmit="return confirm_delete()">
                  <input type="text" name="id_to_delete" value="<?php echo $row["bus_id"]; ?>" style="display: none;">
                  <button class="btn btn-danger" type="submit" style="height: 25px;line-height: 15px;" >
                    <i class="fa fa-trash"></i> Delete
                  </button>
                </form>
              </td>

            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
        
      </div>
    </div>






    <script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

    <script>
    function confirm_delete(){
      var agree = confirm("Bus Will be Deleted Permanent!!!");
      if (agree) {
        return true;
      }
      else {
        return false;
      }

    }
    </script>


  </body>
</html>
