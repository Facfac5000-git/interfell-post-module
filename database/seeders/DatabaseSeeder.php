<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@interfell.com',
            'password' => bcrypt('InterfellAdmin2021#')
        ]);

        User::factory()->create([
            'name' => 'Facfac5000',
            'email' => 'fchayle@interfell.com',
            'password' => bcrypt('Interfell2021')
        ]);

        Post::factory(150)->create();
    }
}
