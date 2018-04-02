<?php
include 'headeragent.php';
include 'structure.php';
include 'dataaccesslayer/DAL.php';

$dal = new DAL();
  $rand = "";
  $mail = "";

?>

<h2>Tenant Authentication</h2>
<form class="form-group" method="post">
  <input type="text" name="searchterm" placeholder="Email/Name"/required>
  <input type="submit" class="btn btn-danger" name="search" value="Search">
</form>

  <table class ="table table-striped table-border table-hover ">
  			<thead>
  				<tr>
  					<th>Name</th>
            <th>Email</th>
            <th></th>
  				</tr>
  			</thead>
  			<body>
  			<?php
  			if(isset($_POST['search'])){
  				$dal = new DAL();
  				$results = $dal->tenantsearch($_POST['searchterm']);

  				foreach($results as $row){?>
  					<tr>
              <td><?php echo $row->Name?></td>
  						<td><?php echo $row->Email?></td>
  						<td>
                <form  method="post">
                  <input type="hidden" name="id" value="<?php echo $row->Tenant_ID?>"/>
				  <input type="hidden" name="mail" value="<?php echo $row->Email?>"/>
                  <input type="submit" class="btn btn-success" name="issuegid" value="Generate ID">
                </form>
              </td>
  					</tr><?php

            $mail = $row->Email;
          }
        }
      if (isset($_POST['issuegid'])) {
        $rand = $dal->generategid();

        $id = $_POST['id'];
		$email = $_POST['mail'];
        
		$gID=$dal->tenantgid($rand, $id);
		
        echo("<meta http-equiv='refresh:3' content='1'>");
		

$to      = $email;
$subject = 'Fake sendmail test';
$message = 'This is youe genuine ID: '.$rand;
$headers = 'From: 1234gs4567@gmail.com' . "\r\n" .
    'Reply-To: 1234gs4567@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if(mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully!';
} else {
    die('Failure: Email was not sent!');
}

include 'footer.php';
      }

  			?>
  			</body>
  		</table>
<?php

?>
