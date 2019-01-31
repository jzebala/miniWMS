<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Location
         * Example: 10-2-3
         * 
         * 10 - Storage rack (Regał)
         * 2 - Shelf (Półka)
         * 3 - Row (Rząd)
         */

        $locations = [
            '10-1-1',
            '10-1-2',
            '10-1-3',
            '10-2-1',
            '10-2-2',
            '10-2-3',
            '10-3-1',
            '10-3-2',
            '10-3-3',
         ];

        foreach($locations as $value)
        {
            $location = new App\Location();
            $location->name = $value;
            $location->save();
        }
    }
}
