<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->insert([
            [
                'name' => 'test1',
                'email' => 'test1@test1.com',
                'password' => Hash::make('password'),
                'created_at' => '2023/03/24 09:38'
            ],
            [
                'name' => 'test2',
                'email' => 'test2@test2.com',
                'password' => Hash::make('password'),
                'created_at' => '2023/03/24 09:38'
            ],
            [
                'name' => 'test3',
                'email' => 'test3@test3.com',
                'password' => Hash::make('password'),
                'created_at' => '2023/03/24 09:38'
            ],
            [
                'name' => 'test4',
                'email' => 'test4@test4.com',
                'password' => Hash::make('password'),
                'created_at' => '2023/03/24 09:38'
            ],
            [
                'name' => 'test5',
                'email' => 'test5@test5.com',
                'password' => Hash::make('password'),
                'created_at' => '2023/03/24 09:38'
            ],
            [
                'name' => 'test6',
                'email' => 'test6@test6.com',
                'password' => Hash::make('password'),
                'created_at' => '2023/03/24 09:38'
            ],
        ]);
    }
}
