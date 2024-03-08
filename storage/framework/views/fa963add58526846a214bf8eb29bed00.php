<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/nav.css')); ?>">
</head>

<body x-data="{ isCollapsedMenuOpen: false, isProfileMenuOpen: false, notificationsCount: 0 }" x-init="fetchNotificationsCount()">
    <nav class="navbar">
        <div class="collapsed-content">
            <button @click="isCollapsedMenuOpen = !isCollapsedMenuOpen" class="menu-button">
                <span class="material-icons-outlined">menu</span>
            </button>
            <ul class="collapsed-menu" x-show="isCollapsedMenuOpen" @click.away="isCollapsedMenuOpen = false">
                <!-- Dashboard -->
                <li class="sub-item">
                        <?php if(Auth::user()->role == 'patient'): ?>
                    <span class="material-icons-outlined">dashboard</span>                    
                    <a href="<?php echo e(route('ambulance.booking.form')); ?>">Book Ambulance</a>
                    <?php endif; ?>
                </li>
                 <!-- messages -->
            <li class="sub-item">
                <span class="material-icons-outlined">message</span>
                <a href="http://127.0.0.1:8000/chatify">Message</a>
            </li>
            </ul>
        </div>
        <ul class="right-icons">
            <!-- Notifications -->
            <li>
                <span class="material-icons-outlined" @click="handleNotificationClick()">notifications</span>
                <span class="notification-count" x-show="notificationsCount > 0">{{ notificationsCount }}</span>
            </li>
            <!-- Profile Dropdown -->
            <li>
                <img src="<?php echo e(Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/avatar.jpg')); ?>" class="profile" @click="isProfileMenuOpen = !isProfileMenuOpen" />
                <ul x-show="isProfileMenuOpen" @click.away="isProfileMenuOpen = false">
                    <!-- Update Profile -->
                    <li class="sub-item">
                        <span class="material-icons-outlined">manage_accounts</span>
                        <a href="<?php echo e(route('users.update', ['user' => Auth::id()])); ?>">Update Profile</a>
                    </li>
                    <!--settings-->                        
                    <li>
                        <span class="material-icons-outlined">manage_accounts</span>
                        <a href="<?php echo e(route('settings.index')); ?>">Settings</a>
                    </li>
                    <!-- Logout -->
                    <li class="sub-item">
                        <span class="material-icons-outlined">logout</span>
                        <button @click="confirmLogout()">Logout</button>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

  <!-- Your HTML code -->

   <script>
        function fetchNotificationsCount() {
            fetch('/notifications/count')
                .then(response => response.json())
                .then(data => {
                    this.notificationsCount = data.count;
                })
                .catch(error => console.error('Error fetching notifications count:', error));
        }

        function handleNotificationClick() {
            $.ajax({
                url: '<?php echo e(route("notifications.index")); ?>',
                method: 'GET',
                success: function(response) {
                    // Build HTML for displaying notifications
                    var notificationsHTML = '<ul>';
                    response.notifications.forEach(function(notification) {
                        notificationsHTML += `
                            <li>
                                ${notification.message}
                                <button data-notification-id="${notification.id}">Mark as Read</button>
                            </li>`;
                    });
                    notificationsHTML += '</ul>';

                    // Display notifications using SweetAlert
                    Swal.fire({
                        title: 'Notifications',
                        html: notificationsHTML,
                        showCloseButton: true,
                        icon: 'info',
                        confirmButtonText: 'Close'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            markNotificationsAsRead(); // Mark all shown notifications as read
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching notifications:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to fetch notifications. Please try again later.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }

        function markNotificationsAsRead() {
            // Extract notification IDs from buttons within the displayed popup
            const notificationButtons = document.querySelectorAll('button[data-notification-id]');
            const notificationIds = [];
            notificationButtons.forEach(button => {
                notificationIds.push(button.dataset.notificationId);
            });

            if (notificationIds.length === 0) {
                // No notifications displayed, show a message and avoid unnecessary request
                Swal.fire({
                    title: 'Information',
                    text: 'No notifications to mark as read.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
                return;
            }

            // Make an AJAX request to mark notifications as read
            $.ajax({
                url: '<?php echo e(route("notifications.markMultipleAsRead")); ?>',
                method: 'POST',
                data: { ids: notificationIds },
                success: function(response) {
                    console.log('Notifications marked as read:', response.message);
                    Swal.fire({
                        title: 'Success',
                        text: 'Notifications marked as read successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Reload the page to reflect the changes
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error marking notifications as read:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to mark notifications as read. Please try again later.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }


    function confirmLogout() {
        Swal.fire({
            title: 'Logout Confirmation',
            text: 'Are you sure you want to log out?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Logout'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo e(route('logout.perform')); ?>";
            }
        });
    }

    // Initialize fetchNotificationsCount on page load
    fetchNotificationsCount();
</script>
    <!-- Include Alpine.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2"></script>
</body>
</html><?php /**PATH C:\Users\GEE\Desktop\ambulance-booking-system\resources\views/navbar.blade.php ENDPATH**/ ?>