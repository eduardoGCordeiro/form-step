<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhoneTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('phone_types')->insert([
            [
                'name' => 'Telefone celular'
            ],
            [
                'name' => 'Telefone fixo'
            ]
        ]);
    }
}
