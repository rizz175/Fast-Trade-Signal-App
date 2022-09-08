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

$sql = "SELECT * from forexes where deleted_at!='NULL'";
 
$db_data = array();
 
$result = $conn->query($sql);

if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        $db_data[] = $row;
    }
    
    echo json_encode($db_data);
}
else
{
    echo "error";
}

$conn->close();

return;

?>