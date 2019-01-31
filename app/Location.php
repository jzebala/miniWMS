<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The products that belong to the location.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /*
     * Get count of products on location
     */
    public function productsCount()
    {
        return $this->products()->count();
    }

    /*
     * Get name Location
     */
    public static function getName($id)
    {
        return (new static)::where('id', $id)->first()->name;
    }
}
