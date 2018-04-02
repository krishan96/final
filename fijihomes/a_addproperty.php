<?php
ob_start();
include 'headeragent.php';
include 'structure.php';
include 'dataaccesslayer/DAL.php';
//include 'businessrules/user.php';

if (isset($_POST['genuine'])){
?>

<br></br>
<div class="row" >
	<form method="POST" name="image_upload" enctype="multipart/form-data" >
		<div class="form-group">
			<input type="text" class="form-control" name="address" placeholder="Plot Address"/required>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" name="area" placeholder="General Area"/required>
		</div>
			<div class="form-group">
			<input type="text" class="form-control" name="rooms" placeholder="Number of Rooms"/required>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" name="price" placeholder="Price/Month"/required>
		</div>
		<div class="form-group">
			<input type="text" class="form-control" name="amenities" placeholder="Amenities Available"/required>
		</div>
		<div class="form-group">
			<label for="image">Insert Images</label>
			<input type="file" class="form-control-file" name="image" multiple="true"/required>
		</div>
		<input type="hidden" name="ownerid" value="<?php echo $_POST['owner']?>"
		<p><button type="submit" name = "upload" class="btn btn-success">Upload..</button>
			<button type="button" name ="back" onclick="window.location='a_newowners.php'"class="btn btn-danger">BACK</button>		</p>
	</form>
</div>

<?php
}
	if(isset($_POST['upload']) ){
		$user = new User();
		$apart = new Apartment();
		$rand = substr(md5(microtime()),rand(0,26),10);
		$e = addslashes(file_get_contents($_FILES['image']['tmp_name']));

		$apart->create($_POST['address'],$_POST['area'],$_POST['rooms'],$_POST['price'],$_POST['amenities'],$e,$_POST['ownerid']);
		$apart->addapartment();
		$user->addgenuineowner($rand, $_POST['ownerid']);
		?>
		<p class= "text-center"> <font size =5 color = "red" >SUCCESSFULLY ADDED </font></p>
		<p class= "text-center"> <font size =3 color = "red" ></br>REDIRECTING TO THE PREVIOUS PAGE</font></p>
	<?php
		header("refresh:3; url=a_newowners.php");
	}
include 'footer.php';
?>
