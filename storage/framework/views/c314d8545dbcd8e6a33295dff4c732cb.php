<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Ambulance Booking system</title>
    <!-- Include any CSS or meta tags common to all pages -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>

</head>
<body>
        <!-- Main content -->
        <div class="main-content">
    <?php echo $__env->yieldContent('content'); ?>
    <!-- Include any common scripts or footer content -->
    <script src="/dist/assets/js/app.js"></script>
  
    
</body>
</html>
<?php /**PATH C:\Users\GEE\Desktop\ambulance-booking-system\resources\views/layouts/app.blade.php ENDPATH**/ ?>