
@include('admin.top')
<h2>Admin Profile Page</h2>


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

<form action="{{route('admin_profile_submit')}}" method="POST" enctype="multipart/form-data">
  @csrf 
   <table>
      <tr>
        <td>Existing Photo:</td>
        <td>
            @php 
              if(Auth::guard('admin')->user()->photo != ''){
                  $admin_photo = Auth::guard('admin')->user()->photo;
              } else {
                  $admin_photo = 'default.png';
              }
            @endphp
            <img src="{{asset('uploads/'.$admin_photo)}}?v={{ time() }}" alt="" style="width:100px;height:auto;">
        </td>
      </tr>
      <tr>
        <td>Change Photo:</td>
        <td>
            <input type="file" name="photo">
        </td>
      </tr>
      <tr>
        <td>Name:</td>
        <td>
            <input type="text" name="name" value="{{ Auth::guard('admin')->user()->name }}">
        </td>
      </tr>
      <tr>
        <td>Email:</td>
        <td>
            <input type="email" name="email" value="{{ Auth::guard('admin')->user()->email }}">
        </td>
      </tr>
      
      <tr>
        <td>Password:</td>
        <td>
            <input type="password" name="password" placeholder="Password">
        </td>
      </tr>
      <tr>
        <td>Confirm Password:</td>
        <td>
            <input type="password" name="password_confirmation" placeholder="Confirm Password">
        </td>
      </tr>
      <tr>
        <td></td>
        <td>
            <button type="submit">Update</button>
           
        </td>
      </tr>
   </table>
</form>