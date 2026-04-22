<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 use App\Models\ProductCategory;

class AdminProductCategoryController extends Controller
{
     public function index()
    {
        $product_categories = ProductCategory::orderBy('name', 'asc')->get();
        return view('admin.product_category.index', compact('product_categories'));
    }
    public function create()
    {
        return view('admin.product_category.create');
    }

     
    public function store(Request $request)
    {
     $request->validate([
        'name' => 'required|unique:product_categories,name',
      ]);

      

        // Enregistrement
        $product_category = new ProductCategory();
        $product_category->name = $request->name;
 
        $product_category->save();



       // (optionnel) afficher ou envoyer le mot de passe
       return redirect()->route('admin_product_category_index')->with('success',  'Product Category is Created Successfully');
    }

  
    
    
    public function edit($id)
    {
        $product_category = ProductCategory::where('id', $id)->first();
        return view('admin.product_category.edit', compact('product_category'));
    }


    public function update(Request $request, $id)
    {
        $product_category = ProductCategory::findOrFail($id);
        
         $request->validate([
            'name' => 'required|unique:product_categories,name',
           
            
        ]);
        
        
          // Update infos
        $product_category->name = $request->name;
        
        $product_category->save();

        return redirect()->route('admin_product_category_index')->with('success', 'Product Category is Updated Successfully');
    }

    public function delete($id)
    {
       $product_category = ProductCategory::findOrFail($id);


       // Supprimer l'utilisateur
       $product_category->delete();

       return redirect()->route('admin_product_category_index')->with('success', 'Product Category deleted successfully');
    }

}
