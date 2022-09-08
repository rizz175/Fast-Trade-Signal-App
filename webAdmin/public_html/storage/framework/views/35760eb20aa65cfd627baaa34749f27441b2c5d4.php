

<?php $__env->startSection('title'); ?>
    Users
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Add New User</h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="<?php echo e(route('user.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter Name" required>
                        </div>
                        
                        <div class="form-group col-md-4">
                            <label>Email</label>
                            <input name="email" placeholder="Enter Email" type="email" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>User Name</label>
                            <input name="user_name" placeholder="Enter user name" type="email" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Password</label>
                            <input name="password" placeholder="Enter Password" type="password" class="form-control" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                    
                </form>
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
                <th>Name</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Action</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = App\Models\User::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($key+1); ?></td>
                <td><?php echo e($user->name); ?></td>
                <td><?php echo e($user->user_name); ?></td>
                <td><?php echo e($user->email); ?></td>
                <td>
                    <button data-toggle="modal" data-target="#edit_modal" name="<?php echo e($user->name); ?>" user_name ="<?php echo e($user->user_name); ?>"
                    id="<?php echo e($user->id); ?>" email="<?php echo e($user->email); ?>" class="edit-btn btn btn-primary">Edit</button>
                </td>
                <td>
                    <form action="<?php echo e(route('user.destroy',$user->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<div id="edit_modal" class="modal fade">
    <div class="modal-dialog">
        <form id="updateForm" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Update User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Enter name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="Enter email" required>
                    </div> 
                    
                    <div class="form-group">
                        <label for="user_name">User Name</label>
                        <input class="form-control" type="email" id="user_name" name="user_name" placeholder="Enter user name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Enter New Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function(){
        $('.edit-btn').click(function(){

            let name = $(this).attr('name');
            let id = $(this).attr('id');
            let email = $(this).attr('email');
            let user_name = $(this).attr('user_name');

            $('#name').val(name);
            $('#id').val(id);
            $('#email').val(email);
            $('#user_name').val(user_name);

            $('#updateForm').attr('action','<?php echo e(route('user.update','')); ?>' +'/'+id);
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/lmd3tsijnint/public_html/resources/views/user/index.blade.php ENDPATH**/ ?>