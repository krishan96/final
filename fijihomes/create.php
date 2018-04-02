<?php
ob_start();
  include 'loggedoutheader.php';
  include 'structure.php';
  include 'businessrules/user.php';
  include 'dataaccesslayer/DAL.php';
?>
<br>
<div class="col-md-6 offset-md-3">
<form method="POST" name="acc_create">
  <h1>REGISTRATION</h1>
		<div class="form-group">
      <input type="text" class="form-control" name="email" placeholder="Email"/required>
		</div>
    <div class="form-group">
      <input type="text" class="form-control" name="fname" placeholder="First Name"/required>
		</div>
    <div class="form-group">
      <input type="text" class="form-control" name="lname" placeholder="Last Name"/required>
		</div>
    <div class="form-group">
      <input type="text" class="form-control" name="address" placeholder="Address"/required>
		</div>
    <div class="form-group">
      <input type="tel" class="form-control" name="contact" placeholder="Contact"/required>
		</div>
    <div class="form-group">
      <input type="password" class="form-control" name="password" placeholder="Password"/required>
		</div>
    <div class="form-group">
      <input type="password" class="form-control" name="conf_password" placeholder="Confirm Password"/required>
		</div>

    <div class="form-group">
      <label for="sel1">Select list:</label>
      <select name="usertype" class="form-control" id="sel1"/required>
        <option value="1" >I am searching for a house</option>
        <option value="2" >I want to rent out my house</option>
      </select>
    </div>
		<p><button type="submit" name = "upload" class="btn btn-primary" method="post">Create</button>
    <button type="button" class="btn btn-danger" onclick ="window.location='index.php'" >Cancel</button></p>

	</form>
  <br><br>
</div>
<?php
if (isset($_POST['upload'])) {
if ($_POST['password']== $_POST['conf_password']) {
      $name = $_POST['fname']." ".$_POST['lname'];
      $option = $_POST['usertype'];
      $user = new User();
      $user->create($_POST['email'],$name,$_POST['contact'],$_POST['address'],$_POST['password']);
      $user->status="active";

      if ($option == '1') {
        $user->type = "Tenant";
        $user->addaccess();
        $user->addtenant();
        header('location:login.php');
      }else if ($option == '2') {
        $user->type= "Owner";
        $user->addaccess();
        $user->addowner();
        header('location:o_created.php');
      }
}else{
  ?>
  <p class= "text-center"> <font size =5 color = "red" >Your passwords do not match</font></p>
<?php
}
}
include "footer.php";
?>
