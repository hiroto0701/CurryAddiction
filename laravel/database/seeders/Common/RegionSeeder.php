<?php

declare(strict_types=1);

namespace Database\Seeders\Common;

use Database\Seeders\AbstractSeeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends AbstractSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            '北海道地方',
            '東北地方',
            '関東地方',
            '中部地方',
            '近畿地方',
            '中国地方',
            '四国地方',
            '九州地方',
        ];


        foreach ($regions as $region) {
            DB::table('regions')->insert(
                [
                    'name' => $region,
                ] + $this->commonColumns
            );
        }
	}
}
