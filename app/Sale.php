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
        'total', 'rfc', 'id', 'created_at'
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

    public function getSalesInAYear()
    {
        return DB::table('sales')->select(DB::raw('Month(created_at) as Month, sum(total) as total'))->groupByRaw(DB::raw('month(created_at)'))->orderByRaw(DB::raw('month(created_at)'))->get();
    }

    public function getSalesByDay(int $month)
    {
        return DB::table('sales')->select(DB::raw('sum(total) as total, day(created_at) as day'))
        ->whereRaw("month(created_at) = $month")
        ->groupByRaw(DB::raw('day(created_at)'))
        ->orderByRaw(DB::raw('day(created_at) ASC'))
        ->get();
    }
}
