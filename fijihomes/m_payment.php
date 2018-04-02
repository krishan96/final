<?php
 include "check.php";
include 'dataaccesslayer/DAL.php';
 ?>
 <div class="col-sm-1 offset-sm-2">
 <form action="m_main.php">
		<input type="submit" class="btn btn-danger"value="Return to Main"/>
 </form>
 </div>
<div class ="col-md-8 offset-md-2">
		<table class ="table table-striped table-border table-hover">
			<thead>
				<tr>
					<th>Pay ID</th>
					<th> Date/Time</th>
					<th> Tenant ID</th>
					<th> Plot</th>
					<th> Price</th>
				</tr>
			</thead>
			<body>
			<?php
			$dal1 = new DAL();
			$results = $dal1->paydetail();

			foreach($results as $row){?>
				<tr>
					<td><?php echo $row->Pay_ID?></td>
					<td><?php echo $row->PayDateTime?></td>
					<td><?php echo $row->Tenant_ID?></td>
					<td><?php echo $row->Plot?></td>
					<td><?php echo $row->Amount?></td>
				</tr><?php
			}?>
			</body>
		</table>
	</div>
  <?php
  include "footer.php";
  ?>
