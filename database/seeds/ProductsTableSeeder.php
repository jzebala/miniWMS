<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        // Creata random products
        for($i = 1; $i <= 80; $i++)
        {
            // Create record with product
            $product = new App\Product();
            $product->name = $faker->company;
            $product->ean_code = $faker->ean13;
            $product->save();

            // Create record with the stock level associated with the product
            $stockLevel = new App\StockLevel();
            $stockLevel->product_id = $product->id;
            $stockLevel->quantity = rand(1, 10000);
            $stockLevel->save();
        }
    }
}
