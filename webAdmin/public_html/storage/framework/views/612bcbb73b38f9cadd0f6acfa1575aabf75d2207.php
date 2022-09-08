

<?php $__env->startSection('title'); ?>
    Setting
<?php $__env->stopSection(); ?>

<?php
    if($setting)
    {
        $support_email = $setting->support_email;
        $android_version = $setting->android_version;
        $ios_version = $setting->ios_version;
        $cover_image = $setting->cover_image;
        $image_url = $setting->image_url;
        $disclaimer = $setting->disclaimer;
    }
    else {
        $support_email = '';
        $android_version = '';
        $ios_version = '';
        $cover_image = '';
        $image_url = '';
        $disclaimer = '';
    }
?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">

            <?php if($errors->any()): ?>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <p class="text-danger"><?php echo e($error); ?></p>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            

            <div class="card-body">
                <form action="<?php echo e(route('setting.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Support Email</label>
                            <input name="support_email" type="text" class="form-control" placeholder="Enter support email" value="<?php echo e($support_email); ?>" required>
                        </div> 
                        <div class="form-group col-md-4">
                            <label>Android Version</label>
                            <input name="android_version" type="text" class="form-control" placeholder="Enter android version" value="<?php echo e($android_version); ?>" required>
                        </div> 
                        <div class="form-group col-md-4">
                            <label>IOS Version</label>
                            <input name="ios_version" type="text" class="form-control" placeholder="Enter IOS version" value="<?php echo e($ios_version); ?>" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cover Image</label>
                            <input name="cover_image" type="file" class="form-control">
                            <?php if($cover_image): ?>
                                <img src="<?php echo e(asset('uploads/'.$cover_image)); ?>" class="rounded mt-3" alt="profile Pic" height="200" width="200">
                            <?php endif; ?>
                        </div> 
                        <div class="form-group col-md-4">
                            <label>Image URL</label>
                            <input name="image_url" type="text" class="form-control" placeholder="Paste image URL" value="<?php echo e($image_url); ?>">
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label>Disclaimer</label>
                            <input name="disclaimer" type="text" class="form-control" placeholder="Enter Disclaimer" value="<?php echo e($disclaimer); ?>" required>
                        </div>
                        
                        
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    
                </form>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/lmd3tsijnint/public_html/resources/views/setting/index.blade.php ENDPATH**/ ?>