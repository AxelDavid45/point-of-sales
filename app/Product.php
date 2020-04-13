<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'product_left', 'price', 'cost', 'category_id'
    ];

    // This model can exists in N carts
    public function carts() {
        return $this->belongsToMany('App\Cart');
    }
}
