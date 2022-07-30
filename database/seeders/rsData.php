<?php

namespace Database\Seeders;

use App\Models\Data_rs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class rsData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "nama_rs" => "Dummy Rs",
                "alamat" => "Dummy Address",
                "email" => "dummy1@email.com",
                "tlp" => "0006483635"
            ],
            [
                "nama_rs" => "Dummy II Rs",
                "alamat" => "Dummy Address",
                "email" => "dumm2I@email.com",
                "tlp" => "0006483635"
            ],
            [
                "nama_rs" => "Dummy III Rs",
                "alamat" => "Dummy Address",
                "email" => "dummy3@email.com",
                "tlp" => "0006483635"
            ],
            ];

            foreach ($data as $key => $value) {
                Data_rs::create($value);
            }
    }
}
