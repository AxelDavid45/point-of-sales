<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $primaryKey = 'sale_id';

    protected $fillable = [
        'total', 'rfc', 'user_id'
    ];

    // This model can exists in N carts
    public function carts() {
        return $this->belongsToMany('App\Cart');
    }
}
