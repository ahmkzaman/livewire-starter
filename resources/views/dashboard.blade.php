@if (session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
    
@endif
<h1>Dashboard - Logged in as {{auth()->user()->name}}</h1>
@if (auth()->user()->is_admin)
    <h2>Admin Dashboard</h2>
    <p>Welcome, Admin!  <a href="{{route('test')}}">visit test</a> </p>
    
@endif

<form method="POST" action="{{route('logout')}}">
@csrf 
<button type="submit">Logout
    </button> 
</form>