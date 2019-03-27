<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;
use App\Product;
use App\GodHand;

use Session;

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

        return view('location.show', compact('location'));
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
