<?php
include 'headertenant.php';
include 'dataaccesslayer/DAL.php';

if(isset($_POST['paybutton'])){
  $dal = new DAL();
  $res = $dal->tenantbyemail($_SESSION['filename']);
  $row = $res;
  ?>
  <div class ="container">
    <div class="col-md-4 offset-md-4"><br><br>
  <?php
  if($_POST['gid']==$row[0]->G_ID){
    //echo "the GID is correct";?>
        <form class="form-group" method="post">
          <input class="form-control"type="text" placeholder="Payment details">
          <input class="form-control"type="text" placeholder="Payment details"><br><br>
          <div class="text-right">
              <?php echo "<a class=\"btn btn-danger\" href=\"javascript:history.go(-1)\">GO BACK</a>";?>
              <input type="hidden" name="plotid" value="<?php echo $_POST['plotid']?>">
              <input type="hidden" name="price" value="<?php echo $_POST['price']?>">
              <input type="hidden" name="tenantid" value="<?php echo $row[0]->Tenant_ID?>">
              <input class="btn btn-success" type="submit" value="CONFIRM" name="confirm">
          </div>
        </form><?php

  }elseif ($row[0]->G_ID == NULL) {
    echo "You currently do not have an GID.<br><br>";
    echo "<a class=\"btn btn-danger\" href=\"javascript:history.go(-1)\">GO BACK</a>";
  }
  else{
    echo "The GID value does is not correct.
    The GID will only be given once an agent has met you and verify you.
    If you haven't recieved a GID then please contact an agent.<br><br>";
    echo "<a class=\"btn btn-danger\" href=\"javascript:history.go(-1)\">GO BACK</a>";
  }
  ?></div>
</div><?php
}

if(isset($_POST['confirm'])){
error_reporting(E_ERROR | E_PARSE);
$dal= new DAL();
$res =$dal->addpayment($_POST['tenantid'],$_POST['plotid'],$_POST['price']);
$res2= $dal->addcommission($_POST['plotid'],$_POST['price']);
$res3= $dal->addbond($_POST['price']);
$res4= $dal->sold($_POST['plotid']);
$res5=$dal->assignplottotenant($_POST['plotid'],$_POST['tenantid']);

//header('location:completed.php');

$res4 = $dal->details($_POST['plotid']);
        $row=$res4;
?>

<div id="HTMLtoPDF">
<center>
<h1> Fiji Homes </h1>
<h3>Receipt</h3>
<span> <?php
  date_default_timezone_set('Pacific/Fiji');
	echo   date("l")."--".date("h:i:sa")."--". date("Y/m/d") ; ?> </span>

<style>
table {
 font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
 font-size: 12px;
}
table td {
 text-align: left;
}
</style>
<table>
<tr>
<td>Customer ID</td>
<td><span class="input-group-text"><?php echo $row[0]->Owner_ID;?></span></td>
</tr>
<tr>
<td>Property ID</td>
<td><span class="input-group-text"><?php echo $row[0]->Plot;?></span></td>
</tr>
<tr>
<td>Address</td>
<td><span class="input-group-text"><?php echo $row[0]->Address." ".Area;?></span></td>
</tr>
<tr>
<td>Bond</td>
<td><span class="input-group-text"><?php echo $row[0]->Price;?></span></td>
</tr>
<tr>
<td>Rent</td>
<td><span class="input-group-text"><?php echo $row[0]->Price;?></span></td>
</tr>
<td>Total</td>
<td>
<span class="input-group-text"><?php echo $row[0]->Price*2; echo ".00";?></span>
</td>
</tr>
</table>
</center>
</div>
<!-- these js files are used for making PDF -->
<script src="js/jspdf.js"></script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/pdfFromHTML.js"></script>

<form action="completed.php" method ="post">
</br>
<center>
<input type="submit" class="btn btn-info" onclick="HTMLtoPDF()" value="DOWNLOAD" name="download">
</center>
</form>

</br>
</br>
</br>
</br>
<!--<form action="completed.php" method ="post"><a href="#" onclick="HTMLtoPDF()">
  <input type="submit" value="DOWNLOAD" name="download">
</form>-->
<?php }
include "footer.php";
?>
