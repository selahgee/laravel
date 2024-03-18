<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Ambulance Booking system</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <!-- Include any CSS or meta tags common to all pages -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/nav.css')); ?>">
    
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>

</head>
<body>
      
           
      <?php echo $__env->make('navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      
    <?php echo $__env->yieldContent('content'); ?>
    <!-- Include any common scripts or footer content -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script> 

</script>
<!-- Include Alpine.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2"></script>
    
</body>
</html>
<?php /**PATH C:\Users\GEE\Desktop\ambulance-booking-system\resources\views/layouts/app.blade.php ENDPATH**/ ?>