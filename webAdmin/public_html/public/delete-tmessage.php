<?php
ob_start();
session_start();

$servername = "localhost";

$username = 'signal_user';

$password = '$IvspDdA7az=';

$dbname = 'signal_db';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id=intval($_REQUEST['mid']);

$sql = "DELETE FROM `tmessages` WHERE`id` = '$id'";

$result = $conn->query($sql);

header("location:tmessage.php?msg=2");  

?>