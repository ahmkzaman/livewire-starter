<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" placeholder="Name" name="name" value="{{old('name')}}" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="text" placeholder="Email" name="email" value="{{old('email')}}" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" placeholder="Password" name="password" required>
            <input type="password" placeholder="Confirm Password" name="password_confirmation" required>
        </div>
        <div>
            <input type="hidden" name="is_admin" value="0">
                <input type="checkbox" name="is_admin" value="1">
                Is Admin
           
        </div>
        
        <button type="submit">Register</button>

    </form>
    <div>
        <a href="{{ route('login') }}">Login</a>
    </div>
    @if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>