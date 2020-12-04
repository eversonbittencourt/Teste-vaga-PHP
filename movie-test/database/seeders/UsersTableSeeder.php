<?php

namespace Database\Seeders;

// Models
use App\Models\User;

// Required Libraries
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::query()
            ->updateOrCreate([
                'name'     => 'Everson Bittencourt',
                'email'    => 'everson@test.com',
                'password' => '12345',
            ]);
    }
}
