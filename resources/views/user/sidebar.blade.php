                        <div class="text-center mb-4">
                            <div class="profile-photo">
                                 @php 
                                    if(Auth::guard('web')->user()->photo != ''){
                                        $user_photo = Auth::guard('web')->user()->photo;
                                    } else {
                                        $user_photo = 'default.png';
                                     }
                                @endphp
                                                
                                <img src="{{asset('uploads/'.$user_photo)}}?v={{ time() }}" alt="" >
                            </div>
                            
                            <h5 class="mb-1">{{Auth::guard('web')->user()->name}}</h5>
                            <small class="text-muted">{{Auth::guard('web')->user()->email}}</small>
                        </div>
                        
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                <a href="{{route('user_dashboard')}}" class="text-decoration-none text-dark {{Request::is('user/dashboard') ? 'fw-bold' : '' }}">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                </a>
                            </li>
                            <li class="list-group-item px-0">
                                <a href="{{route('user_orders')}}" class="text-decoration-none text-dark {{Request::is('user/orders') ? 'fw-bold' : '' }}">
                                    <i class="bi bi-bag-check me-2"></i>My Orders
                                </a>
                            </li>
                            <li class="list-group-item px-0">
                                <a href="{{route('user_wishlist')}}" class="text-decoration-none text-dark {{Request::is('user/wishlist') ? 'fw-bold' : '' }}">
                                    <i class="bi bi-heart me-2"></i>Wishlist
                                </a>
                            </li>
                            <li class="list-group-item px-0">
                                <a href="{{route('user_profile')}}" class="text-decoration-none text-dark {{Request::is('user/profile') ? 'fw-bold' : '' }}">
                                    <i class="bi bi-person me-2"></i>Profile Settings
                                </a>
                            </li>
                            <li class="list-group-item px-0">
                                <a href="{{route('user_logout')}}" class="text-decoration-none text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a>
                            </li>
                        </ul>