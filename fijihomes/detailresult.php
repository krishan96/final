<?php
ob_start();
include 'check.php';
include 'dataaccesslayer/DAL.php';
?>
<div class="text-center bg-dark">
  <br>
  <h5 class="text-white card-title">SEARCH HOUSE</h5>
  <form class="w-75" action ="detailresult.php" method ="post" style="margin: 0 auto">
      <input class="form-control" type = "text" name ="searchkey" placeholder="Search..."/required>
      <br>
      <input type="text" name="rooms" placeholder="# Rooms">
      <input type="text" name="price" placeholder="$ Max Price">
      <br><br>
      <input class="btn" type="submit" name ="showall" value ="SEARCH">
      <br>
      <br>
  </form>
  <p class="card-text text-white">Please enter the area in which you would like to search for the house.</p><br>
</div> <br>

<?php
    if (isset($_POST['showall']) || isset($_POST['showagain'])) {
      $loc = $_POST['searchkey'];
      $room = $_POST['rooms'];
      $price = $_POST['price'];

      $dal = new DAL();
      $result = $dal->detailsearch($loc, $room, $price);
      if (is_array($result) || is_object($result)) {
        if ($result) {

?>
            <div class="container">
              <div class="row"><?php foreach($result as $row){ ?>
                <div class="col-sm-3 d-flex pb-3">

                  <div class="card text-center " >
                    <a href="images.php?id=<?php echo $row->Plot ?>"><?php
                      $res = $dal->displayImages($row->Plot);
                      $row2 = $res;
                      echo '<img style ="max-height:150px;" class="card-img-top img-fluid" src="data:image/jpeg;base64,'.base64_encode($row2[0]->Images).'"/>';
                    ?></a>
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
                      <form method="post" action="subscribe.php?id=<?php echo $row->Plot; ?>">
                          <input type="hidden" name="loc" value= "<?php echo $loc; ?>">
                          <input type="hidden" name="room" value= "<?php echo $room; ?>">
                          <input type="hidden" name="price" value= "<?php echo $price; ?>">
                          <input type="submit" class="btn btn-danger btn-block" name="interested" value="Interested">
                      </form>
                  <?php
                    }else
                      { ?>
                        <form method="post" action="subscribe.php?id=<?php echo $row->Plot; ?>">
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
            <script>
function toogleButton(callingElement,hiddenElement)
  {
    // Check the color of the button
    if (callingElement.classList.contains('btn-secondary'))
    {
        // If the button is 'unset'; change color and update hidden element to 1
        callingElement.classList.remove('btn-secondary');
        callingElement.classList.add('btn-success');
        document.getElementById(hiddenElement).value="1";

    }
    else
    {
        // If the button is 'set'; change color and update hidden element to 0
        callingElement.classList.remove('btn-success');
        callingElement.classList.add('btn-secondary');
        document.getElementById(hiddenElement).value="0";
    }
  }
</script>
<?php

        }else {
          echo "<br/><br/><h2>No results found!</h2>";
          // header( "refresh:3;url=detailsearch.php" );
        }

      }
      else {
        echo "not an object/Array";
      }
    }
include 'footer.php';
?>
