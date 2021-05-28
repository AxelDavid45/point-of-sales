<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    protected $table = 'sales';

    protected $primaryKey = 'sale_id';

    public $incrementing = true;

    protected $fillable = [
        'total', 'rfc', 'id', 'created'
    ];



    public function client()
    {
        return $this->belongsTo('App\Client', 'rfc');
    }

    // This model can exists in N carts
    public function carts()
    {
        return $this->belongsToMany(
            'App\Cart',
            'sales',
            'sale_id',
            'sale_id',
            'sale_id',
            'sale_id'
        );
    }

    public function getTotalSold()
    {
        $total = DB::table('sales')->select(DB::raw("SUM('total') as soldToday"))->get();
        return $total;
    }

    public function getTotalSoldPerMonth(int $month)
    {
        return DB::table('sales')->select(DB::raw('sum(total) as total'))->whereRaw("month(created_at) = $month")->value('total');
    }
}
