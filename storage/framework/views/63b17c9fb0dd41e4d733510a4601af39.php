

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1><strong> ADD PATIENT</strong></h1>
        <form action="<?php echo e(route('admin.patient.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
            <div class="form-group">
                    <label for="passport">ID/Passport</label>
                    <input type="text" name="passport" id="passport" class="form-control" required>
                </div>
                <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" name="age" id="age" class="form-control" required>
                    </div>
                    <div class="form-group">
                            <label for="allergies">Allergies</label>
                            <input type="text" name="allergies" id="allergies" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="disabilities">Disabilities</label>
                            <input type="text" name="disabilities" id="disabilities" class="form-control" required>
                        </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/create.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>


    


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\GEE\Desktop\ambulance-booking-system\resources\views/admin/patient/create.blade.php ENDPATH**/ ?>