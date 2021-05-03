<?php

namespace Database\Seeders;

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
        $this->call([
            DepartmentSeeder::class,
            TableSeeder::class,
            TypeSeeder::class,
            StaffSeeder::class,
            InvoiceSeeder::class,
            DishSeeder::class,
            DishInvoiceSeeder::class,
        ]);
    }
}
