<!DOCTYPE html>
<?php
$url = "http://localhost/zrc/webservice/action/route.php?status=all";
//  Initiate curl
$curl = curl_init();
// Will return the response, if false it print the response
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($curl, CURLOPT_URL,$url);
// Execute
$result=curl_exec($curl);
// Closing
curl_close($curl);
$x = json_decode($result,true);
if(!isset($_COOKIE["user"])){
$_COOKIE["user"] = array();
}
array_push($_COOKIE["user"],"site");

?>



<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title></title>
    <style>
      *{
        margin: 0px;
        padding: 0px;
      }
      header{
        height: 70px;
        line-height: 70px;
        font-size: 15px;
        color: white;
        text-align: center;
      }
      nav{
        position: relative;
        height: 100px;
        text-align: center;
        background: transparent;
      }
      nav .item{
        display: inline-block;
        width: 80px;
        margin: 20px 7px 0;
        padding: 5px;
        text-decoration: none;
        box-shadow: 1px 1px 3px gray;
        border-radius: 5px;
        color: steelblue;
      }
      section{
        min-height: 500px;
        margin: 0px;
        padding: 0px;
      }

      section select{
        background: steelblue;
        color: white;
        border-radius: 7px;
      }

      section table{
        border: 0px;
        margin-top: 15px;
      }
      section table td{
        color: dimgray;
      }
      section table tr:nth-child(odd){
        background: azure;
      }

      section .banner img{
        width: 100%;
        margin: 0 auto;
      }
      footer{
        position: relative;
        bottom: 0px;
        left: 0px;
        right: 0px;
        height: 70px;
        text-align: center;
        font-size: 15px;
        color: white;
        line-height: 50px;
      }
      .bg-main{
        background: steelblue;
      }
    </style>
  </head>
  <body>
    <header class="bg-main">
      ZANZIBAR ROUTE PAYMENT COST
    </header>
    <nav>
      <a href="login.php" class="item" style="width: 100px;">
        Login
      </a>

    </nav>
    <section class="row container-fluid" style="margin: 0px;padding: 0px;">
      <div class="sect banner col-lg-6">
        <img src="img/pic.jpg" alt="">
      </div>
      <div class="sect banner-option col-lg-6">
        <select class="form-control">
          <option>Select Route Type</option>
          <optgroup label="AIR">
            <option>Aeroplane</option>
            <option>Charter</option>
          </optgroup>
          <optgroup label="WATER">
            <option>Boat</option>
            <option>Ship</option>
          </optgroup>
          <optgroup label="ROAD">
            <option>Bus</option>
            <option>Tax</option>
            <option>Dyner</option>
            <option>Noah</option>
          </optgroup>
        </select>

        <div class="route">
          <table class="table">
            <?php
            if($x["status"]==200){
              foreach ($x["data"] as $value) {
            ?>
            <tr>
              <td><?php echo $value["content"]["route_title"]; ?></td>
            </tr>
            <?php
          }
            }
            ?>
          </table>
        </div>
      </div>
    </section>
    <footer class="bg-main">
      &copy Zanzibar Route 2020
    </footer>

  </body>
</html>
