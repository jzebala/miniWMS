<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockLevel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'quantity'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the product that owns the stock level.
     * 
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
