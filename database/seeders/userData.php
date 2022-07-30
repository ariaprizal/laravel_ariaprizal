<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                "name" => "Administator",
                "user_name" => "admin",
                "password" => bcrypt("admin"),
                "email" => "email@email.com"
            ]    
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
