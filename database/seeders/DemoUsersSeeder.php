<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DemoUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@watchstore.test'],
            [
                'name' => 'WatchStore Admin',
                'password' => 'password',
                'is_admin' => true,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'customer@watchstore.test'],
            [
                'name' => 'Class Project Customer',
                'password' => 'password',
                'is_admin' => false,
            ]
        );
    }
}
