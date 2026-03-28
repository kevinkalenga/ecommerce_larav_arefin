  <div class="top-bar bg-success text-white py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span><i class="bi bi-telephone"></i> +1 234 567 8900</span>
                    <span class="ms-3"><i class="bi bi-envelope"></i> support@freshmart.com</span>
                </div>
                <div class="col-md-6 text-end">
                  @if(Auth::guard('web')->check())
                    <span class="ms-3"><i class="bi bi-speedometer2"></i> <a href="{{route('user_dashboard')}}" class="text-white text-decoration-none">Dashboard</a></span>
                    <span class="ms-3"><i class="bi bi-box-arrow-in-right"></i> <a href="{{route('user_logout')}}" class="text-white text-decoration-none">Logout</a></span>
                  @else
                    <span class="ms-3"><i class="bi bi-box-arrow-in-right"></i> <a href="{{route('user_login')}}" class="text-white text-decoration-none">Login</a></span>
                    <span class="ms-3"><i class="bi bi-person"></i> <a href="{{route('user_registration')}}" class="text-white text-decoration-none">Register</a></span>
                  @endif
                </div>
            </div>
        </div>
    </div>