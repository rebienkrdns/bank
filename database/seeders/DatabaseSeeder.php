<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Carbon\Carbon;
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
        $createUsers = [
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

        foreach ($createUsers as $item) {
            User::create($item);
        }

        $users = User::all();

        foreach ($users as $item) {
            $accountQuantity = rand(2, 5);
            $count = 1;
            while ($count <= $accountQuantity) {
                Account::create([
                    "user_id" => $item->id,
                    "account" => rand(100000000, 999999999),
                    "status" => boolval(rand(0, 1)) ? "active" : "inactive",
                    "created_at" => Carbon::now()
                ]);
                $count++;
            }
        }
    }
}
