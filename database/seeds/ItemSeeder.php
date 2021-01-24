<?php

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(App\Product::class, 50)->create()->each(function($product){
			$prices = factory(App\ProductPricing::class)->make();
			$product->prices()->save($prices);
		});
    }
}
