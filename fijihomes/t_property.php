<?php
include 'headertenant.php';
include 'dataaccesslayer/DAL.php';
?>

<style type="text/css">

		table {
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}
		table td {
			transition: all .5s;
		}

		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
		}

		.data-table th,
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
			text-align: center;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
			height:20px;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;

		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}

		.tab1{
			float:left; width:60%; margin-left:3%; margin-right:3%; height:400px;
		}

		.tab2{
			width:30%; margin-bottom:3%; height:195px;
		}

	@media (max-width:900px){
		.tab1{
			width:90%;
			margin-left:5%;
			margin-right:5%;
			clear:both;
		}

		.tab2{
			float:left;
			margin-left:2%;
			margin-right:2%;
			width:46%
		}
	}


    /* Full height */
    height: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

	</style>
  <br>

	<table class="data-table tab1">
		<caption class="title">Sales Data of Fiji Homes</caption>
		<thead>
			<tr>
				<th>PROPERTY</th>
				<th>INFORMATION</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th style=" text-align: center;">
	<?php
      $dal = new DAL();
      $res = $dal->propertydetailstenant($_SESSION['filename']);
      $row=$res;
	  if($res){
	 echo '<img class="card-img-top img-fluid" style="width:auto; height:370px;" src="data:image/jpeg;base64,'.base64_encode($row[0]->Images).'"/>';
     //}?>
</th>

<th style=" text-align: center;">
	<?php
    /*  $dal = new DAL();
      $res = $dal->propertydetailstenant($_SESSION['filename']);
      $row=$res;
      if($res){*/
	  echo "Address: ".$row[0]->Address."</br>";
      echo "Price: $".$row[0]->Price."</br>";
      echo "Area: ".$row[0]->Area."</br>";
     }else{
       ?><p style="color:red;">You currently do not have any property.<br> Feel free to contact us.<p><?php
     }?>
	 </th>
			</tr>
		</tfoot>
	</table>


	<table  class="data-table tab2">
		<thead>
			<tr>
				<th>AGENT</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th style=" text-align: center;">
				 <?php if($res){
            $res1= $dal->allocateagenttenant($row[0]->Plot);
            if($res1){
                $row1 = $res1;
                echo "Name: ".$row1[0]->E_Name."</br>";
                echo "Contact: ".$row1[0]->E_Contact."</br>";
                echo "Email: ".$row1[0]->Email."</br>";
              }}else{
                ?><p style="color:red;">There is no agent assigned yet<p><?php
              }?>
				</th>
			</tr>
		</tfoot>
	</table>

		<table class="data-table tab2">
		<thead>
			<tr>
				<th>Owner</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th style=" text-align: center;">
					   <?php
          if($res){
            $res2 =  $dal->ownerdetailstotenant($row[0]->Plot);
            if($res2){
                $row2= $res2;
                echo "Name: ".$row2[0]->Name."</br>";
                echo "Contact: ".$row2[0]->Contact."</br>";
                echo "Email: ".$row2[0]->Email."</br>";
                echo "row 2";
            }else{
              ?><p style="color:red;">There is no tenant yet<p><?php
            }}
            ?>
				</th>
			</tr>
		</tfoot>
	</table>

	<div style="clear:both;"> </div>




</div><?php
include 'footer.php';
?>
