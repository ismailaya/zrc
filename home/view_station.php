
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>

    <div class="wraper">
      <div class="row container-fluid">
        <?php
//////////////////////////////////////////////////////////////////////////////////////   VIEW AND SEARCH DATA QUERY
        if(isset($_POST["route_id"])){
          $_SESSION["station_route_id"] = $_POST["route_id"];
        }

          if(isset($_POST["search_id"])){
            $sql =  "SELECT * FROM station WHERE route_id = :id AND station_title = :title OR station_address = :title AND status=1";
            $station = $pdo->prepare($sql);
            $station->execute(array("id"=>$_SESSION["station_route_id"],"title"=>$_POST["search_id"]));
          }
          else {
            $sql =  "SELECT * FROM station WHERE route_id = :id AND status=1";
            $station = $pdo->prepare($sql);
            $station->execute(array("id"=>$_SESSION["station_route_id"]));
          }
        ?>
        <?php

//////////////////////////////////////////////////////////////////////////////   SHOW SEARCH FORM   //////////////////
        if(isset($_POST["cancel"]) || !isset($_POST["add_station"])){
        ?>
        <table class="table">

          <tr>
            <td>
              <form action="" method="post">
                <div class="input-group">
                    <input type="text" class="form-control bg-light text-secondary" placeholder="Search Station By Name" name="search_id" required>
                    <div class="input-group-addon" style="padding:0px;border: 0px solid;">
                        <button type="submit" class="btn btn-dark text-white" /><i class="fa fa-search"></i></button>
                    </div>
                </div>
              </form>
            </td>
            <td>
              <form action="" method="post">
                    <button type="submit" class="btn btn-default border-outline text-lg" name="add_station" ><i class="fa fa-plus text-red"></i> Add New Station</button>
              </form>
            </td>
            <td>
              <a href=""><button class="btn btn-default text-lg"><i class="fa fa-asterisk text-red"></i> All</button></a>
            </td>
          </tr>
        </table>
        <?php
      }
//////////////////////////////////////////////////////////////////////////////   SHOW ADD STATION FORM   /////////////////////
        if(isset($_POST["add_station"]) && !isset($_POST["cancel"])){
        ?>
        <table class="table">
          <tr>

            <form action="" method="post" name="station" onsubmit="return validate()">
              <td>
                <input type="text" class="form-control bg-light text-secondary" placeholder="Station Name" name="station_title">
              </td>
              <td>
                <input type="text" class="form-control bg-light text-secondary" placeholder="station Address" name="address">
              </td>
              <td>
                <input type="text" class="form-control bg-light text-secondary" placeholder="Station Time" name="time">
              </td>
              <td>
                <select name="unit">
                  <option value="">Unit</option>
                  <option value="Hour">Hour</option>
                  <option value="Minute">Minute</option>
                  <option value="Second">Second</option>
                </select>
              </td>
              <td>
                <input type="submit" class="form-control bg-light text-secondary btn btn-success" value="SAVE" name="save_station">
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
        else if(isset($_POST["id_to_edit"]) && !isset($_POST["cancel"])){
///////////////////////////////////////////////////////////////////////////////////////////   SHOW EDIT FORM   ////////////////////
          $data = explode(",", $_POST["id_to_edit"]);
        ?>
        <table class="table">
          <tr>

            <form action="" method="post" name="station" onsubmit="return validate()">
            <td>
                <input type="hidden" class="form-control bg-light text-secondary" placeholder="Station Id" name="station_id" value="<?php echo $data[0];?>" readonly>
              </td>
              <td>
                <input type="text" class="form-control bg-light text-secondary" placeholder="Station Name" name="station_title" value="<?php echo $data[1];?>">
              </td>
              <td>
                <input type="text" class="form-control bg-light text-secondary" placeholder="station Address" name="address" value="<?php echo $data[2];?>">
              </td>
              <td>
                <input type="text" class="form-control bg-light text-secondary" placeholder="Station Time" name="time" value="<?php echo $data[3];?>">
              </td>
              <td>
                <select name="unit">
                  <option  value="<?php echo $data[4];?>"> <?php echo $data[4];?></option>
                  <option value="Hour">Hour</option>
                  <option value="Minute">Minute</option>
                  <option value="Second">Second</option>
                </select>
              </td>
              <td>
                <input type="submit" class="form-control bg-light text-secondary btn btn-success" value="SAVE" name="edit_station">
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
        elseif(isset($_POST["save_station"])){
////////////////////////////////////////////////////////////////////////////   INSERT STATION HANDLER    ////////////////////////////
          $title = $_POST["station_title"];
          $address = $_POST["address"];
          $time = $_POST["time"];
          $unit = $_POST["unit"];


          $sql = "INSERT INTO station VALUES(NULL,:title,:address,:time,:unit,:route,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,1,1)";
          $query = $pdo->prepare($sql);
          $res = $query->execute(array("title"=>$title,"address"=>$address,"time"=>$time,"unit"=>$unit,"route"=>$_SESSION["station_route_id"]));
          
          
          if($res){
            header("location:view_station.php?success=Route Added Successfull");
          }
          else {
            echo "<script>alert('Fail To Add Route');</script>";
          }

        }
        elseif(isset($_POST["edit_station"])){
///////////////////////////////////////////////////////////////////////////      UPDATE STATION HANDLER   //////////////////////
          $title = $_POST["station_title"];
          $address = $_POST["address"];
          $time = $_POST["time"];
          $unit = $_POST["unit"];
          $id=$_POST["station_id"];


          $sql = "UPDATE station SET station_title = :title, station_address=:address,station_time = :time, station_time_unit = :unit, updatedAt = CURRENT_TIMESTAMP WHERE station_id = :id";
          $query = $pdo->prepare($sql);
          $res = $query->execute(array("title"=>$title,"address"=>$address,"time"=>$time,"unit"=>$unit,"id"=>$id));
          
          
          if($res){
            header("location:view_station.php?success=Station Changed Successfull");
          }
          else {
            echo "<script>alert('Fail To Change Station !!!');</script>";
          }

        }
        elseif(isset($_POST["id_to_delete"])){
//////////////////////////////////////////////////////////////////////////     DELETE STATION HANDLER    ////////////////////////
            $sql = "DELETE FROM station WHERE station_id = :id";
            $query = $pdo->prepare($sql);
            $res = $query->execute(array("id"=>$_POST["id_to_delete"]));
            header("location:view_station.php?success=Station Deleted Successfull");
        }
        ?>
      <div class="bg-success text-success">
        <?php
          if(isset($_GET["success"])){
            echo $_GET["success"];
          }


////////////////////////////////////////////////////////////////////////       TABLE TO VIEW DATA     ///////////////////////////
        ?>
      </div>
        <table class="table">
          <thead>
            <tr class="bg-lg">
              <td>Station Name</td><td>Station Address</td><td>Station Time</td><td></td><td></td>
            </tr>
          </thead>

          <tbody>
          <?php
          foreach($station->fetchAll() as $row) {

          ?>
            <tr>
              <td class="text-red text-uppercase"><?php echo $row["station_title"]; ?></td>
              <td class="text-red text-uppercase"><?php echo $row["station_address"]; ?></td>
              <td class="text-red text-uppercase"><?php echo $row["station_time"]." ". $row["station_time_unit"]; ?></td>
              <td>
                <form action="" method="post">
                  <input type="text" name="id_to_edit" value="<?php echo $row["station_id"].",".$row["station_title"] .",". $row["station_address"] .",". $row["station_time"].",".$row["station_time_unit"]; ?>" style="display: none;">
                  <button class="btn btn-success" type="submit" style="height: 25px;line-height: 15px;" >
                    <i class="fa fa-edit"></i> Edit
                  </button>
                </form>
              </td>
              <td>
                <form action="" method="post" onsubmit="return confirm_delete()">
                  <input type="text" name="id_to_delete" value="<?php echo $row["station_id"]; ?>" style="display: none;">
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
/////////////////////////////////////////////////////////////////////     JAVASCRIPT VALIDATION    ////////////////////////////


    function confirm_delete(){
      var agree = confirm("Station Will be Deleted Permanent!!!");
      if (agree) {
        return true;
      }
      else {
        return false;
      }

    }
    

    function validate(){
      var title = document.forms.station.station_title.value;
      var address = document.forms.station.address.value;
      var time = document.forms.station.time.value;
      var unit = document.forms.station.unit.value;
      
      var reg = /^\w{0}$/;
      var no =/^\d+$/;
      if(reg.test(title) || reg.test(address) || reg.test() || reg.test(unit)){
        alert("Field Can Not Be Empty!!!");
      }
      else if(!no.test(time)){
        alert("Invalid Time");
      }
      else{
        return true;
      }

      return false;
    }
  </script>


  </body>
</html>
