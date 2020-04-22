<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Client;
use App\Http\Requests\SaleRequest;
use App\Product;
use App\Sale;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\all;

class SaleController extends Controller
{
    /*
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::latest()->paginate();
        return view('sales.index', compact('sales'));
    }

    /*
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::orderBy('rfc', 'DESC')->get();
        $products = Product::orderBy('name', 'DESC')->get();
        return view('sales.create', compact('clients', 'products'));
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(SaleRequest $request)
    {
        $sale = Sale::create(
            [
                'total' => $request->input('total'),
                'rfc'   => $request->input('rfc'),
                'id'    => $request->input('id')
            ]
        );
        if (isset($sale)) {
            $productsArray = (array) json_decode($request->input('products'));
            $completed = [];

            foreach ($productsArray as $index) {
                $cart = new Cart();
                $cart->sale_id = $sale->sale_id;
                $cart->product_id = $index->id;
                $cart->amount = $index->amount;
                $cart->save();
                $completed[] = $cart;
            }

            if (count($productsArray) === count($completed)) {
                return new Response('Sale Created', 201);
            }
        }
        return new Response('Cart was not filled', 500);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Sale $sale
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Sale $sale
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Sale                $sale
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Sale $sale
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
