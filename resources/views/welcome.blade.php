<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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

@if (Route::has('login'))
        <div class="fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm underline text-gray-700 dark:text-gray-300">Home</a>
            @else
                <!-- <a href="{{ route('login') }}" class="text-sm underline text-gray-700 dark:text-gray-300">Log in</a> -->
                @if (Route::has('register'))
                    <!-- <a href="{{ route('register') }}" class="ml-4 text-sm underline text-gray-700 dark:text-gray-300">Register</a> -->
                    <!-- <a href="{{ url('logins') }}" class="ml-4 text-sm underline text-gray-700 dark:text-gray-300">Login</a> -->
                @endif
            @endauth
        </div>
    @endif
<h1 style="color:white;font-size: 40px;" class="fs-1">PSU E-validator System</h1>
<p style="color:white;">An innovative system for validation of employees, streamlining operations and enhancing security.</p>
<br>
<br>
    <div class="w-full max-w-md p-8 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        @if (session('error'))
            <div class="mb-4 text-red-500">{{ session('error') }}</div>
        @endif

        <form action="{{ route('welcome.submit') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="user_id" class="block text-sm font-medium">ID number:</label>
                <input type="text" name="user_id" id="user_id" class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm">
            </div>
            <button type="submit" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700">Submit</button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ url('qrLogin') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Qr Login</a>
        </div>

        @if (isset($user))
            <div class="mt-8 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                <div class="mb-4">
                    <img src="{{ Storage::url($user->profile_image) }}" alt="Profile Image" class="w-32 h-32 rounded-full mx-auto object-cover shadow-lg">
                </div>
                <div class="text-center space-y-2">
                    <p class="text-lg font-semibold">{{ $user->name }}</p>
                    <p class="text-sm">{{ $user->jobTitle }}</p>
                    <p class="text-sm">{{ $user->campus }}</p>
                    <p class="text-sm">{{ $user->department }}</p>
                 
                </div>
            </div>
        @endif
    </div>

    
    
    <footer class="w-full py-4 bg-gray-200 dark:bg-gray-800 text-center text-gray-600 dark:text-gray-400 mt-8" style=" position: fixed;
  bottom: 0; position: fixed;
  bottom: 0;">
        <p>&copy;{{ date('Y') }} PSU Urdaneta - IT Department. All Rights Reserved</p>
    </footer>
</body>
</html>