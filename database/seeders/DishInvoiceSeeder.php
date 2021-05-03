<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DishInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $list = [];
        $numIn = 100;
        for ($i = 1; $i <= $numIn; $i++) {
            $n = $faker->numberBetween(1, 5);
            for ($j = 1; $j <= $n; $j++) {
                array_push($list, [
                    'invoice_id' => $i,
                    'dish_id' => $faker->numberBetween(1, 71),
                    'numerical_order' => $j,
                    'amount' => $faker->numberBetween(1, 3),
                    'price' => 1000 * $faker->numberBetween(10, 300),
                    'status' => true,
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
            }
        }
        DB::table('dish_invoice')->insert($list);
    }
}
