<a href="{{ route('home') }}">Home</a> -

@if (!auth()->user())
    <a href="{{ route('login') }}">Login</a> -
    <a href="{{ route('registration') }}">Registration</a>
@endif

@if (auth()->user())
    {{--
        <a href="{{ route() }}">Dashboard</a> - 
        Too few arguments to function route(), 0 passed in E:\authentication\storage\framework\views\c8ecc77b62bca96617774320e7c28f8d94b9d90f.php on line 9 and at least 1 expected 
    --}}
    @if (auth()->user()->role==1)
        <a href="{{ route('dashboard_admin') }}">Dashboard</a> -
        <a href="{{ route('settings') }}">Settings</a> -       
    @elseif (auth()->user()->role==2)
        <a href="{{ route('dashboard_user') }}">Dashboard</a> -
    @endif
  
    <a href="{{ route('logout') }}">Logout</a><br>
@endif
