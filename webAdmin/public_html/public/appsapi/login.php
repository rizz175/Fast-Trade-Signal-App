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

$keys=array('email','password');

for ($i = 0; $i < count($keys); $i++)
{
	if(!isset($_POST[$keys[$i]]))

	 {
		    $response['error'] = true;
		    
			$response['message'] = 'Required Fields Missed';
			
			echo json_encode($response);
			
		    return;
	 }

}

$email=$_POST['email'];

$password=md5($_POST['password']);

$deviceid=$_POST['deviceid'];

$playerId=$_POST['playerId'];

$sql = "SELECT * FROM users WHERE email = '$email' AND mpassword = '$password' AND device_id = '$deviceid'";

$result = $conn->query($sql);

if ($result->num_rows > 0) 
{
 
  while($row = $result->fetch_assoc())
  {

    	$user = array(
			'id'=>$row["id"],
			'name'=>$row["name"],
			'mobile'=>$row["user_name"],
			'password'=>$row["device_id"],
			'email'=>$row["email"],
			'isLoggedIn'=> 1

		);
		
		$sql123 = "update users set isLoggedIn = '1', playerId = '$playerId'  WHERE id = '$row[id]'";

        $result123 = $conn->query($sql123);
		
		$response['error'] = false;
		
		$response['message'] = 'You have successfully Logged In';
		
		$response['data'] = $user;
		
  }
  
}
else 
{
    
    $sql2 = "SELECT * FROM users WHERE email = '$email' AND mpassword = '$password' AND device_id = ''";

    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) 
    {
     
      while($row2 = $result2->fetch_assoc())
      {
    
        	$user = array(
    			'id'=>$row2["id"],
    			'name'=>$row2["name"],
    			'mobile'=>$row2["user_name"],
    			'password'=>$row2["device_id"],
    			'email'=>$row2["email"],
			    'isLoggedIn'=> 1
    
    		);
    		
    		$sql3 = "update users set isLoggedIn = '1', device_id = '$deviceid', playerId = '$playerId'  WHERE email = '$email' AND mpassword = '$password'";

            $result3 = $conn->query($sql3);
    		
    		$response['error'] = false;
    		
    		$response['message'] = 'You have successfully Logged In';
    		
    		$response['data'] = $user;
    		
      }
      
    }
    else
    {
    
  	    $response['error'] = true;
	
	    $response['message'] = 'Invalid User Name or Password';
	    
    }
	
}

echo json_encode($response);

?>