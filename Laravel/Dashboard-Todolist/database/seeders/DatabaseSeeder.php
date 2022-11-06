<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Todolist;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345')
        ]);

        User::create([
            'name' => 'saya',
            'username' => 'saya',
            'email' => 'saya@gmail.com',
            'password' => bcrypt('12345')
        ]);

        Category::factory(20)->create();

        Todolist::factory(30)->create();
    }
}