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

$target_dir = "messages/";

$target_file = $target_dir . basename($_FILES["msg_img"]["name"]);

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) 
{
	
	if($_FILES["msg_img"]["name"]!='')
	{	
	
		$msg_img=htmlspecialchars( basename( $_FILES["msg_img"]["name"]));

		move_uploaded_file($_FILES["msg_img"]["tmp_name"], $target_file);
		
	}
	else
	{
		$msg_img='forex_trading_signals-1.jpg';
		
	}
	
	$message=$_POST['message'];

	$created_at=date('Y-m-d H:i:s');
	
	$sql = "INSERT INTO `tmessages` (`message`, `msg_img`, `deleted_at`, `created_at`, `updated_at`) VALUES ('$message', '$msg_img', NULL, '$created_at', '$created_at')";

	$result = $conn->query($sql);
	
	$title = 'New Message: ' . $message;       
	
	$content = array(
	"en" => $title
	);

	$hashes_array = array();
	
	array_push($hashes_array, array(
		"id" => "like-button",
		"text" => "Like",
		"icon" => "http://i.imgur.com/N8SN8ZS.png",
		"url" => "https://appadmin1.xyz"
	));
	
	array_push($hashes_array, array(
		"id" => "like-button-2",
		"text" => "Like2",
		"icon" => "http://i.imgur.com/N8SN8ZS.png",
		"url" => "https://appadmin1.xyz"
	));
	
	$fields = array(
		'app_id' => "5db9b19b-f857-4806-b304-14b2efd45ebc",
		'included_segments' => array(
			'Subscribed Users'
		),
		'data' => array(
			"foo" => "bar"
		),
		'contents' => $content,
		'web_buttons' => $hashes_array,
		'large_icon' => "https://appadmin1.xyz/public/messages/$msg_img",

	);
	
	$fields = json_encode($fields);
	
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
	
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json; charset=utf-8',
		'Authorization: Basic NTM5NjQ1ZGUtOTFhMS00NGZiLWJjZDktOGNkODBhZjJmNThm'
	));
	
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	
	curl_setopt($ch, CURLOPT_POST, TRUE);
	
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	
	$response = curl_exec($ch);
	
	curl_close($ch);
	
	$return["allresponses"] = $response;
	
	$return = json_encode($return);
	
	$data = json_decode($response, true);
	
	$id = $data['id'];
	
	header("location:tmessage.php?msg=1");  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Trading Signal System</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="https://appadmin1.xyz/global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
	<link href="https://appadmin1.xyz/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="https://appadmin1.xyz/assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
	<link href="https://appadmin1.xyz/assets/css/layout.min.css" rel="stylesheet" type="text/css">
	<link href="https://appadmin1.xyz/assets/css/components.min.css" rel="stylesheet" type="text/css">
	<link href="https://appadmin1.xyz/assets/css/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="https://appadmin1.xyz/global_assets/js/main/jquery.min.js"></script>
	<script src="https://appadmin1.xyz/global_assets/js/main/bootstrap.bundle.min.js"></script>
	<script src="https://appadmin1.xyz/global_assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="https://appadmin1.xyz/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script src="https://appadmin1.xyz/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
	<script src="https://appadmin1.xyz/global_assets/js/demo_pages/datatables_extension_buttons_print.js"></script>

	<script src="https://appadmin1.xyz/assets/js/loader.js"></script>
	
	<script src="https://appadmin1.xyz/global_assets/js/plugins/forms/selects/select2.min.js"></script>
    <script src="https://appadmin1.xyz/global_assets/js/plugins/forms/styling/uniform.min.js"></script>
    
	<script src="https://appadmin1.xyz/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script src="https://appadmin1.xyz/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script src="https://appadmin1.xyz/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script src="https://appadmin1.xyz/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script src="https://appadmin1.xyz/global_assets/js/plugins/ui/moment/moment.min.js"></script>
	<script src="https://appadmin1.xyz/global_assets/js/plugins/pickers/daterangepicker.js"></script>

	<script src="https://appadmin1.xyz/assets/js/app.js"></script>
	<script src="https://appadmin1.xyz/global_assets/js/demo_pages/datatables_basic.js"></script>
	<script src="https://appadmin1.xyz/global_assets/js/demo_pages/form_layouts.js"></script>
	<script src="https://appadmin1.xyz/global_assets/js/demo_pages/dashboard.js"></script>
	<script src="https://appadmin1.xyz/global_assets/js/demo_pages/login.js"></script>

	<link rel="stylesheet" href="https://appadmin1.xyz/toastr/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- /theme JS files -->
	
</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand">
			<a href="https://appadmin1.xyz" class="d-inline-block">
				<h4 class="text-light"><b>Trading Signal</b></h4>
			</a>
		</div>

		<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>

		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
			</ul>

			<span class="badge bg-success ml-md-3 mr-md-auto">online System</span>
						
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								<a href="#">
								</a>
							</div>

							<div class="media-body">
								<div class="media-title font-weight-semibold"></div>
								<div class="font-size-xs opacity-50">
									<i class="icon-pin font-size-sm"></i> &nbsp; Testing
								</div>
							</div>

							<div class="ml-3 align-self-center">
								<a href="" class="text-white"><i class="icon-cog3"></i></a>
							</div>
						</div>
					</div>
				</div>
				<!-- /user menu -->


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->
						<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs"></div> <i class="icon-menu" title="Main"></i></li>

						<li class="nav-item">
							<a href="https://appadmin1.xyz" class="nav-link ">
								<i class="icon-home4"></i>
								<span>Dashboard</span>
							</a>
						</li><li class="nav-item">
							<a href="" class="nav-link ">
								<i class="icon-home4"></i>
								<span>Market</span>
							</a>
						</li><li class="nav-item">
							<a href="https://appadmin1.xyz/forex" class="nav-link active">
								<i class="icon-home4"></i>
								<span>Forex Signals</span>
							</a>
						</li><li class="nav-item">
							<a href="https://appadmin1.xyz/historical/forex" class="nav-link ">
								<i class="icon-home4"></i>
								<span>Historical Forex Signals</span>
							</a>
						</li><li class="nav-item">
							<a href="https://appadmin1.xyz/crypto" class="nav-link ">
								<i class="icon-home4"></i>
								<span>Crypto Signals</span>
							</a>
						</li><li class="nav-item">
							<a href="https://appadmin1.xyz/historical/crypto" class="nav-link ">
								<i class="icon-home4"></i>
								<span>Historical Crypto Signals</span>
							</a>
						</li><li class="nav-item">
							<a href="" class="nav-link ">
								<i class="icon-home4"></i>
								<span>Analysis</span>
							</a>
						</li><li class="nav-item">
							<a href="" class="nav-link ">
								<i class="icon-home4"></i>
								<span>Charts</span>
							</a>
						</li>
                        <li class="nav-item nav-item-submenu ">
							<a href="#" class="nav-link"><i class="icon-credit-card"></i> <span>Users</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts" style="">
								<li class="nav-item"><a href="https://appadmin1.xyz/user" class="nav-link ">Index </a></li>
							</ul>
						</li>
						
						<li class="nav-item">
							<a href="https://appadmin1.xyz/public/tmessage.php" class="nav-link ">
								<i class="icon-home4"></i>
								<span> Trader's Messages</span>
							</a>
						</li>
						
						<li class="nav-item">
							<a href="https://appadmin1.xyz/setting" class="nav-link ">
								<i class="icon-home4"></i>
								<span>Settings</span>
							</a>
						</li>
						
                        <li class="nav-item">
							<a href="https://appadmin1.xyz/admin/logout" class="nav-link ">
								<i class="icon-home4"></i>
								<span>Logout</span>
							</a>
						</li>


						<!-- /page kits -->
					</ul>
				</div>
				<!-- /main navigation -->
			</div>
			<!-- /sidebar content -->
		</div>
		<!-- /main sidebar -->

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"> Trader's Messages
</span></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none">
						<div class="d-flex justify-content-center">
							<div class="row">
								<div class="col-md-6">
								<i class="icon-info3 text-success"></i>
								</div>
								<div class="col-md-6">
								<i class="icon-info3 text-danger"></i>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">

				<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New Trader's Message</h5>
				
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
			
                <form action="" method="post" enctype="multipart/form-data">
				
                    <div class="row">
										
                        <div class="form-group col-md-4">
                            <label>Message</label>
							
							<textarea name="message" class="form-control" required></textarea>
							
                        </div> 
                        
                        <div class="form-group col-md-4">
                            <label>Image</label>
                            <input name="msg_img" id="msg_img" type="file" class="form-control">
                        </div>                        
                         
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Send Message</button>
                    
                </form>
				
				<?php
				
					if($_REQUEST['msg']==1)
					{				
				
				?>
		
				
					<br /><p align="center"><font color="red"><strong>Trader's Message Added Successfully</strong></font></p>
				
				<?php
				
					}
					
				?>
				
				<?php
				
					if($_REQUEST['msg']==2)
					{				
				
				?>
		
				
					<br /><p align="center"><font color="red"><strong>Trader's Message Deleted Successfully</strong></font></p>
				
				<?php
				
					}
					
				?>
				
				
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>

<div class="card">
    <table class="table datatable-save-state">
        <thead>
            <tr>
                <th>#</th>
                <th>Message</th>
                <th>Image</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
		
		<?php
		
		$sql2 = "SELECT * from tmessages";
 
		$result2 = $conn->query($sql2);
		
		while($row2 = $result2->fetch_assoc())
		{
			
?>
		
              <tr>
			  
                <td><?php echo $row2['id'];?></td>
				
				<td><?php echo $row2['message'];?></td>
				
				<td><img src="messages/<?php echo $row2['msg_img'];?>" width="25" height="25"></td>
				
				<td><a href="delete-tmessage.php?mid=<?php echo $row2['id'];?>" onclick="return confirm('Are you sure you want to delete this message?');">Delete</a></td>
				

              </tr>
			
		<?php
			
		}
		
		?>           
                        
                        
                    </tbody>
    </table>
</div>



			</div>
			<!-- /content area -->


			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Footer
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-footer">
					
				</div>
			</div>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->
	
</html>