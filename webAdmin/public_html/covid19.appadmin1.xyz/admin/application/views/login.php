<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?=site_url("assets/images/favicon.png")?>">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?=site_url("assets/theme/")?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?=site_url("assets/theme/")?>css/sb-admin-2.min.css" rel="stylesheet">

  <style>
    .bg-gradient-primary1{
      background:#f9f9f9;
    }

    header{
      border-bottom:1px solid #eee;
    }

    footer{  
      border-top:1px solid #eee;
    }

  </style>

</head>

<body class="bg-gradient-primary1">

<header class="bg-white">
  <nav class="navbar navbar-expand-sm bg-light justify-content-center bg-white">
    <a href="<?=base_url()?>"><img src="<?=site_url("assets/images/logo.png")?>" height="70"></a>
  </nav>
</header>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-8 col-md-9 col-12">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                    
                    <?php if($this->session->flashdata('error')){ ?>
                    <div class="alert alert-danger"><?=$this->session->flashdata('error')?></div>
                    <?php } ?>
                    
                  </div>
                  <form class="user" action="<?=site_url("login")?>" method="post">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user required" name="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user required" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <input type="submit" value="Login" class="btn btn-primary btn-user btn-block">
                    
                   <!-- <hr>
                    <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a>-->
                  </form>
                  <hr>
                  <!--<div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div>-->
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
    

  </div>
  
  <style>.hidden{display:none;}</style>

  <footer class="sticky-footer bg-white mt-5 hidden">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
      <span>Copyright © CRMPS Developed by <a href="https://elexoft.com" target="_blank">Elexoft Technologies</a></span>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript-->
  <script src="<?=site_url("assets/theme/")?>vendor/jquery/jquery.min.js"></script>
  <script src="<?=site_url("assets/theme/")?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?=site_url("assets/theme/")?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?=site_url("assets/theme/")?>js/sb-admin-2.min.js"></script>

</body>

</html>
