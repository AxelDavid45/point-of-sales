<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Row;
use App\{Sale, Cart};
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesExport implements FromCollection, WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            [
            '# VENTA',
            'CLIENTE',
            'TOTAL',
            'FECHA',
            ]
        ];
    }

    /*
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $lastSale = Sale::latest()->first();

        return Sale::with('carts')->where('created', $lastSale->created)
            ->get();
    }

    public function map($sale): array
    {

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

        foreach ($sale->carts as $cart) {
            foreach ($cart->products as $product) {
                $rows[] = [
                    $product->name,
                    $product->price,
                    $cart->amount
                ];
            }
        }

        $rows[] = [
            '',
            '',
            '',
            ''
        ];

        $rows[] = [
            '# VENTA',
            'CLIENTE',
            'TOTAL',
            'FECHA',
        ];

        return $rows;
    }
}
