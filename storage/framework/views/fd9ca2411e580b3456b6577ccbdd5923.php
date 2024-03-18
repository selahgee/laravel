<div class="favorite-list-item">
    <?php if($user): ?>
        <div data-id="<?php echo e($user->id); ?>" data-action="0" class="avatar av-m"
            style="background-image: url('<?php echo e(Chatify::getUserWithAvatar($user)->avatar); ?>');">
        </div>
        <p><?php echo e(strlen($user->name) > 5 ? substr($user->name,0,6).'..' : $user->name); ?></p>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\GEE\Desktop\ambulance-booking-system\resources\views/vendor/Chatify/layouts/favorite.blade.php ENDPATH**/ ?>