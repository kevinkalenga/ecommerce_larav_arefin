<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshMart - Your Online Grocery Store</title>
    <link rel="icon" type="image/png" href="{{asset('dist-front/images/favicon.png')}}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   
    
    <!-- Custom CSS -->
     @include('front.layouts.styles')
  
</head>
<body>
    
    <!-- Top Bar -->
    @include('front.layouts.top_bar')

    <!-- Navigation -->
      @include('front.layouts.nav')

     @yield('page_main_content')

   <!-- Newsletter Section -->
    @include('front.layouts.newsletter')

    <!-- Footer -->
     @include('front.layouts.footer')

    <!-- jQuery -->
    @include('front.layouts.scripts')

    @yield('scripts')
    
    
</body>
</html>