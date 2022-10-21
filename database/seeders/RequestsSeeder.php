<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('requests')->insert([
            'name' => 'Test',
            'status' => 'Active',
            'email' => 'Test@mail.ru',
            'message' => 'first_test',
            'created_at' => date('d.m.Y'),
        ]);
        DB::table('requests')->insert([
            'name' => 'Test3',
            'status' => 'Active',
            'email' => 'Tes3t@mail.ru',
            'message' => 'second_test',
            'created_at' => date('d.m.Y'),
        ]);
        DB::table('requests')->insert([
            'name' => 'Test3',
            'status' => 'Resolved',
            'email' => 'Test@mail.ru',
            'message' => 'third_test',
            'created_at' => date('d.m.Y'),
        ]);
    }
}
