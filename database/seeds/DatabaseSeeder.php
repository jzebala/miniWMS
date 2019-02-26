<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Run locations seeder
        $this->call(LocationsTableSeeder::class);
        
        // Run products seeder
        $this->call(ProductsTableSeeder::class);

        // Run roles seeder
        $this->call(RolesTableSeeder::class);

        // Run roles seeder
        $this->call(UsersTableSeeder::class);
    }
}
