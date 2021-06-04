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
        array_push($list, [
            'department_id' => 1,
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'date_of_birth' => $faker->dateTimeBetween('-50 years', '-25 years', null),
            'identity_card_number' => $faker->numerify('############'),
            'phone_number' => $faker->numerify('0#########'),
            'address' => $faker->address(),
            'image' => 'http://demo.laravelmix.local:81/api/image/staff/user1.jpg',
            'username' => 'admin',
            'password' => Hash::make('12345'),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        array_push($list, [
            'department_id' => 2,
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'date_of_birth' => $faker->dateTimeBetween('-50 years', '-25 years', null),
            'identity_card_number' => $faker->numerify('############'),
            'phone_number' => $faker->numerify('0#########'),
            'address' => $faker->address(),
            'image' => 'http://demo.laravelmix.local:81/api/image/staff/user2.jpg',
            'username' => 'thungan',
            'password' => Hash::make('12345'),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        array_push($list, [
            'department_id' => 3,
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'date_of_birth' => $faker->dateTimeBetween('-50 years', '-25 years', null),
            'identity_card_number' => $faker->numerify('############'),
            'phone_number' => $faker->numerify('0#########'),
            'address' => $faker->address(),
            'image' => 'http://demo.laravelmix.local:81/api/image/staff/user3.jpg',
            'username' => 'daubep',
            'password' => Hash::make('12345'),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        array_push($list, [
            'department_id' => 4,
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'date_of_birth' => $faker->dateTimeBetween('-50 years', '-25 years', null),
            'identity_card_number' => $faker->numerify('############'),
            'phone_number' => $faker->numerify('0#########'),
            'address' => $faker->address(),
            'image' => 'http://demo.laravelmix.local:81/api/image/staff/user4.jpg',
            'username' => 'nhanvien',
            'password' => Hash::make('12345'),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        $k = 5;
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
                    'image' => 'http://demo.laravelmix.local:81/api/image/staff/user'.$k.'.jpg',
                    'username' => $faker->userName(),
                    'password' => Hash::make('12345'),
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
                $k++;
            }
        }
        DB::table('staff')->insert($list);
    }
}
