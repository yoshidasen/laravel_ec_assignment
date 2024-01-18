<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'トップス'
        ];
        $param = [
            'name' => 'アウター'
        ];
        $param = [
            'name' => 'インナー'
        ];
        $param = [
            'name' => 'パンツ'
        ];
        $param = [
            'name' => 'スカート'
        ];
        $param = [
            'name' => 'その他'
        ];
    }
}
