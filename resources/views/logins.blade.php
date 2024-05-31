<!DOCTYPE html>
<html lang="en">
<head>
     <!-- Fonts -->
     <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles for error messages */
        .error-message {
            color: red;
        }
    </style>
</head>
<body class="antialiased font-sans bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen flex flex-col items-center justify-center"  
style=" background-image: url('{{ asset('storage/profile_images/bg.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;">
            <header class="w-full py-4 bg-gray-200 dark:bg-gray-800 text-center text-gray-600 dark:text-gray-400" style=" position: fixed;
  top: 0; position: fixed; background-color: white"
 >
        <div class="container mx-auto flex justify-between items-center"  >
            <div class="logo">
                <img src="{{ asset('storage/profile_images/new_logo.jpg') }}" width="200" alt="Logo" class="h-10">
            </div>
            <nav class="flex space-x-4" >
              

                <a href="{{ url('logins') }}" class="text-gray-600 dark:text-gray-400">Login</a>
                
            </nav>
        </div>
    </header>


<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Login</div>
                <p></p>
                <div class="card-body">
                    <form method="POST" action="{{ route('logins') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">Email </label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <a href="{{ route('register') }}" >Sign Up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional, only required if you need JavaScript features) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
