<div class="collapsed-content main-menu ">
    <button @click="isCollapsedMenuOpen = !isCollapsedMenuOpen" class="menu-button">
        <span class="material-icons-outlined">menu</span>
    </button>
    <ul class="collapsed-menu" x-show="isCollapsedMenuOpen" @click.away="isCollapsedMenuOpen = false">
        <!-- Dashboard -->
        <li class="sub-item">
                
            <span class="material-icons-outlined">dashboard</span>                    
            <a href="<?php echo e(route('ambulance.booking.form')); ?>">Book Ambulance</a>
            
        </li>
         <!-- messages -->

    <li class="sub-item">
        <span class="material-icons-outlined">message</span>
        <a href="http://127.0.0.1:8000/chatify">Message</a>
    </li>
    <li class="sub-item">
            <span class="material-icons-outlined">message</span>
            <a href="http://127.0.0.1:8000/chatify">Message</a>
        </li>
        <li class="sub-item">
                <span class="material-icons-outlined">message</span>
                <a href="http://127.0.0.1:8000/chatify">Message</a>
            </li>
    </ul>
</div><?php /**PATH C:\Users\GEE\Desktop\ambulance-booking-system\resources\views/layouts/menu_bar.blade.php ENDPATH**/ ?>