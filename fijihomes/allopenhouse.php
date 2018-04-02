<?php
  include 'check.php';
  include 'dataaccesslayer/DAL.php';

  $dal = new DAL();
  $result = $dal->allopenhouse();
  if (is_array($result) || is_object($result)) {
    if ($result) {

?>
<br><br>
<div class="container">
  <div class="row"><?php foreach($result as $row){ ?>
    <div class="col-sm-3 d-flex pb-3">
      <div class="card text-center">
        <a href="images.php">
          <?php
            $res = $dal->displayImages($row->Plot);
            $row2 = $res;
            echo '<img style ="max-height:150px;" class="card-img-top img-fluid" src="data:image/jpeg;base64,'.base64_encode($row2[0]->Images).'"/>';
          ?>
        </a>
        <div class="card mb-3">
          <div class="card-block">
            <h3 class="card-title">
              <?php
                echo $row->Area;
              ?>
            </h3>
            <div class="card-text table-responsive text-left">
              <h4>$<?php echo $row->Price; ?></h4>
              <img src="images/location.png" alt="">
              <?php echo $row->Address; ?><br>
              <img src="images/rooms.png" alt="">
              <?php echo $row->Rooms; ?><br>
              <img src="images/amenities.png" alt="">
              <?php echo $row->Amenities; ?><br>
              <img src="images/clock.png" alt="">
              <h7> <strong><?php echo $row->OHDateTime; ?></strong> </h7>
              <br>
            </div>
          </div>
          <?php
          if(!session_id()) session_start();
          if(!isset($_SESSION['filename'])){?>
            <a href="login.php" class="btn btn-danger" method="post">Interesting</a>
          <?php
        }elseif (($_SESSION['type']=="Tenant")) {?>
          <form action="detailpay.php" method="post">
            <input type="hidden" name="plotid" value= '<?php echo $row->Plot; ?>'>
            <input type="submit" class="btn btn-primary btn-block" name="buy" value="BUY">
            <!--<input type="button" class="btn btn-danger btn-block" name="interested" value="Interested">-->
          </form>
          <form method="post" action="subscribeopen.php?id=<?php echo $row->Plot; ?>">
              <input type="hidden" name="loc" value= "<?php echo $loc; ?>">
              <input type="hidden" name="room" value= "<?php echo $room; ?>">
              <input type="hidden" name="price" value= "<?php echo $price; ?>">
              <input type="submit" class="btn btn-danger btn-block" name="interested" value="Interested">
          </form>
      <?php
        }else
          { ?>
            <form method="post" action="subscribeopen.php?id=<?php echo $row->Plot; ?>">
                <input type="hidden" name="loc" value= "<?php echo $loc; ?>">
                <input type="hidden" name="room" value= "<?php echo $room; ?>">
                <input type="hidden" name="price" value= "<?php echo $price; ?>">
                <input type="submit" class="btn btn-danger btn-block" name="interested" value="Interested">
            </form>
        <?php }
          ?>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>
<?php

        }else {
          echo "<br/><br/><h2>No results found!</h2>";
          header( "refresh:3;url=detailsearch.php" );
        }

      }
      else {
        echo "not an object/Array";
      }

include 'footer.php';
?>
