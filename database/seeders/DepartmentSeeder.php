<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
        $types = ['Quản lý', 'Thu ngân', 'Bếp', 'Phục vụ'];
        for($i=1; $i<=count($types); $i++){
            array_push($list, [
                'name' => $types[$i-1],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        }
        DB::table('departments')->insert($list);
    }
}
