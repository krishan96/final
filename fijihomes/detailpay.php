<?php
include 'headertenant.php';
include 'dataaccesslayer/DAL.php';
if(isset($_POST['buy'])){
?>
<div class="container">
<div class= "row" >
  <div class="col-md-5 offset-md-1" >
    <br>
        <?php
        $dal = new DAL();
        $res = $dal->details($_POST['plotid']);
        $row=$res;
        $res1 = $dal->displayImages($_POST['plotid']);
        $row2 = $res;
        echo '<img class="card-img-top img-fluid" src="data:image/jpeg;base64,'.base64_encode($row2[0]->Images).'"/>';
        echo "<h4><br>";
        echo $row[0]->Address;
        echo "<br>$";
        echo $row[0]->Price;
        echo "<br>";
        echo $row[0]->Area;
        echo "</h4>";
        ?>
  </div>
  <div class="col-md-6">
    <form class ="form-horizontal" action = "confirm.php" method ="post" name="payform">
      <br><br>
      <div class="col-md-10 input-group">
          <input type="text" class="form-control" aria-label="Amount" value="Bond Amount" readonly/>
          <div class="input-group-append">
                <span class="input-group-text">$</span>
                <span class="input-group-text"><?php echo $row[0]->Price;?></span>
          </div>
      </div>
      <div class="col-md-10 input-group">
          <input type="text" class="form-control" aria-label="Amount" value="First Rent Amount" readonly/>
          <div class="input-group-append">
                <span class="input-group-text">$</span>
                <span class="input-group-text"><?php echo $row[0]->Price;?></span>
          </div>
      </div>
      <div class="col-md-10 input-group">
          <input type="text" class="form-control" aria-label="Amount" value="TOTAL" readonly/>
          <div class="input-group-append">
                <span class="input-group-text">$</span>
                <span class="input-group-text"><?php echo $row[0]->Price*2; echo ".00";?></span>
          </div>
      </div><br>
      <div class="col-md-10 input-group">
          <div class="input-group-prepend">
              <span class="input-group-text" id="">Enter Genuine Code for verification:</span>
          </div>
          <input type="text" class="form-control" name="gid"/required>
      </div><br>
      <div class="col-md-10 input-group mb-3">
          <div class="input-group-prepend">
          <div class="input-group-text">
              <input type="checkbox" aria-label="Checkbox for following text input"/required>
          </div>
          </div>
          <label class="form-control">
          <a href="https://termsfeed.com/terms-conditions/06ed4a4c57b49de1709d520c89553470">Terms and Conditions</a></label>
      </div><br>
      <div class="col-md-8">
        <input type="hidden" name="plotid" value="<?php echo $row[0]->Plot?>">
        <input type="hidden" name="price" value="<?php echo $row[0]->Price?>">
        <input type="button" onclick="window.location='search.php'" value="BACK" class="btn btn-danger"/>
        <input type="submit" name="paybutton" value="PAY" class="btn btn-success"/>
      </div>
    </form>
  </div>
</div>
</div>
<?php }
include "footer.php"; ?>
