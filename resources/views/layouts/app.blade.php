<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ambulance Booking system</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Include any CSS or meta tags common to all pages -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    @vite('resources/css/app.css')
    @stack('styles')

</head>
<body>
        <!-- Main content -->
        <div class="main-content">
              @include('navbar')
                      
    @yield('content')
    <!-- Include any common scripts or footer content -->
    <script src="{{ asset('js/app.js') }}"></script>
    

  
    
</body>
</html>
