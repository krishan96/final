<?php
//$dal = new DAL();
$Id=$_GET['Id'];
echo "This is a test for id ".$Id;
?>

<!-- Modal Header -->
<div class="modal-header">
  <h4 class="modal-title">Owner Details</h4>
  <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
  THis will show all of the owner details
  <?php $result3=$dal->showownerdetails(2);
  $row3 = $result3 ?>
  <div class ="form-group">
    <label for="fname" class="form-label col-xs-3"><font size =3>First Name</font></label>
    <div class ="col-xs-8">
    <input name="fname" type="text" class ="form-control" value="<?php echo $row3[0]->Name?>" required/>
    </div>
  </div>
  <div class ="form-group">
    <label for="lname" class="form-label col-xs-3"><font size =3>Last Name</font></label>
    <div class ="col-xs-8">
    <input name="lname" type="text" class ="form-control" value="<?php echo $row3[0]->G_ID?>" required/>
    </div>
  </div>
  <div class ="form-group">
    <label for="contact" class="form-label col-xs-3"><font size =3>contact</font></label>
    <div class ="col-xs-8">
    <input name="contact" type="text" class ="form-control" value="<?php echo $row3[0]->Contact?>" required/>
    </div>
  </div>
</div>

<!-- Modal footer -->
<div class="modal-footer">
  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>
