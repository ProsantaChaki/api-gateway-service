<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sells = [
            [
                'customer_id' => 1,
                'store_id' => 1,
                'balance' => -1100.00,
                'note' => "Note ",
                'due_date' => '2023-12-31',
                'created_by' => 1,
            ],
            [
                'customer_id' => 2,
                'store_id' => 1,
                'balance' => -100.00,
                'note' => "Note ",
                'due_date' => '2023-12-31',
                'created_by' => 1,
            ],
            [
                'customer_id' => 3,
                'store_id' => 1,
                'balance' => 1100.00,
                'note' => "Note ",
                'due_date' => '2023-12-31',
                'created_by' => 1,
            ],
            [
                'customer_id' => 4,
                'store_id' => 1,
                'balance' => -1100.50,
                'note' => "Note ",
                'due_date' => '2023-12-31',
                'created_by' => 1,
            ],
            [
                'customer_id' => 5,
                'store_id' => 1,
                'balance' => 1103.50,
                'note' => "Note ",
                'due_date' => '2023-12-31',
                'created_by' => 1,
            ],
        ];

        DB::table('transaction_summaries')->insert($sells);
    }
}
