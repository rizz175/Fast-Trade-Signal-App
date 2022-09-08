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

$email=$_POST['email'];

$deviceid=$_POST['deviceid'];

$sql123 = "update users set isLoggedIn = '0', playerId = ''  WHERE email = '$email' and device_id='$deviceid'";

$result123 = $conn->query($sql123);

$response['error'] = false;
    		
$response['message'] = 'You have successfully Logged Out';

echo json_encode($response);

?>