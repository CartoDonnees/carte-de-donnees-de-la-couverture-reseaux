<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('comments')->insert([
            'user_id' => 1,
            
           // 'created_at' => "2022-02-15 14:40:07",
           // 'updated_at' => "2022-02-15 14:40:07",
            'comment' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of types and scrambled it to make a types specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
        ]);

        
        DB::table('comments')->insert([
            
            //'created_at' => "2022-02-15 14:40:07",
            //'updated_at' => "2022-02-15 14:40:07",
            'user_id' => 1,
            'comment' => "It is a long established fact that a reader will be distracted by the readable content of a "
        ]);

        
        DB::table('comments')->insert([
            'user_id' => 1,
            
           // 'created_at' => "2022-02-15 14:40:07",
           // 'updated_at' => "2022-02-15 14:40:07",
            'comment' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore "
        ]);

        
        DB::table('comments')->insert([
            'user_id' => 1,
          //  'created_at' => "2022-02-15 14:40:07",
          //  'updated_at' => "2022-02-15 14:40:07",
            'comment' => "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,"
        ]);

        
        DB::table('comments')->insert([
            'user_id' => 1,
           // 'created_at' => "2022-02-15 14:40:07",
           // 'updated_at' => "2022-02-15 14:40:07",
            'comment' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the "
        ]);
    }
}
