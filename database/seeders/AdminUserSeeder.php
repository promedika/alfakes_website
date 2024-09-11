<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'fullname' => 'Admin',
            'email' =>  'admin@admin.com',
            'password' => Hash::make('Alfakes01'),
            'created_by' => '1',
            'updated_by' => '1',
        ]);
    }
}
