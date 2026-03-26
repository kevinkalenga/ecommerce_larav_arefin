@include('admin.top')
<h2>Admin Dashboard</h2>

<p>
    Welcome {{Auth::guard('admin')->user()->name}} to your dashboard.
</p>

