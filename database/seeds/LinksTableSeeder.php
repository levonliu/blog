<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'link_name' => 'LLLLL',
                'link_title' => '66666',
                'link_url' => 'https://www.baidu.com',
                'link_order' => 1,
            ],
            [
                'link_name' => 'DDDDD',
                'link_title' => '66666',
                'link_url' => 'https://www.baidu.com',
                'link_order' => 2,
            ]
        ];
        DB::table('links')->insert($data);
    }
}
