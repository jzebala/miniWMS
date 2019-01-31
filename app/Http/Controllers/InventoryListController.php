<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use App\Location;

class InventoryListController extends Controller
{
    /**
     * Inventory List to PDF
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $locations = Location::get();

        $results = array();

        foreach ($locations as $location)
        {
            if ($location->productsCount() == 0)
            {
                array_push($results, [
                    'location' => $location->name,
                    'ean_code' => null,
                    'product' => null,
                    'quantity' => null
                ]);
            }
            else
            {
                foreach($location->products as $product)
                {
                    array_push($results, [
                        'location' => $location->name,
                        'product' => $product->name,
                        'ean_code' => $product->ean_code,
                        'quantity' => $product->getQuantityLocation($location->id)
                    ]);
                }
            }
        }

        // Prepare view
        $pdf = PDF::loadView('pdf.inventoryList_pdf', compact('results'));

        // Return PDF
        return $pdf->stream();
    }
}
