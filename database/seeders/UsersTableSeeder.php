<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $user = User::create([
            'name' => 'kyuib',
            'email' => 'kyuib@example.com',
            'password' => bcrypt('password')
        ]);

        $user->createToken('kyuib')->plainTextToken;

        User::factory()->count(5)->create();
    }
}
