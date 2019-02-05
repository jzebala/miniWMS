<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products = Product::all();

        $productsArray = array();

        $loopIndxe = 0;

        foreach($products as $product)
        {
            $loopIndxe++;
            array_push($productsArray, [
                $loopIndxe,
                $product->name,
                $product->ean_code,
                $product->stockLevel->quantity,
                $product->created_at,
            ]);
        }
        return collect($productsArray);
    }

    public function headings(): array
    {
        return [
            'Lp.',
            'Nazwa',
            'EAN',
            'Stan',
            'Utworzono'
        ];
    }
}
