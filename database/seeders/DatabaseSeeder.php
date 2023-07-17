<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Using Faker to generate DummyDatabase

        $faker = Faker::Create();

        for ($i = 0; $i < 50; $i++){
            $timestamp = $faker->dateTimeBetween('-1 year', 'now');
            DB::table('couriers')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'alamat' => $faker->address,
                'telp' => $faker->phoneNumber,
                'level' => $faker->numberBetween(1,5),
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);
        }
    }
}
