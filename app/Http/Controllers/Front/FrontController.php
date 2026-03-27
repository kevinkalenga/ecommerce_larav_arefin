<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.home');
    }
    
    public function about()
    {
        return view('front.about');
    }
    public function contact()
    {
        return view('front.contact');
    }
    public function faq()
    {
        return view('front.faq');
    }
    public function terms()
    {
        return view('front.terms');
    }
    public function privacy()
    {
        return view('front.privacy');
    }
    public function blog()
    {
        return view('front.blog');
    }
    public function post($slug)
    {
        return view('front.post', compact('slug'));
    }
    public function products()
    {
        return view('front.products');
    }
    public function product($slug)
    {
        return view('front.product', compact('slug'));
    }
    public function cart()
    {
        return view('front.cart');
    }
    public function checkout()
    {
        return view('front.checkout');
    }
}
