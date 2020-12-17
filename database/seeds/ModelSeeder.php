<?php

use Illuminate\Database\Seeder;

class ModelSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(\App\Models\User::class, 6)->create()
                                           ->each(function ($informationSeed) {
                                               $informationSeed->informations()
                                                               ->save(factory(\App\Models\Information::class)->make());
                                           });
        factory(\App\Models\Category::class, 6)->create();
        factory(\App\Models\Producer::class, 500)->create();
        factory(\App\Models\Product::class, 500)->create()
                                                ->each(function ($imageSeed) {
                                                    $imageSeed->images()
                                                              ->save(factory(\App\Models\Image::class)->make());
                                                })->each(function ($introduceSeed) {
                $introduceSeed->introduce()->save(factory(\App\Models\Introduce::class)->make());
            });
        factory(\App\Models\CategoryProducer::class, 6)->create();
        factory(\App\Models\Cart::class, 6)->create();
        factory(\App\Models\CartProduct::class, 6)->create();
        factory(\App\Models\CartProduct::class, 6)->create();
        factory(\App\Models\Rate::class, 500)->create();
        factory(\App\Models\Sale::class, 50)->create();
        factory(\App\Models\Condition::class, 50)->create()
                                                 ->each(function ($giftSeed) {
                                                     $giftSeed->gift()->save(factory(\App\Models\Coupon::class)->make());
                                                 });
    }
}
