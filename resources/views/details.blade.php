<!-- resources/views/user/details.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
</head>
<body>
    <h1>User Details</h1>

    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <form action="{{ route('details.submit') }}" method="POST">

        @csrf
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" id="user_id">
        <button type="submit">Submit</button>
    </form>

    @if (isset($user))
        <div>
            <p>Name: {{ $user->name }}</p>
            
            <p>Email: {{ $user->email }}</p>
         
            <!-- Add more fields as needed -->
        </div>
    @endif
</body>
</html>
