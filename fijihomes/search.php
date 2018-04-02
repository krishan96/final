<?php
if(!session_id()) session_start();
if(!isset($_SESSION['filename'])){
  include 'loggedoutheader.php';
}
elseif($_SESSION['type']=="Manager"){
  include 'headermanager.php';
}
elseif($_SESSION['type']=="Owner"){
  include 'headerowner.php';
}
elseif($_SESSION['type']=="Agent"){
  include 'headeragent.php';
}
elseif($_SESSION['type']=="Tenant"){
  include 'headertenant.php';
}
else{
  echo "We apologize something has gone wrong";
}

include 'searchboxdetail.php';
include 'dataaccesslayer/DAL.php';
?>

<?php
    if (isset($_GET['show'])) {
      $value = $_GET['searchterm'];
      $dal = new DAL();
      $result = $dal->searchByLocation($value);
      if (is_array($result) || is_object($result)) {
        if ($result) {
?><br>
<div class="container">
  <div class="row"><?php foreach($result as $row){ ?>
    <div class="col-sm-3 d-flex pb-3">

      <div class="card text-center " >
        <?php
          $res = $dal->displayImages($row->Plot);
          $row2 = $res;
          echo '<img style ="max-height:150px;"class="card-img-top img-fluid" src="data:image/jpeg;base64,'.base64_encode($row2[0]->Images).'"/>';
        ?>
        <div class="card mb-3">
          <div class="card-block">
            <h3 class="card-title"><?php
              echo $row->Area;
            ?></h3>
            <div class="card-text table-responsive text-left">
              <h4>$<?php echo $row->Price; ?></h4>
              <img src="images/location.png" alt="">
              <?php echo $row->Address; ?><br>
              <img src="images/rooms.png" alt="">
              <?php echo $row->Rooms; ?><br>
              <img src="images/amenities.png" alt="">
              <?php echo $row->Amenities; ?><br>
              <br><br>
                <?php $a = $row->Plot; ?>
            </div>
          </div>
          <a href="create.php" class="btn btn-danger" method="post">Interested</a>
        </div>
      </div>
    </div>
<?php } ?>
  </div>
</div>
<?php
          }
        }else {
          echo "<br/><br/><h2>No results found!</h2>";
          header( "refresh:1;url=index.php" );
        }

      }
include 'footer.php';
?>
