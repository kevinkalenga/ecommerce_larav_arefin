<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public function products()
    {
        // chaque categorie peut avoir plusieur produits
        return $this->hasMany(Product::class);
    }
}
