<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class OderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => '01',
            'status_name' => '入金待ち',
        ];
        DB::table('oder_status')->insert($param);

        $param = [
            'id' => '02',
            'status_name' => '発送準備中',
        ];
        DB::table('oder_status')->insert($param);

        $param = [
            'id' => '03',
            'status_name' => '発送完了',
        ];
        DB::table('oder_status')->insert($param);

        $param = [
            'id' => '04',
            'status_name' => 'キャンセル',
        ];
        DB::table('oder_status')->insert($param);
    }
}
