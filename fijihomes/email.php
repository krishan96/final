<?php
include 'dataaccesslayer/DAL.php';

$dal = new DAL();
$result = $dal->Email_Date();
if($result){
	foreach($result as $row){
		$email= $row->Email;
		$date = date_create($row->OHDateTime);
		echo date_format($date, 'g:ia \o\n l jS F Y');

		$subject = 'Fiji Homes Notification';
		$message = ' The property you subscribed to has an Open House Day at '.date_format($date, 'g:ia \o\n l jS F Y').' at '.$row->Area.", ".$row->Address.'. You are welcome to join!';
		echo $message;
		$headers = 'From: 1234gs4567@gmail.com' . "\r\n" .
			'Reply-To: 1234gs4567@gmail.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

		if(mail($email, $subject, $message, $headers)) {
			echo 'Email sent successfully!';
			$PlotID=$row->Plot;
			$result2 = $dal->update_subscribe($email, $PlotID);
			if($result2) echo"done";
			else echo"not deon";
		} else {
			die('Failure: Email was not sent!');
		}
	}
}else echo"no result found";
?>
