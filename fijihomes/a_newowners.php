<?php
ob_start();
include 'headeragent.php';
include 'structure.php';
include 'dataaccesslayer/DAL.php';
$dal = new DAL();
?>
<table class ="table table-striped table-border table-hover">
	<thead>
		<tr>
			<th> Name</th>
			<th> Contact</th>
			<th> Details</th>
			<th> Action</th>
		</tr>
	</thead>
	<body>
	<?php
	if(!session_id()) session_start();
	$email = $_SESSION['filename'];
	//echo $email;
	$results = $dal->allocatedowners($email);
	if(!$results){ echo "<tr>there is no new clients</tr>";}
	foreach($results as $row){?>
		<tr>
			<td><?php echo $row->Name?></td>
			<td><?php echo $row->Contact?></td>
			<td><a data-toggle="modal" data-Id="<?php echo $row->Owner_ID ?>" href="#myModal" class="btn btn-default btn-sm">View Details</a></td>
			<td>
					<form  action= "a_addproperty.php" method = "post">
						<input type ="hidden" name="owner" value="<?php echo $row->Owner_ID?>">

						<input  class="btn-success" data-toggle ="tooltip" data-placement="top"
						 title="Assign a unique code and add property"
						 type="submit" name="genuine" value="Add Property">

						<input class="btn-danger" data-toggle ="tooltip" data-placement="top"
						 title="Unable to contact owner after multiple attempts"
						 type="submit" name="decline" value="Decline">
					</form>
			</td>
		</tr><?php
	} ?>
	</body>
</table>
<?php
include 'footer.php'; ?>
