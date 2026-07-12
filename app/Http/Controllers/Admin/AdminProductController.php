<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariation;
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

        $product->product_category_id = $request->product_category_id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->show_on_home = $request->show_on_home;
      
       
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
        $product->product_category_id = $request->product_category_id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->show_on_home = $request->show_on_home;
        
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

    public function product_variation($id)
    {
        $product = Product::where('id', $id)->first();
        $product_variations = ProductVariation::where('product_id', $id)->get();
        return view('admin.product.variation', compact('product', 'product_variations'));
    }


    public function product_variation_store(Request $request, $id)
    {
        $request->validate([
            'label' => 'required',
            'sale_price' => 'required|numeric',
            'regular_price' => 'nullable|numeric',
            'stock' => 'required|integer',
            'sort_order' => 'integer|nullable',
          
        ]);

        // Enregistrement
        $product_variation = new ProductVariation();

       
        // $product_variation->product_id = $request->$id;
        $product_variation->product_id = $id;
        $product_variation->label = $request->label;
        $product_variation->sale_price = $request->sale_price;
        $product_variation->regular_price = $request->regular_price;
        $product_variation->stock = $request->stock;
        $product_variation->sort_order = $request->sort_order;
       
        $product_variation->save();


      
        return redirect()->back()->with('success',  'Product variation added Successfully');
    }


    public function product_variation_delete($id)
    {
        $product_variation = ProductVariation::orderBy('sort_order', 'asc')->where('id', $id)->first();
        
        if(!$product_variation) {
            return redirect()->back()->with('error', 'Product variation not found');
        }

        $product_variation->delete();

        return redirect()->back()->with('success',  'Product variation deleted Successfully');
       
    }
    
    public function product_variation_update(Request $request, $id)
    {
        $request->validate([
            'label' => 'required',
            'sale_price' => 'required|numeric',
            'regular_price' => 'nullable|numeric',
            'stock' => 'required|integer',
            'sort_order' => 'integer|nullable',
        ]);

        // Récupérer la variation existante
        $product_variation = ProductVariation::findOrFail($id);

        // Mettre à jour les données
        $product_variation->label = $request->label;
        $product_variation->sale_price = $request->sale_price;
        $product_variation->regular_price = $request->regular_price;
        $product_variation->stock = $request->stock;
        $product_variation->sort_order = $request->sort_order;

        $product_variation->save();

        return redirect()->back()->with(
            'success',
            'Product variation updated successfully'
        );
    }


}
