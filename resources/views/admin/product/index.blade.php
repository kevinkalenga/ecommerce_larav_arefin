

@extends('admin.layouts.master')

@section('main_content')
   <div class="navbar-bg"></div>
         @include('admin.layouts.nav')


         @include('admin.layouts.sidebar')
        <div class="main-content">
            <section class="section">
                <div class="section-header d-flex justify-content-between align-items-center">
                    <h1>Products</h1>
                    <div class="ml-auto">
                        <a href="{{route('admin_product_create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create Product</a>
                    </div>
                 
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="co-lg-12">
                            <div class="card">
                                <div class="card-body">
                                   <div class="table-respnsive">
                                      <table class="table table-bordered table-md" id="example1">
                                        <thead>
                                           <tr>
                                              <th>SL</th>
                                              <th>Photo</th>
                                              <th>Name</th>
                                              <th>Slug</th>
                                              <th>Category</th>
                                              <th>Product Variation</th>
                                              <th>Action</th>
                                           </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($products as $product)
                                           <tr>
                                              <td>{{$loop->iteration}}</td>
                                              <td>
                                                <img src="{{asset('uploads/product_img/'.$product->photo)}}?v={{ time() }}" alt="" class="w_100">
                                              </td>
                                              
                                              <td>{{$product->name}}</td>
                                              <td>{{$product->slug}}</td>
                                              <td>{{$product->product_category->name}}</td>
                                              <td>
                                                <a href="{{route('admin_product_variation', $product->id)}}" class="btn btn-info btn-sm">Product Variation</a>
                                              </td>
                                               <td>
                                                 <a href="{{route('admin_product_edit', $product->id)}}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                 <a href="{{route('admin_product_delete', $product->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                               </td>
                                           </tr>


                                          @endforeach
                                         </tbody>
                                      </table>
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
      </div>

@endsection







