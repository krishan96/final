<?php
 include "headeragent.php";
 include "dataaccesslayer/DAL.php";
 ?>

 <div class ="col-md-8 offset-md-2">

    <div class="row">

    <form method="post"><br>

 <div class="input-group">

   <input type="text" class="form-control" name="searchvalue" placeholder="Agent Name or ID" aria-label="Agent Name or ID" aria-describedby="basic-addon2">

   <div class="input-group-append">

     <button type="submit" name="Search" class="btn btn-primary button-loading" data-loading-text="Loading...">SEARCH</button>

         <button type="submit" name="ViewAll" class="btn btn-primary button-loading">VIEW ALL</button>

     <input type="button" onclick="window.location='m_main.php'"class="btn btn-danger"value="Back"/>

   </div>

 </div><br>
	</form>
	</div>
	<table class ="table table-striped table-border table-hover">
			<thead>
				<tr>
					<th> Owner ID</th>
					<th> Name</th>
					<th>Contact</th>
					<th>Email</th>
					<th>Address</th>
					<th>Genuine ID</th>
				</tr>
			</thead>
			<body>
			<?php
			if(isset($_POST['Search'])){
				$dal = new DAL();
				$value = $_POST['searchvalue'];
				$results = $dal->allOwnersSearch($_SESSION['filename'], $value);

				foreach($results as $row){?>
					<tr>
						<td><?php echo $row->Owner_ID?></td>
						<td><?php echo $row->Name?></td>
						<td><?php echo $row->Contact?></td>
						<td><?php echo $row->Email?></td>
						<td><?php echo $row->Address?></td>
						<td><?php echo $row->G_ID?></td>
					</tr>

					<?php
				}
			}else{
				$dal = new DAL();
				$results = $dal->allOwners($_SESSION['filename']);
				foreach($results as $row){?>
					<tr>
						<td><?php echo $row->Owner_ID?></td>
						<td><?php echo $row->Name?></td>
						<td><?php echo $row->Contact?></td>
						<td><?php echo $row->Email?></td>
						<td><?php echo $row->Address?></td>
						<td><?php echo $row->G_ID?></td>
					</tr>

					<?php
			}}?>
			</body>
		</table>
</div>
<?php
 include "footer.php";
?>
