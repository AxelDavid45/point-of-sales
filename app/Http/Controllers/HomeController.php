<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Sale;

class HomeController extends Controller
{
    private Product $products;
    private Sale $sales;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product, Sale $sales)
    {
        $this->products = new $product();
        $this->sales = new $sales();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $soldThisMoth = $this->sales->getTotalSoldPerMonth(date('n'));
        $totalProducts = $this->products->countProducts();
        return view('home', compact('totalProducts', 'soldThisMoth'));
    }
}
