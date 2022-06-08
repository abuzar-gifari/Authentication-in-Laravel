<a href="{{ route('home') }}">Home</a> -

@if (!auth()->user())
   <a href="{{ route('login') }}">Login</a> -
    <a href="{{ route('registration') }}">Registration</a>
@endif

@if (auth()->user())
 <a href="{{ route('dashboard') }}">Dashboard</a> -   
 <a href="{{ route('logout') }}">Logout</a><br>
@endif
