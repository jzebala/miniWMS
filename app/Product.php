<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /*
     * Get name Product
     */
    public static function getName($id)
    {
        return (new static)::where('id', $id)->first()->name;
    }

    /**
     * Get the stock level record associated with the product.
     * 
     */
    public function stockLevel()
    {
        return $this->hasOne('App\StockLevel');
    }

    /**
     * The locations that belong to the product.
     */
    public function locations()
    {
        return $this->belongsToMany('App\Location')
        ->withPivot('quantity')
        ->withTimestamps();
    }

    /*
     * Get name location of product.
     */
    public function getNameLocation($id)
    {
        return $this->locations()->where('location_id', $id)->first()->name;
    }

    /*
     * Get quantity product on location.
     * $id - location id
     */
    public function getQuantityLocation($id)
    {
        return $this->locations()->where('location_id', $id)->first()->pivot->quantity;
    }

    /*
     * Get count of locations attach to product 
     */
    public function locationsCount()
    {
        return $this->locations()->count();
    }
}
