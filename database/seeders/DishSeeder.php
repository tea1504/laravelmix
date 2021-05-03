<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DishSeeder extends Seeder
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
        $type = [
            [
                'Lẩu mắm', 'Lẩu thái chua cay', 'Lẩu gà lá giang', 'Lẩu gà ớt hiểm', 'Lẩu bò', 'Lẩu cá kèo', 'Lẩu ếch măng chua', 'Lẩu cua đồng', 'Lẩu ghẹ', 'Lẩu lươn chua cay', 'Lẩu dê', 'Lẩu hải sản', 'Lẩu chay', 'Lẩu vịt om sấu', 'Lẩu cá hồi', 'Lẩu đuôi bò', 'Lẩu nấm', 'Lẩu cá thác lác', 'Lẩu riêu cua bắp bò', 'Lẩu bò nhúng giấm',
            ],
            [
                'Sprite',
                'Coca Cola',
                '7 Up',
                'Mirinda cam',
                'Mirinda soda kem',
            ],
            [
                'Cơm chiên mực',
                'Cơm chiên dưa bò',
                'Cơm chiên trái thơm',
                'Cơm chiên kiểu Thái',
                'Cơm chiên tôm',
                'Cơm chiên tỏi',
                'Cơm chiên Dương Châu',
                'Cơm chiên trứng cuộn',
                'Cơm chiên phô mai',
                'Cơm chiên kim chi',
            ],
            [
                'Mì bò trứng',
                'Mì Quảng hải sản',
                'Mì ngao',
                'Mì xào hải sản',
                'Mì ý',
                'Mì trộn gà áp chảo',
                'Mì xào giòn',
                'Mì xào thập cẩm',
                'Mì xào chay',
                'Mì xào thịt',
                'Mì vịt tiềm'
            ],
            [
                'Thịt bắp bò luộc gừng sả',
                'Tràng lợn luộc trộn măng tươi',
                'Đậu bắp luộc chấm chao',
                'Thịt lợn luộc ngâm nước mắm',
                'Lòng non luộc chấm với mắm ruốc',
                ' Bún thịt luộc chấm mắm nêm',
                'Bắp cải luộc chấm nước mắm trứng',
                'Lòng lợn luộc trộn hành tây',
            ],
            [
                'Bò kho nước dừa',
                'Vịt kho vỏ quýt',
                'Thịt kho tàu',
                'Sường kho dưa',
                'Cá bạc má kho cà chua',
            ],
            [
                'Canh mướp nấm rơm',
                'Canh khoai mở nấu tôm',
                'Canh ngao nấu dứa',
                'Canh thịt bog nấu nấm kim châm',
                'Canh khổ qua nhồi thịt',
                'Canh cải thảo cuộn thịt heo',
                'Canh nha đam thịt bò',
                'Canh tôm rau cải non',
                'Canh mọc nấm củ quả',
                'Canh thiên lý nấu cua',
                'Canh chua nấu cá lóc',
                'Canh hến nấu chua',
            ]
        ];
        for ($i = 1; $i <= count($type); $i++) {
            for ($j = 1; $j <= count($type[$i - 1]); $j++) {
                $price = 0;
                switch ($i) {
                    case 1:
                        $price = 10000 * $faker->numberBetween(10, 20) + 99000;
                        break;
                    case 2:
                        $price = 10000;
                        break;
                    case 3:
                        $price = 1000 * $faker->numberBetween(40, 60);
                        break;
                    case 4:
                        $price = 1000 * $faker->numberBetween(25, 40);
                        break;
                    default:
                        $price = 1000 * $faker->numberBetween(30, 80);
                        break;
                }
                array_push($list, [
                    'type_id' => $i,
                    'name' => $type[$i - 1][$j - 1],
                    'price' => $price,
                    'image' => $faker->imageUrl(400, 400),
                    'description' => $faker->text(),
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
            }
        }
        DB::table('dishes')->insert($list);
    }
}
