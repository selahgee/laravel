

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Driver Dashboard</h1>

        <div class="bookings">
            <h2>My Bookings</h2>

            <?php if($bookings->isEmpty()): ?>
                <p>No bookings available.</p>
            <?php else: ?>
                <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="booking">
                        <h3>Booking ID: <?php echo e($booking->id); ?></h3>
                        <p>Status: <?php echo e(ucfirst($booking->status)); ?></p>
                        <p>Pickup Location: <?php echo e($booking->pickup_location); ?></p>
                        <p>Hospital Location: <?php echo e($booking->hospital_location); ?></p>
                        <!-- Add more information here as needed -->
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/driverD.css')); ?>">
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\GEE\Desktop\ambulance-booking-system\resources\views/driver/dashboard/index.blade.php ENDPATH**/ ?>