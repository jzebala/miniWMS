<?php

namespace App\Imports;

use App\Product;
use App\StockLevel;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsImport implements ToCollection
{

    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        foreach ($rows->slice(1) as $row) 
        {
            $product = Product::create([
                'name' => $row[1],
                'ean_code' => $row[2],
            ]);

            
            StockLevel::create([
                'product_id' => $product->id,
                'quantity' =>  $row[3]
            ]);
            
        }
    }
}
