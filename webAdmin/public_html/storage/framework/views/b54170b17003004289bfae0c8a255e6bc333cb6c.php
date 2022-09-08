<style>
    @media (min-width: 576px) {
        .login-form {
            width: 56rem !important;
        }
    }

</style>
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="content d-flex justify-content-center align-items-center">

            <!-- Login form -->
            <form class="login-form" method="POST" action="<?php echo e(route('admin.login')); ?>">
                <?php echo csrf_field(); ?>
                <div class="card mb-0">
                    <div class="card-header"><h4><?php echo e(__('Signal Trading System')); ?></h4></div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i
                                class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                            <h5 class="mb-0">Login to your account</h5>
                            <span class="d-block text-muted">Enter your credentials below</span>
                        </div>
                        

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="email" id="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus
                                placeholder="Username">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                        </div>

                        

                        <div class="form-group form-group-feedback form-group-feedback-left">
                            <input type="password" id="password"
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required
                                autocomplete="current-password" placeholder="Password">
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($message); ?></strong>
                                </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <div class="form-check">
                                <label class="form-check-label" for="remember">
                                    <input type="checkbox" name="remember" id="remember"
                                        <?php echo e(old('remember') ? 'checked' : ''); ?> class="form-input-styled" data-fouc>
                                    <?php echo e(__('Remember Me')); ?>

                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                <?php echo e(__('Login')); ?>

                                <i class="icon-circle-right2 ml-2"></i></button>
                        </div>
                        
                        <div class="text-center">
                            <?php if(Route::has('password.request')): ?>
                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    <?php echo e(__('Forgot Your Password?')); ?>

                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </form>
            <!-- /login form -->

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\signal\resources\views/auth/login.blade.php ENDPATH**/ ?>