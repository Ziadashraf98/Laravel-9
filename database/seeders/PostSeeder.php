<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();

        Post::create([
            'title'=>'Products',
            'body'=>'Bags & Caps',
        ]);
        
        Post::create([
            'title'=>'programming languages',
            'body'=>'php & java',
        ]);
    }
}
