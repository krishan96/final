<?php
 include "headermanager.php";
 include 'dataaccesslayer/DAL.php';
 ?>
<div class="container">
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
  </div>
	<!-- <div class="form-group" method="post">
		<input class="form-control" type="text" name="searchvalue" placeholder="Agent Name or ID">
		<button type="submit" name="Search" class="btn btn-primary button-loading" data-loading-text="Loading...">SEARCH</button>
		<button type="submit" name="ViewAll" class="btn btn-primary button-loading">VIEW ALL</button>
	</div> -->
	</form>
	</div>
	<table class ="table table-striped table-border table-hover">
			<thead>
				<tr>
					<th> Agent ID</th>
					<th> Agent Name</th>
					<th>Commission</th>
					<th> Details</th>
				</tr>
			</thead>
			<body>
			<?php
			if(isset($_POST['Search'])){
				$dal = new DAL();
				$results = $dal->comagentid($_POST['searchvalue']);
        $total=0;
				foreach($results as $row){?>
					<tr>
						<td><?php echo $row->id?></td>
						<td><?php echo $row->name?></td>
						<td><?php echo "$ ".$row->amount?></td>
						<td><form action="m_comdetail.php" method="post">
							<input type="hidden" name="id" value="<?php echo $row->payid?>"/>
							<input class="btn-sm btn-success" type="submit" name="details" value="Details"/>
							</form></td>
					</tr><?php
          $total+=$row->amount;
				} ?>
        <tr class="bg-danger text-white">
          <td>-</td>
          <td>TOTAL</td>
          <td ><?php echo "$ ".$total.".00" ?></td>
          <td>-</td>
          <?php
			}else{
				$dal = new DAL();
				$results = $dal->comagent();

				foreach($results as $row){?>
					<tr>
						<td><?php echo $row->id?></td>
						<td><?php echo $row->name?></td>
						<td><?php echo $row->amount?></td>
						<td><form action="m_comdetail.php" method="post">
							<input type="hidden" name="id" value="<?php echo $row->payid;?>"/>
							<input class="btn-sm btn-success" type="submit" name="details" value="Details"/>
							</form></td>
					</tr><?php
				}
			}?>
			</body>
		</table>
</div>
</div>
<?php
 include "footer.php";
?>
