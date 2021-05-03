<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
        $type = ['Lẩu', 'Nước uống', 'Cơm', 'Mì', 'Món luộc', 'Món kho', 'Canh'];
        for($i=1; $i<=count($type); $i++){
            array_push($list, [
                'name' => $type[$i-1],
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        }
        DB::table('types')->insert($list);
    }
}
