



<div class="container">
    <!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




</body>
</html>

        <h1>User Details</h1>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User ID: {{ $user->id }}</h5>
                <p class="card-text">First Name: {{ $user->name }}</p>
          
                <p class="card-text">Job Title: {{ $user->jobTitle }}</p>
                <p class="card-text">Campus: {{ $user->campus }}</p>
                <p class="card-text">Created At: {{ $user->created_at }}</p>
                <p class="card-text">Updated At: {{ $user->updated_at }}</p>
               
            </div>
        </div>
    </div>

