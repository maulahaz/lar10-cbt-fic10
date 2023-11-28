<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Fascades\DB;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //--Factory Data:
        \App\Models\Soal::factory(20)->create();

        //--Custom Data:
        // DB::table('tbl_banksoal')->insert(array(
        //     array(
        //         'name' => 'user',
        //         'email' => 'user@email.com',
        //         'email_verified_at' => now(),
        //         'password' => static::$password ??= Hash::make('password'),
        //         'remember_token' => Str::random(10),
        //     ),
        // ));
    }
}
