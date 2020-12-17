<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Admin;
use App\Models\Bill;
use App\Models\Cart;
use App\Models\AdminMessage;
use App\Models\Bill_detail;
use App\Models\CartProduct;
use App\Models\Category;
use App\Models\Image;
use App\Models\Information;
use App\Models\InformationUser;
use App\Models\Message;
use App\Models\Producer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Condition;
use App\Models\Coupon;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Rate;
use App\Models\Introduce;
use App\Models\CategoryProducer;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement([
            'charging cable',
            'rechargeable battery backup',
            'speaker',
            'storage_device',
            'keyboard',
            'headphone',
            'case',
            'tempered glass',
            'other',
        ]),
        'display_order'=>rand(1,10),
    ];
});
$factory->define(User::class, function (Faker $faker) {
    return [
        'name'              => $faker->name,
        'email'             => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password'          => Hash::make('pikachu'), // password
        'remember_token'    => Str::random(10),
    ];
});
$factory->define(Product::class, function (Faker $faker) {
    return [
        'producer_id' => Producer::all()->random(),
        'name'        => $faker->name,
        'price'       => rand(1000, 20000000),
        'category_id' => Category::all()->random(),
        'qty'         => rand(100, 1000),
        'status'      => $faker->randomElement(['out of stock', 'stock', 'coming soon']),
    ];
});
$factory->define(Image::class, function (Faker $faker) {
    return [
        'image'  => rand(1000, 20000000),
        'status' => 1,
    ];
});
$factory->define(Producer::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['apple', 'samsung', 'lg', 'sony', 'lenovo', 'hoco']),
    ];
});
$factory->define(CategoryProducer::class, function (Faker $faker) {
    return [
        'category_id' => Category::all()->random(),
        'producer_id' => Producer::all()->random(),
    ];
});
$factory->define(Introduce::class, function (Faker $faker) {
    return [
        'short_introduce' => Str::random(250),
        'introduce' => Str::random(1000),
    ];
});
$factory->define(Cart::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random(),
    ];
});
$factory->define(CartProduct::class, function (Faker $faker) {
    return [
        'cart_id'    => Cart::all()->random(),
        'product_id' => Product::all()->random(),
        'qty'        => rand(1, 10),
    ];
});
$factory->define(Information::class, function (Faker $faker) {
    return [
        'phone'       => $faker->phoneNumber,
        'address'     => $faker->address,
        'province_id' => Province::all()->random(),
        'district_id' => District::all()->random(),
        'ward_id'     => Ward::all()->random(),
    ];
});
$factory->define(Rate::class, function (Faker $faker) {
    return [
        'user_id'    => User::all()->random(),
        'product_id' => Product::all()->random(),
        'rate'       => rand(1, 5),
    ];
});
$factory->define(Condition::class, function (Faker $faker) {
    return [
        'rule'     => Str::random(10),
        'message'  => Str::random(50),
        'discount' => rand(1, 10) / 10,
        'maximum'  => rand(1000, 100000),
        'minimum'  => rand(1000, 100000),
    ];
});
$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'code'   => Str::random(5),
        'status' => rand(0, 1),
    ];
});
$factory->define(Sale::class, function (Faker $faker) {
    return [
        'product_id' => Product::all()->random(),
        'sale'       => 0.1,
        'qty'        => 80,
    ];
});
