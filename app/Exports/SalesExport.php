<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use App\{Sale, Cart};
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    public function headings(): array
    {
        //Add the first row with the headers
        return [
            '# VENTA',
            'CLIENTE',
            'TOTAL',
            'FECHA',

        ];
    }

    // Retrieve the data and passes them to map method
    public function collection()
    {
        //Retrive the last sale of the day
        $lastSale = Sale::latest()->first();
        // Retrieve the information with the cart relation inside
        return Sale::with('carts')->where('created', $lastSale->created)
            ->get();
    }

    //Map the data inside the file
    public function map($sale): array
    {
        //Create the primary rows with the sale information
        $rows = [
            [
                $sale->sale_id,
                $sale->rfc,
                $sale->total,
                $sale->created
            ],
            [
                'DESGLOSE'
            ],
            [
                'PRODUCTO',
                'PRECIO',
                'CANTIDAD'
            ]
        ];

        // Go through the carts and retrieve the product information
        foreach ($sale->carts as $cart) {
            foreach ($cart->products as $product) {
                $rows[] = [
                    $product->name,
                    $product->price,
                    $cart->amount
                ];
            }
        }

        // Add a blank space
        $rows[] = [
            '',
            '',
            '',
            ''
        ];

        //Add new headers
        $rows[] = [
            '# VENTA',
            'CLIENTE',
            'TOTAL',
            'FECHA',
        ];

        //Return the data
        return $rows;
    }
}
