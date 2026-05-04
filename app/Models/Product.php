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
}
