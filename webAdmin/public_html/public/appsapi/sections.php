<?php
ob_start();
session_start();

$servername = "localhost";

$username = 'skyefxhp_midland';

$password = 'pc78gLxDNnXF';

$dbname = 'skyefxhp_midland';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * from wsections";
 
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