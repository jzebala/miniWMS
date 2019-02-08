<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\GodHand;
use App\Product;

use Session;

class GodHandController extends Controller
{
    public function index()
    {
        if (GodHand::count() <= 10) {
            $godHand = GodHand::orderBY('created_at', 'DESC')->get();
        } else {
            $godHand = GodHand::orderBY('created_at', 'DESC')->paginate(10);
        }

        return view('godHand.index', compact('godHand'));
    }

    public function godHand($id)
    {
        $godHand = GodHand::findOrFail($id);

        // Get product by Id
        $product = Product::findOrFail($godHand->product_id);

        switch($godHand->action)
        {
            case 'attach':

                /*
                 * User attach new location to the product
                 * So turn it over, detach product from location
                */

                // Check if there is a contains, and quantities ​​are compatible
                if ($product->locations->contains($godHand->location_id) &&  $product->getQuantityLocation($godHand->location_id) == $godHand->quantity)
                {
                    // Detach product from location 
                    $product->locations()->detach($godHand->location_id);
    
                    // Record is useless, so delete
                    $godHand->delete();

                    // Return message about result
                    Session::flash('successMsg', 'Wykonano!');
                }
                else
                {
                    // Error, record is useless, so delete
                    $godHand->delete();

                    // Return message about result
                    Session::flash('dangerMsg', 'Operacja nie jest możliwa do wykonania');
                }

            break;

            case 'detach':

                /*
                 * User detach product from location
                 * So turn it over, attach location to the product
                */

                if (!$product->locations->contains($godHand->location_id))
                {
                    // Attach product to location
                    $product->locations()->attach($godHand->location_id, ['quantity' => $godHand->quantity]);
    
                    // Record is useless, so delete
                    $godHand->delete();
    
                    Session::flash('successMsg', 'Wykonano!');
                }
                else
                {
                    // Error, record is useless, so delete
                    $godHand->delete();

                    // Return message about result
                    Session::flash('dangerMsg', 'Operacja nie jest możliwa do wykonania');
                }

            break;

            case 'move':

                /*
                 * User move product to new location
                 * So turn it over, move product back, to old location
                */

                // Check if the user moves the entire quantity of the product
                if ($godHand->quantity == $godHand->quantity_move)
                {
                    // User moves entire quantity product

                    if (!$product->locations->contains($godHand->location_id))
                    {

                        $product->locations()->attach($godHand->location_id, ['quantity' => $godHand->quantity]);

                        $product->locations()->detach($godHand->target_location_id);

                        $godHand->delete();
                        Session::flash('successMsg', 'Wykonano!');
                    }
                    else
                    {
                        $godHand->delete();
                        Session::flash('dangerMsg', 'Operacja nie jest możliwa do wykonania');
                    }
                }
                else
                {
                    // User moves not entire quantity product

                    $quantity_old_location = $product->getQuantityLocation($godHand->location_id);

                    // Update old location
                    $product->locations()->updateExistingPivot($godHand->location_id, ['quantity' => $quantity_old_location + $godHand->quantity_move]);

                    $product->locations()->detach($godHand->target_location_id);

                    $godHand->delete();
                    Session::flash('successMsg', 'Wykonano!');
                }

            break;
        }

        return redirect()->route('godhand.index');
    }
}
