<?php
  include 'check.php';
  include 'dataaccesslayer/DAL.php';
  $servername = "localhost";
  $username = "root";
  $password = "";
  $base = "fijihomesdb";

  $conn = new mysqli($servername, $username, $password, $base);
  $dal = new DAL();

  $id = $_GET['id'];
  // echo $id;

  $res = $dal->displayImagesAll($id);
?>
<br><br>
  <div class="container">
    <div class="row"><?php  foreach ($res as $row) { ?>
      <div class="col-sm-4 d-flex pb-3">

        <div class="card " >

<?php    echo '<img style ="" class="card-img-top img-fluid" src="data:image/jpeg;base64,'.base64_encode($row->ImagesBlob).'"/>';

  // $result = mysqli_query($conn  ,"select ImagesBlob from images where Plot = '$id'");
  // foreach ($res as $row) {
  //   echo '<img style ="max-height:150px;" class="card-img-top img-fluid" src="data:image/jpeg;base64,'.base64_encode($row[0]->ImagesBlob).'"/>';
  // }

  // while ($row = mysql_fetch_array($result)) {
  //   echo '<img style ="max-height:150px;" class="card-img-top img-fluid" src="data:image/jpeg;base64,'.base64_encode($row[0]->ImagesBlob).'"/>';
  // }
  ?>
</div>
</div><?php
  }
?>
</div>
</div>