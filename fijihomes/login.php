<?php
ob_start();
include 'loggedoutheader.php';
include 'structure.php';
include 'dataaccesslayer/DAL.php';
?>
<form class ="form-group" method = "post">
<div  class = "col-md-6 offset-md-3">
	<br/><br/>
	<p>Email<input type ="email" class ="form-control" name ="email" required/></p>
	<p>Password<input type ="password" class ="form-control" name ="password" required/></p>
	<p><input type="submit" name ="login" class="btn btn-success" value="LOGIN"/>
	<button type="button" class="btn btn-danger" onclick ="window.location='index.php'" >Cancel</button></p>
	<br/><br/>
	<p> Dont have an account?  <a href="create.php" class="text-center" >  Click here to create one</a> </p>
</div>
</form>

<?php
if(isset($_POST['login'])){
	$dal = new DAL();
	$results = $dal->login($_POST['email']);
	$row=$results;



	if($results){

		session_start();
		unset($_SESSION['filename']);
		unset($_SESSION['type']);
		if(!isset($_SESSION['filename'])) {
				$_SESSION['filename'] = $_POST['email'];
				$_SESSION['type'] = $row[0]->Type;
		}

			if($_POST['password']==$row[0]->Password){
					if($row[0]->Type == "Manager"){
							header('Location: m_main.php');
					}
					elseif($row[0]->Type == "Agent"){
							header('Location: a_main.php');
					}
					elseif($row[0]->Type == "Owner"){;
							header('Location: o_main.php');
					}else{
						header('Location: t_main.php');
					}
			}
			else{?>
			<p class= "text-center"><font color= "red" size =4>The password is incorrect<br/></font></p>
			<?php
			}
	}
	else{?>
		<p class= "text-center"><font color= "red" size =4>The username is incorrect<br/></font></p>
		<?php
	}
}
include 'footer.php';?>
