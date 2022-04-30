<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name" => "Primer usuario",
                "identification" => 1234,
                "password" => Hash::make(1234)
            ],
            [
                "name" => "Segundo usuario",
                "identification" => 4321,
                "password" => Hash::make(4321)
            ]
        ];
        
        foreach ($users as $item) {
            \App\Models\User::create($item);
        }
    }
}
