<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewslettersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('newsletters')->insert([
            'title' => "Newsletters 1",
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's ",
            'likes' => "10",
            //'created_at' => "2022-02-15 14:40:07",
            //'updated_at' => "2022-02-15 14:40:07",
        ]);

        DB::table('newsletters')->insert([
            'title' => "Newsletters 2",
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the .",
            'likes' => "20",
            //'created_at' => "2022-02-15 14:40:07",
            //'updated_at' => "2022-02-15 14:40:07",
        ]);
    }
}
