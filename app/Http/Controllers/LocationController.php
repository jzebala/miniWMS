<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;
use App\Product;
use App\GodHand;

use Session;
use Carbon\carbon;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::paginate(9);

        return view('location.index', compact('locations'));
    }

    public function show($id)
    {
        $location = Location::findOrFail($id);

        $collection = collect([]); 

        foreach($location->products as $product) {

            $collection->push(
            [
                'id' => $product->id,
                'name' => $product->name,
                'quantity' => $product->getQuantityLocation($location->id),
                'created_at' => Carbon::parse($product->getDate($location->id))->format('Y-m-d')
            ]);
        }

        // Sort by created date
        $products = $collection->sortByDesc('created_at');
        
        return view('location.show', compact('location', 'products'));
    }

    /**
     * Detach product to the location.
     *
     * @param  int  $product_id
     * @param  int  $location_id
     * @return \Illuminate\Http\Response
     */
    public function detachProduct(Request $request)
    {
        // Validate data from request
        $this->validate($request, [
            'product' => 'required|integer',
            'location' => 'required|integer'
        ]);

        // Get product by id.
        $product = Product::findOrFail($request->product);

        if($product->locations->contains($request->location))
        {
            // Set message about results
            Session::flash('successMsg', 'Produkt z lokalizacji usunięto!');

            $product->locations()->detach($request->location);

            // Create God Hand log
            $godHand = new GodHand([
            'product_id' => $product->id,
            'location_id' => $request->location,
            'quantity' => $request->quantity,
            'action' => 'detach',
            'quantity_move' => $request->quantity,
            'target_location_id' => null
            ]);
            $godHand->save();
        }
        else
        {
            // Set message about results
            Session::flash('dangerMsg', 'Ups, .... coś poszło nie tak!');
        }

        // Return to the product card
        return redirect()->route('location.show', $request->location);
    }
}
