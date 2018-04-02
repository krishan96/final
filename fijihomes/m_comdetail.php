<?php
 include "check.php";
include 'dataaccesslayer/DAL.php';
 ?>
 <div class="col-sm-1 offset-sm-2">
 <form action="m_commission.php">
		<input type="submit" class="btn btn-danger"value="Back"/>
 </form>
 </div>
<div class ="col-md-8 offset-md-2">
		<?php if(isset($_POST["details"])){?>
			<table class ="table table-striped table-border table-hover">
				<thead>
					<tr>
						<th class ="col-sm-1">Plot</th>
						<th class ="col-sm-1"> Area</th>
						<th class ="col-sm-1"> Address</th>
						<th class ="col-sm-2"> Owner ID</th>
						<th class ="col-sm-1"> Price</th>
						<th class ="col-sm-1"> Date/Time</th>
					</tr>
				</thead>
				<body>
				<?php
				$dal1 = new DAL();
				$results = $dal1->comdetail($_POST["id"]);

				foreach($results as $row){?>
					<tr>
						<td><?php echo $row->Plot?></td>
						<td><?php echo $row->Area?></td>
						<td><?php echo $row->Address?></td>
						<td><?php echo $row->Owner_ID?></td>
						<td><?php echo $row->Price?></td>
						<td><?php echo $row->OHDateTime?></td>
					</tr><?php
				}?>
				</body>
			</table> <?php
		} ?>
	</div>
  <?php
  include "footer.php";
  ?>
