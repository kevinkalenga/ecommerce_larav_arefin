<a href="{{route('home')}}">Home</a> | <a href="{{route('about')}}">About</a> | 
<a href="{{route('login')}}">Login</a> | <a href="{{route('registration')}}">Register</a> 

<h2>Login Page</h2>


@if($errors->any()) 

   @foreach($errors->all() as $error) 
      {{ $error }}
   @endforeach

@endif

@if(session('success')) 
    {{ session('success') }}
@endif

@if(session('error')) 
    {{ session('error') }}
@endif

<form action="{{route('login_submit')}}" method="POST">
  @csrf 
   <table>
      
      <tr>
        <td>Email:</td>
        <td>
            <input type="email" name="email" placeholder="Email">
        </td>
      </tr>
      <tr>
        <td>Password:</td>
        <td>
            <input type="password" name="password" placeholder="Password">
        </td>
      </tr>
      
      <tr>
        <td></td>
        <td>
            
            <div>
                <button type="submit">Login</button>
                <a href="{{route('forget_password')}}">Forget Password</a>
            </div>
              <div>
                <a href="{{route('registration')}}">New User? Make Registration</a>
            </div>
           
        </td>
      </tr>
   </table>
</form>