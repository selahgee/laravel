{{-- <!DOCTYPE html>
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
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
</head> --}}

<body x-data="{ isCollapsedMenuOpen: false, isProfileMenuOpen: false, notificationsCount: 0 }" x-init="fetchNotificationsCount()">
    <nav class="navbar">
        <div class="collapsed-content">
            <button @click="isCollapsedMenuOpen = !isCollapsedMenuOpen" class="menu-button">
                <span class="material-icons-outlined">menu</span>
            </button>
            <ul class="collapsed-menu" x-show="isCollapsedMenuOpen" @click.away="isCollapsedMenuOpen = false">
                <!-- Sidebar -->
                <li>
                        <div class="flex-col w-full md:flex md:flex-row md:min-h-screen">
                            <div @click.away="open = false" class="flex flex-col flex-shrink-0 w-full text-gray-700 bg-white md:w-64 dark:text-gray-200 dark:bg-gray-800" x-data="{ open: false }">
                                <div class="flex flex-row items-center justify-between flex-shrink-0 px-8 py-4">
                                    <h2>Welcome {{ auth()->user()->name }}!</h2>
                                    <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                                            <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                            <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                                <nav :class="{'block': open, 'hidden': !open}" class="flex-grow px-4 pb-4 md:block md:pb-0 md:overflow-y-auto"> 
                                        @if(Auth::user()->role == 'admin')                             
                                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-gray-200 rounded-lg dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('admin.dashboard1') }}">Dashboard</a>
                                    @endif
                                    @if(Auth::user()->role == 'patient')
                                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"href="{{ route('ambulance.booking.form') }}">Book Ambulance</a>
                                    @endif
                                    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="http://127.0.0.1:8000/chatify">Messages</a>
                                    @if(Auth::user()->role == 'admin')
                                    <div @click.away="open = false" class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark:bg-transparent dark:focus:text-white dark:hover:text-white dark:focus:bg-gray-600 dark:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                            <span>Manage Users</span>
                                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                                            <div class="px-2 py-2 bg-white rounded-md shadow dark:bg-gray-700">
                                                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('admin.patient.index') }}">Patients</a>                                              
                                                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Drivers</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div @click.away="open = false" class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark:bg-transparent dark:focus:text-white dark:hover:text-white dark:focus:bg-gray-600 dark:hover:bg-gray-600 md:block hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                                            <span>Activity</span>
                                            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg">
                                            <div class="px-2 py-2 bg-white rounded-md shadow dark:bg-gray-700">
                                                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Patient Requests</a>                                              
                                                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Vehicle Status</a>
                                                <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark:bg-transparent dark:hover:bg-gray-600 dark:focus:bg-gray-600 dark:focus:text-white dark:hover:text-white dark:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{ route('admin.dispatch.driver') }}">Dispatch Responders</a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </li>         
                </ul>
        </div>
        <ul class="right-icons">
            <!-- Notifications -->
            <li>
                <span class="material-icons-outlined" @click="handleNotificationClick()">notifications</span>
                <span class="notification-count" x-show="notificationsCount > 0">@{{ notificationsCount }}</span>
            </li>
            <div @click.away="isProfileMenuOpen = false" class="relative" x-data="{ isProfileMenuOpen: false }">
                    <div @click="isProfileMenuOpen = !isProfileMenuOpen" class="flex items-center">
                        <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/avatar.jpg') }}" class="profile rounded-full h-10 w-10 object-cover" />
                    </div>
                    <div x-show="isProfileMenuOpen" class="absolute right-0 mt-2 text-sm w-48 dark:bg-gray-500 rounded-md shadow-lg">
                        <ul>
                            <!-- Update Profile -->
                            <li class="sub-item">
                                <span class="material-icons-outlined">manage_accounts</span>
                                <a href="{{ route('users.update', ['user' => Auth::id()]) }}">Update Profile</a>
                            </li>
                            <!-- Settings -->                        
                            <li>
                                <span class="material-icons-outlined">manage_accounts</span>
                                <a href="{{ route('settings.index') }}">Settings</a>
                            </li>
                            <!-- Logout -->
                            <li class="sub-item">
                                <span class="material-icons-outlined">logout</span>
                                <button @click="confirmLogout()">Logout</button>
                            </li>
                        </ul>
                    </div>
                </div>
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
                url: '{{ route("notifications.index") }}',
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
                url: '{{ route("notifications.markMultipleAsRead") }}',
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
                window.location.href = "{{ route('logout.perform') }}";
            }
        });
    }

    // Initialize fetchNotificationsCount on page load
    fetchNotificationsCount();
// </script>
    <!-- Include Alpine.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2"></script>
</body>
{{-- </html> --}}