<?php

namespace Database\Seeders;

use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      Admin::create([
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'phone' => '01066075300',
        'password' => Hash::make('12345678'),
    ]);
    }
}
