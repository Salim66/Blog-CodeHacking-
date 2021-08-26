<?php

namespace Database\Seeders;


use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'role_id'       => 2,
            'is_active'     => 1,
            'name'          => Str::random(10),
            'email'         => Str::random(10).'@gmail.com',
            'password'      => bcrypt('screet')
        ]);

    }
}
