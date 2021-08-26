<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('posts')->truncate();
        DB::table('categories')->truncate();
        DB::table('comments')->truncate();
        DB::table('comment_replies')->truncate();
        DB::table('photos')->truncate();

        // $this->call(UserTableSeeder::class); // individual simple user create
        // \App\Models\User::factory(10)->create();
        \App\Models\Role::factory(3)->create();
        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Photo::factory(10)->create();
        \App\Models\Post::factory(10)->create();
        \App\Models\Comment::factory(10)->create();
        \App\Models\CommentReply::factory(10)->create();
    }
}
