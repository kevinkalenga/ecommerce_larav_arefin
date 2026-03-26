  <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                </ul>
            </form>
            <ul class="navbar-nav navbar-right justify-content-end rightsidetop">
                <li class="nav-link">
                    <a href="{{route('home')}}" target="_blank" class="btn btn-warning">Front End</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        
                        @php 
                          if(Auth::guard('admin')->user()->photo != ''){
                              $admin_photo = Auth::guard('admin')->user()->photo;
                          } else {
                              $admin_photo = 'default.png';
                          }
                        @endphp
                       <img src="{{asset('uploads/'.$admin_photo)}}?v={{ time() }}" alt=""class="rounded-circle-custom">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{route('admin_profile')}}"><i class="far fa-user"></i> Edit Profile</a></li>
                        <li><a class="dropdown-item" href="{{route('admin_logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
    </nav>