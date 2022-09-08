<?php
  
  $login=$this->session->userdata("login");
  

    function time_elapsed_string($datetime, $full = false) {
      $now = new DateTime;
      $ago = new DateTime($datetime);
      $diff = $now->diff($ago);

      $diff->w = floor($diff->d / 7);
      $diff->d -= $diff->w * 7;

      $string = array(
          'y' => 'year',
          'm' => 'month',
          'w' => 'week',
          'd' => 'day',
          'h' => 'hour',
          'i' => 'minute',
          's' => 'second',
      );
      foreach ($string as $k => &$v) {
          if ($diff->$k) {
              $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
          } else {
              unset($string[$k]);
          }
      }

      if (!$full) $string = array_slice($string, 0, 1);
      return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?=@$pagetitle?></title>

  <link rel="shortcut icon" href="<?=site_url("assets/images/favicon.png")?>">

  <!-- Custom fonts for this template -->
  <link href="<?=site_url("assets/theme/")?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?=site_url("assets/theme/")?>css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?=site_url("assets/theme/")?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <style>
  	
	.switch {
	  position: relative;
	  display: inline-block;
	  width: 60px;
	  height: 34px;
	}
	
	.switch input { 
	  opacity: 0;
	  width: 0;
	  height: 0;
	}
	
	.slider {
	  position: absolute;
	  cursor: pointer;
	  top: 0;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  background-color: #ccc;
	  -webkit-transition: .4s;
	  transition: .4s;
	}
	
	.slider:before {
	  position: absolute;
	  content: "";
	  height: 26px;
	  width: 26px;
	  left: 4px;
	  bottom: 4px;
	  background-color: white;
	  -webkit-transition: .4s;
	  transition: .4s;
	}
	
	input:checked + .slider {
	  background-color: #2196F3;
	}
	
	input:focus + .slider {
	  box-shadow: 0 0 1px #2196F3;
	}
	
	input:checked + .slider:before {
	  -webkit-transform: translateX(26px);
	  -ms-transform: translateX(26px);
	  transform: translateX(26px);
	}
	
	/* Rounded sliders */
	.slider.round {
	  border-radius: 34px;
	}
	
	.slider.round:before {
	  border-radius: 50%;
	}


  .lds-roller {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
  }
  .lds-roller div {
    animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    transform-origin: 40px 40px;
  }
  .lds-roller div:after {
    content: " ";
    display: block;
    position: absolute;
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #fff;
    margin: -4px 0 0 -4px;
  }
  .lds-roller div:nth-child(1) {
    animation-delay: -0.036s;
  }
  .lds-roller div:nth-child(1):after {
    top: 63px;
    left: 63px;
  }
  .lds-roller div:nth-child(2) {
    animation-delay: -0.072s;
  }
  .lds-roller div:nth-child(2):after {
    top: 68px;
    left: 56px;
  }
  .lds-roller div:nth-child(3) {
    animation-delay: -0.108s;
  }
  .lds-roller div:nth-child(3):after {
    top: 71px;
    left: 48px;
  }
  .lds-roller div:nth-child(4) {
    animation-delay: -0.144s;
  }
  .lds-roller div:nth-child(4):after {
    top: 72px;
    left: 40px;
  }
  .lds-roller div:nth-child(5) {
    animation-delay: -0.18s;
  }
  .lds-roller div:nth-child(5):after {
    top: 71px;
    left: 32px;
  }
  .lds-roller div:nth-child(6) {
    animation-delay: -0.216s;
  }
  .lds-roller div:nth-child(6):after {
    top: 68px;
    left: 24px;
  }
  .lds-roller div:nth-child(7) {
    animation-delay: -0.252s;
  }
  .lds-roller div:nth-child(7):after {
    top: 63px;
    left: 17px;
  }
  .lds-roller div:nth-child(8) {
    animation-delay: -0.288s;
  }
  .lds-roller div:nth-child(8):after {
    top: 56px;
    left: 12px;
  }
  @keyframes lds-roller {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }

  #loading_div{
    background:rgba(0,0,0,0.5);
    position:fixed;
    width:100%;
    height:100%;
    z-index:1000000;
    display:none;
  }

  #loading_div .lds-roller{
    position: absolute;
    top: 50%;
    left: 50%;
    -ms-transform: translate(-50%, -100%);
    -webkit-transform: translate(-50%, -100%);
    transform: translate(-50%, -100%);
    vertical-align: middle;
  }

  #loading_percentage{
    position:fixed;
    top:0px;
    z-index:10000000;
    width:100%;
    display:none;
  }

  .btn-dropdown-div .btn-dropdown-option{
    border:1px solid #eee;
    border-radius:0px;
  }

  .btn-dropdown-div .btn-dropdown-option::after{
    display:none!important;
  }

  .btn-dropdown-div .dropdown-menu{
    border-radius:0px!important;
  }

  .btn-dropdown-div .dropdown-menu {
      min-width: auto!important;
      padding: 0px
  }

  .btn-dropdown-div a.dropdown-item {
      border-bottom: 1px solid #eee;
  }

  .bg-blue1{
    background: #5d7bd5!important;
    padding: 0px!important;
    border-radius: 0px!important;nt;
  }

  .collapse-page{
    margin: 0px!important;
    padding: 0px!important;
  }

  .bg-blue1 a{
    color: #fff!important;
    border-radius: 0px!important;
    margin: 0px!important;
    margin: 0px!important;
    padding: 10px 30px!important;
  }

  .bg-blue1 a:hover{
    background: #3356bb!important;
  }

  </style>
  
  
</head>

<body id="page-top">

  
  <div id="loading_percentage">
    <div class="progress progress-sm rounded-0">
      <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
    </div>
  </div>

  <div id="loading_div">
    <center><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></center>
  </div>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=site_url(".")?>">
        <img src="<?=site_url('assets/images/logo.png')?>" height="50">
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?=@$activeMenu=="dashboard"?"active":""?>">
        <a class="nav-link" href="<?=site_url("dashboard")?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      

      <!-- Heading -->
      <div class="sidebar-heading">
        Pages
      </div>

      
      <!-- Nav Item - Orders -->
      <li class="nav-item <?=@$activeMenu=="Orders"?"active":""?>">
        <a class="nav-link" href="<?=site_url("dashboard/orders/all")?>">
          <i class="fas fa-cart-arrow-down"></i>
          <span>Orders</span></a>
      </li>


      <!-- Nav Item - Users -->
      <li class="nav-item <?=@$activeMenu=="users"?"active":""?>">
        <a class="nav-link" href="<?=site_url("dashboard/users")?>">
          <i class="fas fa-fw fa-users"></i>
          <span>Users</span></a>
      </li>

      <!-- Nav Item - Track Users -->
      <li class="nav-item <?=@$activeMenu=="trackusers"?"active":""?>">
        <a class="nav-link" href="<?=site_url("dashboard/track/users")?>">
          <i class="fas fa-map-marked-alt"></i>
          <span>Track Users</span></a>
      </li>

       <!-- Nav Item - Track Users -->
       <li class="nav-item <?=@$activeMenu=="circleviolations"?"active":""?>">
        <a class="nav-link" href="<?=site_url("dashboard/cirlceviolation")?>">
          <i class="fas fa-ban"></i>
          <span>Circle Violations</span></a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?=@$activeMenu=="products"?"active":""?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesProduct" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-shopping-cart"></i>
          <span>Products</span>
        </a>
        <div id="collapsePagesProduct" class="collapse-page collapse <?=@$activeMenu=="products"?"show":""?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-blue1 py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Login Screens:</h6> -->
            <a class="collapse-item" href="<?=site_url("dashboard/product/add")?>">Add new product</a>
            <a class="collapse-item" href="<?=site_url("dashboard/product/all")?>">All products</a>
          
          </div>
        </div>
      </li>


      
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?=@$activeMenu=="blogs"?"active":""?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Blogs</span>
        </a>
        <div id="collapsePages" class="collapse-page collapse <?=@$activeMenu=="blogs"?"show":""?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-blue1 py-2 collapse-inner rounded">
            <!-- <h6 class="collapse-header">Login Screens:</h6> -->
            <a class="collapse-item" href="<?=site_url("dashboard/blog/add")?>">Add new blog</a>
            <a class="collapse-item" href="<?=site_url("dashboard/blog/all")?>">All blogs</a>
          
          </div>
        </div>
      </li>


      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      
      <!-- Heading -->
      <div class="sidebar-heading">
        Others
      </div>

      <!-- Nav Item --->
      <li class="nav-item <?=@$activeMenu=="settings"?"active":""?>">
        <a class="nav-link" href="<?=site_url("settings")?>">
          <i class="fas fa-cog"></i>
          <span>Settings</span></a>
      </li>

      <!-- Nav Item --->
      <li class="nav-item <?=@$activeMenu=="logout"?"active":""?>">
        <a class="nav-link" href="<?=site_url("logout")?>">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>



      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form> -->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <!-- <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li> -->

            <!-- Nav Item - Alerts -->
            <li class="d-none nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="d-none nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$login->fname." ".$login->lname?></span>
                 
                 <?php if($login->profile_pic){ ?>
                 	
                    <img class="img-profile rounded-circle" src="<?=site_url("assets/imgs/profile/").$login->profile_pic?>">
                 <?php }else{ ?>
                 
                 	<img class="img-profile rounded-circle" src="<?=site_url("assets/imgs/profile/default.png")?>">
                    
                 <?php } ?>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a> -->
                <a class="dropdown-item" href="<?=site_url("settings")?>">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
              
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <div class="container-fluid">
          <?php if($this->session->flashdata('error')){ ?>
          <div class="alert alert-danger"><?=$this->session->flashdata('error')?></div>
          <?php } elseif($this->session->flashdata('success')){ ?>
          <div class="alert alert-success"><?=$this->session->flashdata('success')?></div>
          <?php } ?>
        </div>