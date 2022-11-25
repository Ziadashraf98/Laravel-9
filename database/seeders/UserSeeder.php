<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'name'=>'Ziad',
            'email'=>'ziad@gmail.com',
            'password'=>Hash::make('1973'),
        ]);
        
        User::create([
            'name'=>'Ahmed',
            'email'=>'ahmed@gmail.com',
            'password'=>bcrypt('1973'),
        ]);
    }
}
