<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CustomerSeeder::class,
           TransactionSummarySeeder::class,
           TransactionDetailSeeder::class,

        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name_en' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
