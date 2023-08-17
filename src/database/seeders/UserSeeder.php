<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
        [
            'id' => '1',
            'name' => 'master',
            'email' => 'master@master',
            'password' => Hash::make('master1234'),
            'role' => '1'
        ]);

        User::create(
            [
                'id' => '2',
                'name' => 'master_host',
                'email' => 'master@masterhost',
                'password' => Hash::make('master1234'),
                'role' => '2'
            ]);
    }
}
