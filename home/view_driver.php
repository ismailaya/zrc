
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>

    <div class="wraper">
      <div class="row container-fluid">
        <?php
        if(isset($_POST["route_id"])){
          $_SESSION["station_route_id"] = $_POST["route_id"];
        }

         
          if(isset($_POST["search_id"])){
            $sql =  "SELECT * FROM drivers WHERE driver_name = :title OR driver_address = :title OR driver_phone = :title OR username = :title AND status=1";
            $driver = $pdo->prepare($sql);
            $driver->execute(array("title"=>$_POST["search_id"]));
          }
          else {
            $sql =  "SELECT * FROM drivers WHERE status=1";
            $driver = $pdo->prepare($sql);
            $driver->execute();
          }
        ?>
        <?php
        if(isset($_POST["cancel"]) || !isset($_POST["add_staff"])){
        ?>
        <table class="table">

          <tr>


            <td>
              <form action="" method="post">
                <div class="input-group">
                    <input type="text" class="form-control bg-light text-secondary" placeholder="Search Driver By Name, phone, address" name="search_id" required>
                    <div class="input-group-addon" style="padding:0px;border: 0px solid;">
                        <button type="submit" class="btn btn-dark text-white" /><i class="fa fa-search"></i></button>
                    </div>
                </div>
              </form>
            </td>
            <td>
              <form action="" method="post">
                    <button type="submit" class="btn btn-default border-outline text-lg" name="add_driver" ><i class="fa fa-plus text-red"></i> Add New Driver</button>
              </form>
            </td>
            <td>
              <a href=""><button class="btn btn-default text-lg"><i class="fa fa-asterisk text-red"></i> All</button></a>
            </td>
          </tr>
        </table>
        <?php
      }
        if(isset($_POST["add_driver"]) && !isset($_POST["cancel"])){
        ?>
        <table class="table">
          <tr>

            <form action="" method="post">
              <td>
                <input type="text" class="form-control bg-light text-secondary" placeholder="Driver Name" name="driver_name" required>
              </td>
              <td>
                <input type="text" class="form-control bg-light text-secondary" placeholder="Driver Address" name="address" required>
              </td>
              <td>
                <input type="number" class="form-control bg-light text-secondary" placeholder="Driver Phone" name="phone" required>
              </td>
              <td>
                <input type="text" class="form-control bg-light text-secondary" placeholder="Username" name="username" required>
              </td>
              <td>
                <input type="submit" class="form-control bg-light text-secondary btn btn-success" value="SAVE" name="save_driver">
              </td>
            </form>
            <td>
              <form action="" method="post">
              <input type="submit" class="form-control btn btn-danger" value="Cancel" name="cancel">
            </td>
          </tr>
        </table>
        <?php
        }
        elseif(isset($_POST["id_to_edit"]) && !isset($_POST["cancel"])){
          $data = explode(",", $_POST["id_to_edit"]);
        ?>
        <table class="table">
          <tr>

            <form action="" method="post">
            <td>
                <input type="hidden" class="form-control bg-light text-secondary" placeholder="Driver Id" name="driver_id" value="<?php echo $data[0];?>" required readonly>
              </td>
              <td>
                <input type="text" class="form-control bg-light text-secondary" placeholder="Driver Name" name="driver_name" value="<?php echo $data[1];?>" required>
              </td>
              <td>
                <input type="text" class="form-control bg-light text-secondary" placeholder="Driver Address" name="address" value="<?php echo $data[2];?>" required>
              </td>
              <td>
                <input type="number" class="form-control bg-light text-secondary" placeholder="Driver Phone" name="phone" value="<?php echo $data[3];?>" required>
              </td>
              <td>
              <input type="text" class="form-control bg-light text-secondary" placeholder="Username" name="username" value="<?php echo $data[4];?>" required>
              </td>
              <td>
                <input type="submit" class="form-control bg-light text-secondary btn btn-success" value="SAVE" name="edit_driver">
              </td>
            </form>
            <td>
              <form action="" method="post">
              <input type="submit" class="form-control btn btn-danger" value="Cancel" name="cancel">
            </td>
          </tr>
        </table>
        <?php
        }
        elseif(isset($_POST["save_driver"])){
          $name = $_POST["driver_name"];
          $address = $_POST["address"];
          $phone = $_POST["phone"];
          $username = $_POST["username"];


          $sql = "INSERT INTO drivers VALUES(NULL,:name,:address,:phone,:username,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,1,1)";
          $query = $pdo->prepare($sql);
          $res = $query->execute(array("name"=>$name,"address"=>$address,"phone"=>$phone,"username"=>$username));
          
          
          if($res){
            header("location:view_driver.php?success=Driver Added Successfull");
          }
          else {
            echo "<script>alert('Fail To Add Driver');</script>";
          }

        }
        elseif(isset($_POST["edit_driver"])){
            $name = $_POST["driver_name"];
            $address = $_POST["address"];
            $phone = $_POST["phone"];
            $username = $_POST["username"];
            $id = $_POST["driver_id"];
  
  
            $sql = "UPDATE drivers SET driver_name = :name, driver_address = :address, driver_phone = :phone, username = :username, updatedAt = CURRENT_TIMESTAMP WHERE driver_id = :id";
            $query = $pdo->prepare($sql);
            $res = $query->execute(array("name"=>$name,"address"=>$address,"phone"=>$phone,"username"=>$username, "id"=>$id));
            
            
            if($res){
              header("location:view_driver.php?success=Driver Changed Successfull");
            }
            else {
              echo "<script>alert('Fail To Change Driver');</script>";
            }

        }
        elseif(isset($_POST["id_to_delete"])){
            $sql = "DELETE FROM drivers WHERE driver_id = :id";
            $query = $pdo->prepare($sql);
            $res = $query->execute(array("id"=>$_POST["id_to_delete"]));
            header("location:view_driver.php?success=Driver Deleted Successfull");
        }
        ?>
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
              <td>Driver Name</td><td>Driver Address</td><td>Driver Phone</td><td>Username</td><td></td><td></td>
            </tr>
          </thead>

          <tbody>
          <?php
          foreach($driver->fetchAll() as $row) {

          ?>
            <tr>
              <td class="text-red text-uppercase"><?php echo $row["driver_name"]; ?></td>
              <td class="text-red text-uppercase"><?php echo $row["driver_address"]; ?></td>
              <td class="text-red text-uppercase"><?php echo $row["driver_phone"]; ?></td>
              <td class="text-red text-uppercase"><?php echo $row["username"]; ?></td>
              <td style="width:100px;">
                <form action="" method="post">
                  <input type="text" name="id_to_edit" value="<?php echo $row["driver_id"].",".$row["driver_name"] .",". $row["driver_address"] .",". $row["driver_phone"].",".$row["username"]; ?>" style="display: none;">
                  <button class="btn btn-success" type="submit" style="height: 25px;line-height: 15px;" >
                    <i class="fa fa-edit"></i> Edit
                  </button>
                </form>
              </td>
              <td  style="width:100px;">
                <form action="" method="post" onsubmit="return confirm_delete()">
                  <input type="text" name="id_to_delete" value="<?php echo $row["driver_id"]; ?>" style="display: none;">
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
        <?php
          
        ?>
      </div>
    </div>






    <script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

    <script>
    function confirm_delete(){
      var agree = confirm("Driver Will be Deleted Permanent!!!");
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
