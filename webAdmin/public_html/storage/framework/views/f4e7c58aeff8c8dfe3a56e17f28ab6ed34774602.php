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


	<!-- Page content -->
	<div class="page-content">


		<!-- /main sidebar -->

		<!-- Main content -->
		<div class="content-wrapper">

	
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">

				<?php echo $__env->yieldContent('content'); ?>

			</div>
			<!-- /content area -->


		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

	<script>
	
	</script>

	<?php echo $__env->yieldContent('scripts'); ?>


	<script>
	
	</script>
	
	<script src="<?php echo e(asset('toastr/toastr.min.js')); ?>"></script>
	<?php echo app('toastr')->render(); ?>
</body>

</html>
<?php /**PATH /home/lmd3tsijnint/public_html/resources/views/layouts/app.blade.php ENDPATH**/ ?>