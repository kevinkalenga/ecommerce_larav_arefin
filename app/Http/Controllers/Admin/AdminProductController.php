<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;


class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('admin.product.index', compact('products'));
    }
    public function create()
    {
         $product_categories = ProductCategory::orderBy('name', 'asc')->get();
        return view('admin.product.create', compact('product_categories'));
    }

     
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|regex:/^[a-z0-9-]+$/|unique:products,slug',
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'short_description' => 'required',
            'description' => 'required',
          
        ]);

        // Enregistrement
        $product = new Product();

        //Gestion de la photo
        if ($request->hasFile('photo')) {
            $final_name = 'product_' . time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/product_img/'), $final_name);
            $product->photo = $final_name;

        } 

       
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->product_category_id = $request->product_category_id;
       
        $product->save();


      
        return redirect()->route('admin_product_index')->with('success',  'Product is Created Successfully');
    }

    
        
    
    public function edit($id)
    {
        $product_categories = ProductCategory::orderBy('name', 'asc')->get();
        $product = Product::where('id', $id)->first();
        return view('admin.product.edit', compact('product', 'product_categories'));
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'slug' => 'required|regex:/^[a-z0-9-]+$/|unique:products,slug,'.$id,
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'short_description' => 'required',
            'description' => 'required',
          
        ]);
        
        // Upload photo
        if($request->hasFile('photo')) 
        {
            // Supprimer ancienne photo (sécurisé)
             if ($product->photo && file_exists(public_path('uploads/product_img/' . $product->photo))) {
                 unlink(public_path('uploads/product_img/' . $product->photo));
             }

             $filename = 'product_' . time() . '_' . uniqid() . '.' . $request->photo->extension();
             $request->photo->move(public_path('uploads/product_img/'), $filename);
             
             $product->photo = $filename;
        }
        
       
        
          // Update infos
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->product_category_id = $request->product_category_id;
        $product->save();

        return redirect()->route('admin_product_index')->with('success', 'Product is Updated Successfully');
    }

    public function delete($id)
    {
       $product = Product::findOrFail($id);

       // Supprimer la photo si elle existe et n'est pas par défaut
       if ($product->photo && file_exists(public_path('uploads/product_img/' . $product->photo))) {
           unlink(public_path('uploads/product_img/' . $product->photo));
       }

       // Supprimer l'utilisateur
       $product->delete();

       return redirect()->route('admin_product_index')->with('success', 'Product deleted successfully');
    }

}
