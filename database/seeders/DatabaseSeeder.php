<?php

namespace Database\Seeders;

use Database\Factories\RolesFactory;
use Database\Factories\UserroleFactory;
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
        // User::factory(10)->create();
        \App\Models\Role::factory(10)->create();
        \App\Models\Userrole::factory(10)->create();
    }
}
