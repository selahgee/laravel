<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambulance Booking System</title>  
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  
</head>
<body>
  

    @section('content')
        <div class="container">
            <h1>Register</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                </div>        

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <div class="form-group row">
                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                    <div class="col-md-6">
                        <select id="role" class="form-control" name="role" required>
                            <option value="patient">Patient</option>
                            <option value="driver">Driver</option>
                            
                        </select>
                    </div>
                </div>

                <button type="submit" onclick="showSweetAlert()">Register</button>
            </form>
            <a href="/" class="signup-link">Already have an account? Login here.</a>
        </div>

        <script>
            function showSweetAlert() {
                Swal.fire({
                    title: 'Registration Successful!',
                    text: 'Kindly verify your email before logging in.',
                    icon: 'success',
                    confirmButtonText: 'OK',
                });
            }
        </script>
  
  
</body>
</html>
