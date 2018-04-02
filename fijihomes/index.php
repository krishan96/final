<style>
.bg {
    /* The image used
    background-image: url("http://hillsboro.borczdixon.com/wp-content/uploads/2017/06/appleford-helena-alabama-1350x550.jpg");*/
    background-image: url(images/bg.jpg);
    /* Full height */
    height: 90%;
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
<?php
//ob_start();
//session_destroy();
//error_reporting(E_ERROR | E_PARSE);
session_start();
unset($_SESSION['filename']);
unset($_SESSION['type']);
include 'loggedoutheader.php';

include 'home.php';

include 'footer.php';
?>
