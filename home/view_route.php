
    <?php include("header.php"); ?>
    <?php include("menu.php"); ?>

    <div class="wraper">
      <div class="row container-fluid">
        <table class="table">
        <tr>
          <td>
            <form action="" method="post">
              <div class="input-group">
                  <input type="text" class="form-control bg-light text-secondary" placeholder="Search Route By Title" name="search_id" required>
                  <div class="input-group-addon" style="padding:0px;">
                      <button type="submit" class="btn btn-dark text-white" /><i class="fa fa-search"></i></button>
                  </div>
              </div>
            </form>
          </td>
          <td>
            <a href="add_route.php"><button class="btn btn-default text-lg"><i class="fa fa-plus text-red"></i> Add Route</button></a>
            <a href=""><button class="btn btn-default text-lg"><i class="fa fa-asterisk text-red"></i> All</button></a>
          </td>
        </tr>
      </table>
      <div class="bg-success text-success">
        <?php
          if(isset($_GET["success"])){
            echo $_GET["success"];
          }
/////////////////////////////////////////////////////////////////////////////////////    DELETE HANDLER   ////////////////
          if(isset($_POST["id_to_delete"])){
            $sql = "DELETE FROM route WHERE route_id = :id";
            $query = $pdo->prepare($sql);
            $res = $query->execute(array("id"=>$_POST["id_to_delete"]));
          }
        ?>
      </div>
        <table class="table">
          <thead>
            <tr class="bg-lg">
              <td>Route Name</td><td>Total Station</td><td>Total drivers</td><td></td><td></td><td></td><td></td>
            </tr>
          </thead>

          <tbody>
          <?php
//////////////////////////////////////////////////////////////////////////////////////   VIEW AND SEARCH DATA QUERY
          if(isset($_POST["search_id"])){
            $sql = "SELECT * FROM route WHERE route_title = :title";
            $query = $pdo->prepare($sql);
            $route = $query->execute(array("title"=>$_POST["search_id"]));
            $rows = $query->fetchAll();
          }
          else {
            $sql = "SELECT * FROM route";
            $query = $pdo->prepare($sql);
            $route = $query->execute();
            $rows = $query->fetchAll();
          }


          foreach($rows as $row){
            $sql = "SELECT * FROM bus WHERE route_id = :id";
            $bus = $pdo->prepare($sql);
            $bus->execute(array("id"=>$row["route_id"]));

            $sql = "SELECT * FROM station WHERE route_id = :id";
            $station = $pdo->prepare($sql);
            $station->execute(array("id"=>$row["route_id"]));
           

          ?>
            <tr>
              <td class="text-red text-uppercase"><?php echo $row["route_title"]; ?></td>
              <td class="text-primary text-uppercase"><?php echo $bus->rowCount()?></td>
              <td class="text-success text-uppercase"><?php echo $station->rowCount(); ?></td>
              <td>
                <form action="view_station.php" method="post">
                  <input type="text" name="route_id" value="<?php echo $row["route_id"]; ?>" style="display: none;">
                  <button class="btn btn-default" type="submit" style="height: 25px;line-height: 15px;" >
                    <i class="fa fa-bus"></i> View Station
                  </button>
                </form>
              </td>
              <td class="text-red text-uppercase">
                <form action="view_bus.php" method="post">
                  <input type="text" name="route_id" value="<?php echo $row["route_id"]; ?>" style="display: none;">
                  <button class="btn btn-primary" type="submit" style="height: 25px;line-height: 15px;" >
                    <i class="fa fa-user"></i> View Bus
                  </button>
                </form>
              </td>
              <td>
                <form action="edit_route.php" method="post">
                  <input type="text" name="id_to_edit" value="<?php echo $row["route_id"]; ?>" style="display: none;">
                  <input type="text" name="title" value="<?php echo $row["route_title"]; ?>" style="display: none;">
                  <button class="btn btn-success" type="submit" style="height: 25px;line-height: 15px;" >
                    <i class="fa fa-edit"></i> Edit
                  </button>
                </form>
              </td>
              <td>
                <form action="" method="post" onsubmit="return confirm_delete()">
                  <input type="text" name="id_to_delete" value="<?php echo $row["route_id"]; ?>" style="display: none;">
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
    /////////////////////////////////////////////////////////////////////////////    JAVASCRIPT VALIDATION   //////////////////
    function confirm_delete(){
      var agree = confirm("Route Will be Deleted Permanent!!!");
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
