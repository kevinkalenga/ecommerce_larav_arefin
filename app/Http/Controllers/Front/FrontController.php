<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;

class FrontController extends Controller
{
    public function index()
    {
        $product_categories_home = ProductCategory::where('show_on_home', 1)->orderBy('name', 'asc')->get();
        $products_home = Product::where('show_on_home', 1)->get();
        return view('front.home', compact('product_categories_home', 'products_home'));
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
        $products = Product::get();
        return view('front.products', compact('products'));
    }
    public function product($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $related_products = Product::where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)->orderBy('id', 'asc')->take(4)->get();
        return view('front.product', compact('product', 'related_products'));
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
