<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- CSRF Token -->
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <title>{{ config('app.name', 'Laravel') }}</title>
 <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}" defer></script>
 <!-- Fonts -->
 <link rel="dns-prefetch" href="//fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
 <!-- Styles -->
 <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
 <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
</head>
<body class="antialiased font-sans bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white min-h-screen flex flex-col items-center justify-center"  
style=" background-image: url('{{ asset('storage/profile_images/bg.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;">
 <div id="app">
  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
   <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
    <img src="{{ asset('storage/profile_images/new_logo.jpg') }}" width="200" height="" alt="Profile Image">

   
    </a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
   </button>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
   <!-- Left Side Of Navbar -->
   <ul class="navbar-nav mr-auto">
   </ul>
    <!-- Right Side Of Navbar -->
   <ul class="navbar-nav ml-auto">
   <!-- Authentication Links -->
   @guest
   @if (Route::has('login'))
   <li class="nav-item">
    <!-- <a class="nav-link" href="{{ route('login') }}">{{ __('Logins') }}</a> -->
   </li>
   @endif
   @if (Route::has('register'))
   <li class="nav-item">
    <!-- <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }} </a> -->
    
   </li>
   <!-- <li><a class="nav-link" href="{{ url('qrLogin') }}">Qr Login</a></li> -->
   @endif
   @else
    <li class="nav-item dropdown">
     
  
    
     </a>
     <!-- i created a Navigate to change Page for open Scanner login -->
   
      <a class="dropdown-item" href="{{ route('logout') }}"
       onclick="event.preventDefault();
       document.getElementById('logout-form').submit();">
       {{ __('Homes') }}
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
       @csrf
      </form>
     </div>
     </li>
     @endguest
     </ul>
    </div>
   </div>
 </nav>
 <main class="py-4">
 @yield('content')
 </main>
 </div>
</body>
</html>