<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
</head>
<body>
    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "{{ route('logout.perform') }}"; // Redirect to perform logout
            } else {
                // User clicked Cancel
                // No action needed, user remains on the same page
            }
        }
    </script>

    <h1>Logout Confirmation</h1>
    <button onclick="confirmLogout()">Logout</button>
</body>
</html>
