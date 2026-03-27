

@extends('admin.layouts.master')

@section('main_content')
   <div class="navbar-bg"></div>
         @include('admin.layouts.nav')


         @include('admin.layouts.sidebar')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Edit Profile</h1>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('admin_profile_submit')}}" method="post"  enctype="multipart/form-data">
                                      @csrf
                                        <div class="row">
                                            <div class="col-md-3">
                                                
                                                  @php 
                                                    if(Auth::guard('admin')->user()->photo != ''){
                                                        $admin_photo = Auth::guard('admin')->user()->photo;
                                                    } else {
                                                        $admin_photo = 'default.png';
                                                    }
                                                  @endphp
                                                
                                                <img src="{{asset('uploads/'.$admin_photo)}}?v={{ time() }}" alt="" class="profile-photo w_100_p">
                                                <input type="file" class="mt_10" name="photo">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="mb-4">
                                                    <label class="form-label">Name *</label>
                                                    <input type="text" class="form-control" name="name" value="{{ Auth::guard('admin')->user()->name }}">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">Email *</label>
                                                    <input type="text" class="form-control" name="email" value="{{ Auth::guard('admin')->user()->email }}">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">Confirm Password</label>
                                                    <input type="password" class="form-control" name="password_confirmation">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label"></label>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
      </div>

@endsection







