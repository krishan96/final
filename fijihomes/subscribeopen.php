<?php
ob_start();
include 'check.php';
include 'dataaccesslayer/DAL.php';
$dal = new DAL();

    if (isset($_POST['interested'])) {
		  $value = $_GET['id'];
		  $result = $dal->insert_subscribe($_SESSION['filename'], $value);
?>
	 <center>
	 <div class="bg" id="box-search"><br><br>
	 <div class="col-md-6 text-center bg-dark"><br>
		  <form action="allopenhouse.php"method= "post">
       <input type="hidden" name="searchkey" value= "<?php echo $_POST['loc']; ?>">
       <input type="hidden" name="rooms" value= "<?php echo $_POST['room']; ?>">
       <input type="hidden" name="price" value= "<?php echo $_POST['price'];?>">
	   <h5 class="card-title text-white"><?php echo "You are now subscribed to the property.";?></h5><br/>
	   <h5 class="card-title text-white"><?php echo "Open House Date will be notified through Email 24 hours prior to the time";?></h5><br/>
	   <input type="submit" class="btn btn-success" name="showagain" value="OK">
     </form>
	 </div>
	 </div>
	 </center>

<?php
	}
?>
