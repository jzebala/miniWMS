<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use App\Location;

class InventoryListController extends Controller
{
    public function index()
    {
        $locations = Location::get();
        
        return view('InventoryList.index', compact('locations'));
    }

    private function toPDF($locations) {

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

    public function abc(Request $request)
    {
        $locations_r = array();

        // r_c - Request count
        $r_c = count($request->all());

        // r_c = 2 - two elements _token and all (all checkbox)
        if ($request->has('all') && $r_c == 2 ) {
            $locations = Location::all(); // get all locations
        } else {
            foreach($request->except('_token') as $key => $value) {
                array_push($locations_r, $key);
            }
    
            $locations = Location::whereIn('id', $locations_r)->get();
        }

        return $this->toPDF($locations);
    }

    /**
     * Inventory List to PDF
     *
     * @return \Illuminate\Http\Response
     */
    public function InventoryListPdf()
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
