<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Location;
use App\Exports\ProductsExport;

use App\GodHand;

use PDF;
use Session;
use Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = isset($_GET['search']) ? \Request::get('search') : null;


        if(!isset($search))
        {
            $products = Product::paginate(10); // 10 records per page
        }
        else
        {
            $products = Product::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('ean_code', 'LIKE', '%' . $search . '%')
            ->orWhereHas('stockLevel', function($q) use ($search){
                return $q->where('quantity', 'LIKE', '%' . $search . '%');
            })
            ->orWhereHas('locations', function($q) use ($search){
                return $q->where('name', 'LIKE', '%' . $search . '%');
            })
            ->get();
        }

        // Return view with results
        return view('product.index', compact('products'));
    }

    public function excel()
    {
        return Excel::download(new ProductsExport, 'MiniWMS - products.xlsx');   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for attaching a new location.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function attachLocation($id)
    {
        // Get product by id
        $product = Product::findOrFail($id);

        // Get the names of the locations that are assigned to the product
        $product_location = $product->locations()->pluck('name');

        // Available locations, (No location where the product is already located).
        $locations = Location::whereNotIn('name', $product_location)->pluck('name', 'id');

        $disabled = false;

        if(count($locations) == 0)
        {
            $disabled = true;
        }

        return view('product.attach_location', compact('product', 'locations', 'disabled'));
    }

    /**
     * Attach location to the product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeAttachLocation(Request $request, $id)
    {
        // Get product by id
        $product = Product::findOrFail($id);

        // Error messages
        $messages = [
            'location.required' => 'To pole jest wymagane.',
            'quantity.required'  => 'To pole jest wymagane.',

            'location.integer' => 'Błędne dane w formularzu.',
            'quantity.integer'  => 'Błędne dane w formularzu.',
        ];

        // Validate data from request
        $this->validate($request, [
            'location' => 'required|integer',
            'quantity' => 'required|integer'
        ], $messages);

        // Attach new location product and save changes
        $product->locations()->attach($request->location, ['quantity' => $request->quantity]);
        $product->save();

        // Set message about results
        Session::flash('successMsg', 'Przypisano produkt do lokalizacji.');

        // Create God Hand log
        $godHand = new GodHand([
            'product_id' => $product->id,
            'location_id' => $request->location,
            'quantity' => $request->quantity,
            'action' => 'attach',
            'quantity_move' => $request->quantity,
            'target_location_id' => null
        ]);
        $godHand->save();

        // Return results
        if(isset($request->back))
        {
            // User checked checkbox input. Back to the form
            return redirect()->route('product.attachLocation', $product->id);
        }
        else
        {
            // Return to the product card
            return redirect()->route('product.show', $product->id);
        }
    }

    /**
     * Detach location to the product.
     *
     * @param  int  $product_id
     * @param  int  $location_id
     * @return \Illuminate\Http\Response
     */
    public function detachLocation(Request $request)
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
            Session::flash('warningMsg', 'Produkt z lokalizacji usunięto!');

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
        return redirect()->route('product.show', $product->id);
    }

    /**
     * Show the form for moving product.
     *
     * @param int $product_id, $location_id
     * @return \Illuminate\Http\Response
     */
    public function moveProduct($product_id, $location_id)
    {
        // Get product by id
        $product = Product::findOrFail($product_id);

        // Get location by id
        $location = Location::findOrFail($location_id);

        // Get the names of the locations that are assigned to the product
        $product_location = $product->locations()->pluck('name');

        // Available locations, (No location where the product is already located).
        $locations = Location::whereNotIn('name', $product_location)->pluck('name', 'id');

        return view('product.move_product', compact('product', 'location', 'locations'));
    }

    /**
     * Move product to the new location.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product_id, $location_id
     * @return \Illuminate\Http\Response
     */
    public function storeMoveProduct(Request $request, $product_id, $location_id)
    {
        // Get product by id
        $product = Product::findOrFail($product_id);

        // Quantity of product on the location
        $qpl = $product->getQuantityLocation($location_id);

        // Validate data from request
        $this->validate($request, [
            'location' => 'required|integer|',
            'quantity' => 'required|integer|between:1,' . $qpl
        ]);

        // Check if the user moves the entire quantity of the product
        if($request->quantity == $qpl)
        {
            // User moves entire quantity product

            // Move product to the new location
            $product->locations()->attach($request->location, ['quantity' => $request->quantity]);

            // Detach product from old location
            $product->locations()->detach($location_id);

            // Create God Hand log
            $godHand = new GodHand([
            'product_id' => $product->id,
            'location_id' => $location_id,
            'quantity' => $qpl,
            'action' => 'move',
            'quantity_move' => $request->quantity,
            'target_location_id' => $request->location
            ]);
            $godHand->save();
        }
        else
        {
            // User moves not entire quantity product

            // The remaining quantity of product on the location
            $r = $qpl - $request->quantity;

            // Update product on old location
            $product->locations()->updateExistingPivot($location_id, ['quantity' => $r]);

            // Move product to the new location
            $product->locations()->attach($request->location, ['quantity' => $request->quantity]);

            // Create God Hand log
            $godHand = new GodHand([
            'product_id' => $product->id,
            'location_id' => $location_id,
            'quantity' => $qpl,
            'action' => 'move',
            'quantity_move' => $request->quantity,
            'target_location_id' => $request->location
            ]);
            $godHand->save();
        }

        // Set message about results
        Session::flash('successMsg', 'Produkt został przeniesiony!');

        // Return to the product card
        return redirect()->route('product.show', $product->id);
    }

    /**
     * Display the product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get product by id
        $product = Product::findOrFail($id);

        // Get the names of the locations that are assigned to the product
        $product_location = $product->locations()->pluck('name');

        // Available locations, (No location where the product is already located).
        $locations = Location::whereNotIn('name', $product_location)->pluck('name', 'id');

        return view('product.show', compact('product', 'locations'));
    }

    /**
     * Display product in PDF format.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productPdf($id)
    {
        // Get product by id
        $product = Product::findOrFail($id);

        $pdf = PDF::loadView('pdf.product_pdf', ['product' => $product]);
        $pdf->setPaper('a4', 'landscape');

        // Return PDF
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
