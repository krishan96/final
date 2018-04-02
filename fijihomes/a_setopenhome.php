<?php
include 'headeragent.php';
include 'structure.php';
include 'dataaccesslayer/DAL.php';
  // echo "here";
?>
<form method="post">
	<div class="form-group" method="post"><br>
		<input class="col-md-4" type="text" name="searchvalue" placeholder="Name/Address">
		<button type="submit" name="Search" class="btn btn-primary button-loading" data-loading-text="Loading...">SEARCH</button>
		<button type="submit" name="ViewAll" class="btn btn-primary button-loading">VIEW ALL</button>
		
	</div>
	</form>
<table class ="table table-striped table-border table-hover ">
			<thead>
				<tr>
					<th> Owner Name</th>
					<th> Property ID</th>
					<th> Address</th>
					<th> </th>
				</tr>
			</thead>
			<body>
			<?php
			if(isset(  $_POST['Search'])){
				$dal = new DAL();
				$results = $dal->searchhouse($_POST['searchvalue']);

				foreach($results as $row){?>
					<tr>
						<td><?php echo $row->Name?></td>
						<td><?php echo $row->Plot?></td>
						<td><?php echo $row->Address?></td>
            <td>
              <form class="datetime-local" method="post">
                <div class="container">
                  <div class="row">
                      <div class="col-sm-11">
                          <div class="form-group">
                              <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                  <input type="datetime-local" name="date" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                                  <!-- <input type="time" name="time" class="form-control datetimepicker-input" data-target="#datetimepicker1"/> -->
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
              <!-- </form> -->

            </td>
						<td>
              <!-- <form method="post"> -->
							<input type="hidden" name="id" value="<?php echo $row->Plot?>"/>
							<input class="btn-sm btn-success" type="submit" name="addopen" value="Set Open House"/>
							</form>
            </td>
					</tr><?php
				}
			}else{
				$dal = new DAL();
				$result = $dal->displayall();

				foreach($result as $row){?>
					<tr>
						<td><?php echo $row->Name?></td>
						<td><?php echo $row->Plot?></td>
						<td><?php echo $row->Address?></td>
            <td>
              <form class="datetime-local" method="post">
                <div class="container">
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="form-group">
                              <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                  <input type="datetime-local" name="date" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                                  <!-- <input type="time" name="time" class="form-control datetimepicker-input" data-target="#datetimepicker1"/> -->
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
              <!-- </form> -->

            </td>
						<td>
              <!-- <form method="post"> -->
							<input type="hidden" name="id" value="<?php echo $row->Plot?>"/>
							<input class="btn-sm btn-success" type="submit" name="addopen" value="Set Open House"/>
							</form>
            </td>
					</tr><?php

          if (isset($_POST['addopen'])) {
            $id = $_POST['id'];
            $date = $_POST['date'];
            echo("<meta http-equiv='refresh' content='1'>");
            $dal->addopenhouse($date, $id);
          }

				}
			}?>
			</body>
		</table>

<?php
include 'footer.php';
?>
