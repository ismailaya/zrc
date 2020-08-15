

    <?php
    include("header.php");
    ?>

    <?php include("menu.php"); ?>

    <div class="wraper">
      <div class="row container-fluid">
        <br/>

        <?php
        $sql = "SELECT * FROM route WHERE status=1";
        $route = $pdo->prepare($sql);
        $route->execute();

        $sql = "SELECT * FROM bus WHERE  status=1";
        $bus = $pdo->prepare($sql);
        $bus->execute();

        $sql = "SELECT * FROM station WHERE  status=1";
        $station = $pdo->prepare($sql);
        $station->execute();
        ?>

        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 text-center text-lg dash">
          <i class="fa fa-road"></i>
          <div class="text-center text-red"><br/><br/><?php echo $route->rowCount(); ?></div>
          <div class="text-center"><br/><br/><b>ROUTE</b></div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 text-center text-lg dash">
          <i class="fa fa-street-view"></i>
          <div class="text-center text-red"><br/><br/><?php echo $station->rowCount(); ?></div>
          <div class="text-center"><br/><br/><b>STATION</b></div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 text-center text-lg dash">
          <i class="fa fa-bus"></i>
          <div class="text-center text-red"><br/><br/><?php echo $bus->rowCount(); ?></div>
          <div class="text-center"><br/><br/><b>BUS</b></div>
        </div>

      </div>
    </div>






    <script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
