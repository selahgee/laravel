

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <h1>PATIENTS</h1>
            </div>
            <div class="col-md-6 text-end">
                <a href="<?php echo e(route('admin.patient.create')); ?>" class="btn btn-primary">Add User</a>
            </div>
        </div>
        <div class="text-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>                    
                    <th>ID/passport</th>
                    <th>phone</th>
                    <th>age</th>
                <th>Allergies</th>
                <th>Disabilities</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                    <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($patient->name); ?></td>
                        <td><?php echo e($patient->email); ?></td>
                        <td><?php echo e($patient->passport); ?></td>
                        <td><?php echo e($patient->phone); ?></td>
                        <td><?php echo e($patient->age); ?></td>
                        <td><?php echo e($patient->allergies); ?></td>
                        <td><?php echo e($patient->disabilities); ?></td>
                        <!--action buttons-->
                    <td>
                        <a href="<?php echo e(route('admin.patient.edit', $patient->id)); ?>" class="btn btn-sm btn-primary">Edit</a>
                        <form action="<?php echo e(route('admin.patient.destroy', $patient->id)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        </div>
    </div>
   
                        
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('css/crud.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\GEE\Desktop\ambulance-booking-system\resources\views/admin/patient/index.blade.php ENDPATH**/ ?>