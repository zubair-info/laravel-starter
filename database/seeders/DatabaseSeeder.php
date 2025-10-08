<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Zubair Ahmed',
            'email' => 'zubair@bitbirds.com',
            'password' => bcrypt('Admin@123'),
        ]);
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);
    }
}
