<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    //This model groups 1 or N products
    public function products() {
        return $this->hasMany('App\Product');
    }
}
