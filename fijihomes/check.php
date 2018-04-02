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
?>
