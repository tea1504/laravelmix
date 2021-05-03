<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class StaffSeeder extends Seeder
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
        $numDepartment = 4;
        for ($i = 1; $i <= $numDepartment; $i++) {
            for ($j = 1; $j <= $i; $j++) {
                array_push($list, [
                    'department_id' => $i,
                    'first_name' => $faker->firstName(),
                    'last_name' => $faker->lastName(),
                    'date_of_birth' => $faker->dateTimeBetween('-50 years', '-25 years', null),
                    'identity_card_number' => $faker->numerify('############'),
                    'phone_number' => $faker->numerify('0#########'),
                    'address' => $faker->address(),
                    'image' => $faker->imageUrl(400, 400),
                    'username' => $faker->userName(),
                    'password' => Hash::make('12345'),
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
            }
        }
        DB::table('staff')->insert($list);
    }
}
