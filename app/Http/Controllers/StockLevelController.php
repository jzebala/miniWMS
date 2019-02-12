<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Product;
use App\Location;

use Carbon\Carbon;
use PDF;

class StockLevelController extends Controller
{
    public function discrepancy()
    {
        // Get all products
        $products_all = Product::all();

        $products = $products_all->filter(function ($product)
        {
            return $product->stocklevel->quantity < $product->locations()->sum('quantity');
        });

        // Return view with results
        return view('stockLevel.discrepancy', compact('products'));
    }

    /**
     * Display discrepancy in PDF format.
     *
     * @return \Illuminate\Http\Response
     */
    public function discrepancyPdf()
    {
        // Get all products
        $products_all = Product::all();

        $products = $products_all->filter(function ($product)
        {
            return $product->stocklevel->quantity < $product->locations()->sum('quantity');
        });

        $pdf = PDF::loadView('pdf.discrepancy_pdf', ['products' => $products]);
        $pdf->setPaper('a4', 'landscape');

        // Return PDF
        return $pdf->stream();
    }

    /**
     * Display a list of products that are in stock.
     *
     * @return \Illuminate\Http\Response
     */
    public function expired()
    {
        // Get days from request
        $days_r = \Request::get('days'); // $_GET['days']

        if ($days_r == 'month') {
            $data = DB::table('location_product')->where('created_at', '<=', DB::raw("DATE_SUB(NOW(), INTERVAL 1  MONTH)"))->orderBy('created_at', 'ASC')->get();
        } else {

            $days = isset($days_r) ? (int) $days_r : null;

            // $days = null
            if(!$days)
            {
                // Set default number of days
                $days = 10;
            }

            // SQL Query
            $data = DB::table('location_product')->where('created_at', '<=', DB::raw("DATE_SUB(NOW(), INTERVAL $days  DAY)"))->orderBy('created_at', 'ASC')->get();
        }

        // Array with data, sent to the view
        $results = array();

        foreach($data as $value)
        {
            // Get product by id
            $product = Product::findOrFail($value->product_id);

            // Get location by id
            $location =  Location::findOrFail($value->location_id);

            // Prepare array with data
            array_push($results, [
                'product_id' => $value->product_id,
                
                'name' => $product->name,
                'location' => $location->name,
                'quantity' => $value->quantity,
                'created_at' => Carbon::parse($value->created_at)->format('Y-m-d'),
                'time_created_at' => Carbon::parse($value->created_at)->format('H:i:s'),
                'days' => Carbon::parse($value->created_at)->diffInDays()
            ]);
        }

        // Return view with results
        return view('stockLevel.expired', compact('results'));
    }

    /**
     * Display expired in PDF format.
     *
     * @param  int  $days
     * @return \Illuminate\Http\Response
     */
    public function expiredPdf($days)
    {
        if ($days == 'month') {
            $data = DB::table('location_product')->where('created_at', '<=', DB::raw("DATE_SUB(NOW(), INTERVAL 1  MONTH)"))->orderBy('created_at', 'ASC')->get();
        } else {

            $days = isset($days) ? (int) $days : null;

            // $days = null
            if(!$days)
            {
                // Set default number of days
                $days = 10;
            }

            // SQL Query
            $data = DB::table('location_product')->where('created_at', '<=', DB::raw("DATE_SUB(NOW(), INTERVAL $days  DAY)"))->orderBy('created_at', 'ASC')->get();
        }

        $days = isset($days) ? (int) $days : null;

        // Array with data, sent to the view
        $results = array();

        foreach($data as $value)
        {
            // Get product by id
            $product = Product::findOrFail($value->product_id);

            // Get location by id
            $location =  Location::findOrFail($value->location_id);

            // Prepare array with data
            array_push($results, [
                'product_id' => $value->product_id,
                
                'name' => $product->name,
                'location' => $location->name,
                'quantity' => $value->quantity,
                'created_at' => Carbon::parse($value->created_at)->format('Y-m-d'),
                'days' => Carbon::parse($value->created_at)->diffInDays()
            ]);
        }

        $pdf = PDF::loadView('pdf.expired_pdf', ['results' => $results, 'days' => $days]);
        $pdf->setPaper('a4', 'landscape');

        // Return PDF
        return $pdf->stream();
    }
}
