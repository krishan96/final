<?php
ob_start();
include 'headermanager.php';
include 'structure.php';
include 'dataaccesslayer/DAL.php';
$dal = new DAL();
?>
<table class ="table table-striped table-border table-hover">
	<thead>
		<tr>
			<th> Name</th>
			<th> Contact</th>
			<th> Address</th>
			<!--<th> Detailtest</th>-->
			<th> Agents</th>
		</tr>
	</thead>
	<body>
	<?php
	$results = $dal->newowner();
	if(!$results){ echo "<tr>there is no new clients</tr>";}
	$result1 = $dal->showagents();
	foreach($results as $row){?>
		<tr>
			<td><?php echo $row->Name?></td>
			<td><?php echo $row->Contact?></td>
			<td><?php echo $row->Address?></td>
			<td> <form method = "post">
					<select name="agents">
					<?php foreach($result1 as $row1){ ?>
						<option value="<?php echo $row1->Employee_ID ?>"> <?php echo $row1->E_Name ?> </option>;
					<?php }
					?></select>
					<input type ="hidden" name="owner" value="<?php echo $row->Owner_ID?>">
					<input type="submit" name="submit" value="ASSIGN">
				</form>
			</td>
			<!--echo"<option value='".$row1->E_Name."'>".$row1->E_Name."</option>";
			<td><a href = 'edit.php?id=<php echo $row->empid?>'> EDIT </a>/ <a href ='delete.php?id=<php echo $row->empid?>'>DELETE</a></td>-->
		</tr><?php
	} ?>
	</body>
</table>
<?php
if (isset($_POST['submit'])){
	//echo "YO HO";
	$a =$_POST["agents"];
	$b =$_POST["owner"];
	//echo $a.$b;
	$result2 = $dal->assignagent($a,$b);
	header("refresh:0;");
} ?>

<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

    </div>
  </div>
</div>

<script>
$('.Edit').click(function(){
    var Id=$(this).attr('data-Id');
    $.ajax({url:"somepage.php?Id="+Id,cache:false,success:function(result){
        $(".modal-content").html(result);
				 $('#myModal').modal('show');
    }});
});
</script>
<?php //}
include 'footer.php'; ?>
