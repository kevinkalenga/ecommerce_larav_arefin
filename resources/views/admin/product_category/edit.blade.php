

@extends('admin.layouts.master')

@section('main_content')
   <div class="navbar-bg"></div>
         @include('admin.layouts.nav')


         @include('admin.layouts.sidebar')
        <div class="main-content">
            <section class="section">
                <div class="section-header d-flex justify-content-between align-items-center">
                    <h1>Edit Product Category</h1>
                    <div class="ml-auto">
                        <a href="{{route('admin_product_category_index')}}" class="btn btn-primary"><i class="fas fa-eye"></i> All Categories</a>
                    </div>
                </div>
               
                <div class="section-body">
                    <div class="row">
                        <div class="co-lg-12">
                            <div class="card">
                                <div class="card-body">
                                  <form action="{{route('admin_product_category_update', $product_category->id)}}" method="post" >
                                      @csrf
                                            <div class="row">
                                                
                                           
                                                <div class="col-lg-6 mb-3">
                                                    <label for="">Name *</label>
                                                    <input type="text" class="form-control" name="name" value="{{$product_category->name}}">
                                                </div>
                                             
                                                
                                                
                                                <div class="mb-3">
                                                    <label class="form-label"></label>
                                                    <button type="submit" class="btn btn-primary">Update</button>
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







