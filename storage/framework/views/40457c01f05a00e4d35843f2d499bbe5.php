 

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1><strong>Settings</strong></h1>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <!-- Update Profile Form -->
        <div>
            <h2>Update Profile</h2>
            <form method="POST" action="<?php echo e(route('settings.updateProfile')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Profile Picture -->
                <div class="form-group">
                    <label for="profile_picture">Profile Picture:</label>
                    <input type="file" name="profile_picture" id="profile_picture">
                </div>

                <!-- Submit Button -->
                <button type="submit">Update Profile</button>
            </form>
        </div>

        <!-- Change Password Form -->
        <div>
            <h2>Change Password</h2>
            <form method="POST" action="<?php echo e(route('settings.changePassword')); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Current Password -->
                <div class="form-group">
                    <label for="current_password">Current Password:</label>
                    <input type="password" name="current_password" id="current_password" required>
                </div>

                <!-- New Password -->
                <div class="form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" name="new_password" id="new_password" required>
                </div>

                <!-- Confirm New Password -->
                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password:</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required>
                </div>

                <!-- Submit Button -->
                <button type="submit">Change Password</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php if(session('success')): ?>
    <div class="alert alert-success" style="background-color: red;"><?php echo e(session('success')); ?></div>
<?php endif; ?>
<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/settings.css')); ?>">
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\GEE\Desktop\ambulance-booking-system\resources\views/settings/index.blade.php ENDPATH**/ ?>