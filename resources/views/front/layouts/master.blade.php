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
    
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="{{asset('dist-front/css/bootstrap.min.css')}}">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('dist-front/css/spacing.css')}}">
    <link rel="stylesheet" href="{{asset('dist-front/css/style.css')}}">
</head>
<body>
    
    <!-- Top Bar -->
    <div class="top-bar bg-success text-white py-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span><i class="bi bi-telephone"></i> +1 234 567 8900</span>
                    <span class="ms-3"><i class="bi bi-envelope"></i> support@freshmart.com</span>
                </div>
                <div class="col-md-6 text-end">
                    <span class="ms-3"><i class="bi bi-box-arrow-in-right"></i> <a href="login.html" class="text-white text-decoration-none">Login</a></span>
                    <span class="ms-3"><i class="bi bi-person"></i> <a href="registration.html" class="text-white text-decoration-none">Register</a></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="{{route('home')}}">
                <img src="{{asset('dist-front/images/logo.png')}}" alt="FreshMart" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="products.html">Fresh Fruits</a></li>
                            <li><a class="dropdown-item" href="products.html">Fresh Vegetables</a></li>
                            <li><a class="dropdown-item" href="products.html">Seafood & Meat</a></li>
                            <li><a class="dropdown-item" href="products.html">Grains & Pulses</a></li>
                            <li><a class="dropdown-item" href="products.html">Condiments & Beverages</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.html">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.html">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog.html">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <div class="input-group me-3 navbar-search">
                        <input type="text" class="form-control" placeholder="Search products...">
                        <button class="btn btn-success" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                    <a href="customer-wishlist.html" class="btn btn-outline-success position-relative me-2">
                        <i class="bi bi-heart"></i>
                    </a>
                    <a href="cart.html" class="btn btn-success position-relative">
                        <i class="bi bi-cart3"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            5
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

     @yield('page_main_content')

<!-- Newsletter Section -->
    <section class="newsletter py-5 bg-success text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h3 class="fw-bold mb-2">Subscribe to Our Newsletter</h3>
                    <p class="mb-0">Get the latest updates on new products and upcoming sales</p>
                </div>
                <div class="col-lg-6">
                    <div class="input-group">
                        <input type="email" class="form-control form-control-lg" placeholder="Enter your email address">
                        <button class="btn btn-primary btn-lg px-4" type="button">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <h5 class="fw-bold mb-3"><i class="bi bi-cart-check-fill"></i> FreshMart</h5>
                    <p class="text-white-50">Your one-stop shop for fresh and organic groceries delivered right to your doorstep.</p>
                    <div class="social-links">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle me-2">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="fw-bold mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{route('about')}}" class="text-white-50 text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="contact.html" class="text-white-50 text-decoration-none">Contact Us</a></li>
                        <li class="mb-2"><a href="privacy.html" class="text-white-50 text-decoration-none">Privacy Policy</a></li>
                        <li class="mb-2"><a href="terms.html" class="text-white-50 text-decoration-none">Terms & Conditions</a></li>
                        <li class="mb-2"><a href="faq.html" class="text-white-50 text-decoration-none">FAQs</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="fw-bold mb-3">Categories</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="products.html" class="text-white-50 text-decoration-none">Fresh Fruits</a></li>
                        <li class="mb-2"><a href="products.html" class="text-white-50 text-decoration-none">Fresh Vegetables</a></li>
                        <li class="mb-2"><a href="products.html" class="text-white-50 text-decoration-none">Seafood & Meat</a></li>
                        <li class="mb-2"><a href="products.html" class="text-white-50 text-decoration-none">Grains & Pulses</a></li>
                        <li class="mb-2"><a href="products.html" class="text-white-50 text-decoration-none">Condiments & Beverages</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="fw-bold mb-3">Contact Info</h5>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-2">
                            <i class="bi bi-geo-alt me-2"></i>
                            123 Market Street, City, State 12345
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-telephone me-2"></i>
                            +1 234 567 8900
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-envelope me-2"></i>
                            support@freshmart.com
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-clock me-2"></i>
                            Mon - Sat: 8:00 AM - 10:00 PM
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-white">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p class="text-white-50 mb-0">&copy; 2025 FreshMart. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{asset('dist-front/js/jquery.min.js')}}"></script>
    
    <!-- Bootstrap Bundle JS -->
    <script src="{{asset('dist-front/js/bootstrap.bundle.min.js')}}"></script>
    
    <!-- Custom JS -->
    <script src="{{asset('dist-front/js/script.js')}}"></script>
    
</body>
</html>