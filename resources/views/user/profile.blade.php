
@extends('front.layouts.master')

@section('page_main_content') 
<!-- Breadcrumb -->
<section class="breadcrumb-section py-3 bg-light">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{route('home')}}" class="text-success">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Customer Profile Section -->
<section class="customer-dashboard  customer-profile py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        @include('user.sidebar')
                    </div>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="col-lg-9">
                <h3 class="fw-bold mb-4">Profile Settings</h3>
                 <hr>
                <!-- Personal Information -->
                <div class="card border-0 shadow-sm mb-4">
                    
                    <div class="card-body p-4">
                        <form method="POST" action="{{route('user_profile_submit')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                
                               <div class="col-md-12">
                                    <label class="form-label">Existing Photo</label>
                                    <div>
                                        @php 
                                          if(Auth::guard('web')->user()->photo != ''){
                                              $user_photo = Auth::guard('web')->user()->photo;
                                          } else {
                                              $user_photo = 'default.png';
                                          }
                                        @endphp
                                        <img src="{{asset('uploads/'.$user_photo)}}?v={{ time() }}" alt="" style="width:100px;height:auto;">
                                    </div>
                                </div>
                               <div class="col-md-12">
                                    <label class="form-label">Change Photo</label>
                                    <div>
                                       <input type="file" name="photo">
                                    </div>
                                </div>
                            
                               <div class="col-md-6">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ Auth::guard('web')->user()->name }}" >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ Auth::guard('web')->user()->email }}" >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone <span class="text-danger"></span></label>
                                    <input type="text" class="form-control" name="phone" value="{{ Auth::guard('web')->user()->phone }}" >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Country <span class="text-danger"></span></label>
                                    <input type="text" class="form-control" name="country" value="{{ Auth::guard('web')->user()->country }}" >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Address <span class="text-danger"></span></label>
                                    <input type="text" class="form-control" name="address" value="{{ Auth::guard('web')->user()->address }}" >
                                </div>
                               
                                <div class="col-md-6">
                                    <label class="form-label">State <span class="text-danger"></span></label>
                                    <input type="text" class="form-control" name="state" value="{{ Auth::guard('web')->user()->state }}" >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">City <span class="text-danger"></span></label>
                                    <input type="text" class="form-control" name="city" value="{{ Auth::guard('web')->user()->city }}" >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Zip <span class="text-danger"></span></label>
                                    <input type="text" class="form-control" name="zip" value="{{ Auth::guard('web')->user()->zip }}" >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Password <span class="text-danger"></span></label>
                                    <input type="password" class="form-control" name="password" >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirm Password <span class="text-danger"></span></label>
                                    <input type="password" class="form-control" name="password_confirmation" >
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check-circle me-2"></i>Update Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

              

                
            </div>
        </div>
    </div>
</section>
@endsection




















{{--<form action="{{route('user_profile_submit')}}" method="POST" enctype="multipart/form-data">
  @csrf 
   <table>
      <tr>
        <td>Existing Photo:</td>
        <td>
            @php 
              if(Auth::guard('web')->user()->photo != ''){
                  $user_photo = Auth::guard('web')->user()->photo;
              } else {
                  $user_photo = 'default.png';
              }
            @endphp
            <img src="{{asset('uploads/'.$user_photo)}}?v={{ time() }}" alt="" style="width:100px;height:auto;">
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
            <input type="text" name="name" value="{{ Auth::guard('web')->user()->name }}">
        </td>
      </tr>
      <tr>
        <td>Email:</td>
        <td>
            <input type="email" name="email" value="{{ Auth::guard('web')->user()->email }}">
        </td>
      </tr>
      <tr>
        <td>Phone:</td>
        <td>
            <input type="text" name="phone" value="{{ Auth::guard('web')->user()->phone }}">
        </td>
      </tr>
      <tr>
        <td>Country:</td>
        <td>
            <input type="text" name="country" value="{{ Auth::guard('web')->user()->country }}">
        </td>
      </tr>
      <tr>
        <td>Address:</td>
        <td>
            <input type="text" name="address" value="{{ Auth::guard('web')->user()->address }}">
        </td>
      </tr>
      <tr>
        <td>State:</td>
        <td>
            <input type="text" name="state" value="{{ Auth::guard('web')->user()->state }}">
        </td>
      </tr>
      <tr>
        <td>City:</td>
        <td>
            <input type="text" name="city" value="{{ Auth::guard('web')->user()->city }}">
        </td>
      </tr>
      <tr>
        <td>Zip:</td>
        <td>
            <input type="text" name="zip" value="{{ Auth::guard('web')->user()->zip }}">
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
</form>--}}