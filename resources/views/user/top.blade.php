<a href="{{route('home')}}">Home</a> | 
<a href="{{route('about')}}">About</a> | 
@if(Auth::guard('web')->check())
  <a href="{{route('user_dashboard')}}">Dashboard</a> | 
  <a href="{{route('user_profile')}}">Profile</a>
  <a href="{{route('user_logout')}}">Logout</a>
@else
  <a href="{{route('user_login')}}">Login</a> | 
  <a href="{{route('user_registration')}}">Register</a> 
@endif