<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function product_category()
    {
        // Chaque produit apartient à une categorie
        return $this->belongsTo(ProductCategory::class);
    }
    
    public function product_variations()
    {
        // each product can have multiple variation
        return $this->hasMany(ProductVariation::class);
    }
}
