<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Trading Signal System</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('global_assets/css/icons/icomoon/styles.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('assets/css/bootstrap_limitless.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('assets/css/layout.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('assets/css/components.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('assets/css/colors.min.css')); ?>" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
	<?php echo $__env->yieldContent('styles'); ?>


	<!-- Core JS files -->
	<script src="<?php echo e(asset('global_assets/js/main/jquery.min.js')); ?>"></script>
	<script src="<?php echo e(asset('global_assets/js/main/bootstrap.bundle.min.js')); ?>"></script>
	<script src="<?php echo e(asset('global_assets/js/plugins/loaders/blockui.min.js')); ?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?php echo e(asset('global_assets/js/plugins/tables/datatables/datatables.min.js')); ?>"></script>
	<script src="<?php echo e(asset('global_assets/js/plugins/tables/datatables/extensions/buttons.min.js')); ?>"></script>
	<script src="<?php echo e(asset('global_assets/js/demo_pages/datatables_extension_buttons_print.js')); ?>"></script>

	<script src="<?php echo e(asset('assets/js/loader.js')); ?>"></script>
	
	<script src="<?php echo e(asset('global_assets/js/plugins/forms/selects/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('global_assets/js/plugins/forms/styling/uniform.min.js')); ?>"></script>
    
	<script src="<?php echo e(asset('global_assets/js/plugins/visualization/d3/d3.min.js')); ?>"></script>
	<script src="<?php echo e(asset('global_assets/js/plugins/visualization/d3/d3_tooltip.js')); ?>"></script>
	<script src="<?php echo e(asset('global_assets/js/plugins/forms/styling/switchery.min.js')); ?>"></script>
	<script src="<?php echo e(asset('global_assets/js/plugins/forms/selects/bootstrap_multiselect.js')); ?>"></script>
	<script src="<?php echo e(asset('global_assets/js/plugins/ui/moment/moment.min.js')); ?>"></script>
	<script src="<?php echo e(asset('global_assets/js/plugins/pickers/daterangepicker.js')); ?>"></script>

	<script src="<?php echo e(asset('assets/js/app.js')); ?>"></script>
	<script src="<?php echo e(asset('global_assets/js/demo_pages/datatables_basic.js')); ?>"></script>
	<script src="<?php echo e(asset('global_assets/js/demo_pages/form_layouts.js')); ?>"></script>
	<script src="<?php echo e(asset('global_assets/js/demo_pages/dashboard.js')); ?>"></script>
	<script src="<?php echo e(asset('global_assets/js/demo_pages/login.js')); ?>"></script>

	<link rel="stylesheet" href="<?php echo e(asset('toastr/toastr.min.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- /theme JS files -->
	
</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand">
			<a href="<?php echo e(route('dashboard')); ?>" class="d-inline-block">
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
							<a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(Request::is('dashboard') || Request::is('/')?'active':''); ?>">
								<i class="icon-home4"></i>
								<span>Dashboard</span>
							</a>
						</li><li class="nav-item">
							<a href="" class="nav-link <?php echo e(Request::is('market') || Request::is('/market')?'active':''); ?>">
								<i class="icon-home4"></i>
								<span>Market</span>
							</a>
						</li><li class="nav-item">
							<a href="<?php echo e(route('forex.index')); ?>" class="nav-link <?php echo e(Request::is('forex') || Request::is('/forex')?'active':''); ?>">
								<i class="icon-home4"></i>
								<span>Forex Signals</span>
							</a>
						</li><li class="nav-item">
							<a href="<?php echo e(route('historicalForex')); ?>" class="nav-link <?php echo e(Request::is('historical/forex') || Request::is('historical/forex')?'active':''); ?>">
								<i class="icon-home4"></i>
								<span>Historical Forex Signals</span>
							</a>
						</li><li class="nav-item">
							<a href="<?php echo e(route('crypto.index')); ?>" class="nav-link <?php echo e(Request::is('crypto') || Request::is('/crypto')?'active':''); ?>">
								<i class="icon-home4"></i>
								<span>Crypto Signals</span>
							</a>
						</li><li class="nav-item">
							<a href="<?php echo e(route('historicalCrypto')); ?>" class="nav-link <?php echo e(Request::is('historical/crypto') || Request::is('historical/crypto')?'active':''); ?>">
								<i class="icon-home4"></i>
								<span>Historical Crypto Signals</span>
							</a>
						</li><li class="nav-item">
							<a href="" class="nav-link <?php echo e(Request::is('analysis') || Request::is('/analysis')?'active':''); ?>">
								<i class="icon-home4"></i>
								<span>Analysis</span>
							</a>
						</li><li class="nav-item">
							<a href="" class="nav-link <?php echo e(Request::is('charts') || Request::is('/charts')?'active':''); ?>">
								<i class="icon-home4"></i>
								<span>Charts</span>
							</a>
						</li>
                        <li class="nav-item nav-item-submenu <?php echo e(Request::is('user') || Request::is('user') || Request::is('user')?'nav-item-open':''); ?>">
							<a href="#" class="nav-link"><i class="icon-credit-card"></i> <span>Users</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts" style="<?php echo e(Request::is('/user') || Request::is('/user') || Request::is('/user')?'display:block':''); ?>">
								<li class="nav-item"><a href="<?php echo e(route('user.index')); ?>" class="nav-link <?php echo e(Request::is('/user')?'active':''); ?>">Index </a></li>
							</ul>
						</li>
						
						<li class="nav-item">
							<a href="https://appadmin1.xyz/public/tmessage.php" class="nav-link " target="_blank">
								<i class="icon-home4"></i>
								<span> Trader's Messages</span>
							</a>
						</li>
						
						<li class="nav-item">
							<a href="<?php echo e(route('setting.index')); ?>" class="nav-link <?php echo e(Request::is('setting') || Request::is('/setting')?'active':''); ?>">
								<i class="icon-home4"></i>
								<span>Settings</span>
							</a>
						</li>
						
                        <li class="nav-item">
							<a href="<?php echo e(route('admin.logout')); ?>" class="nav-link <?php echo e(Request::is('admin/logout') || Request::is('admin/logout')?'active':''); ?>">
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
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"><?php echo $__env->yieldContent('title'); ?></span></h4>
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

				<?php echo $__env->yieldContent('content'); ?>

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

	<script>
	
	</script>
    <!--<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>-->
	<?php echo $__env->yieldContent('scripts'); ?>


	<script>
	
	</script>
	
	<script src="<?php echo e(asset('toastr/toastr.min.js')); ?>"></script>
	<?php echo app('toastr')->render(); ?>
</body>

</html>
<?php /**PATH /home/lmd3tsijnint/public_html/resources/views/layout.blade.php ENDPATH**/ ?>