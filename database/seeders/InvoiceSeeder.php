<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class InvoiceSeeder extends Seeder
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
        $number = 100;
        for ($i = 1; $i <= $number; $i++) {
            $h = $faker->numberBetween(8, 21);
            $m = $faker->numberBetween(0, 59);
            $s = $faker->numberBetween(0, 59);
            $time = strtotime($h . ':' . $m . ':' . $s);
            array_push($list, [
                'staff_id' => $faker->numberBetween(2, 3),
                'table_id' => $faker->numberBetween(1, 20),
                'date' => $faker->dateTimeThisYear(),
                'is_paid' => true,
                'check_in' => date('H:i:s', $time),
                'check_out' => date('H:i:s', $time + $faker->numberBetween(60 * 30, 60 * 120)),
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        }
        DB::table('invoices')->insert($list);
    }
}
