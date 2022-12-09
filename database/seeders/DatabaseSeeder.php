<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(20)->create();

        $users->each(function ($u) {
            Profile::factory()->create(['user_id' => $u->id]);

            Post::factory()->count(20)->create(['user_id' => $u->id]);
        });

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
