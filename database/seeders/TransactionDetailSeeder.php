<?php

namespace Database\Seeders;

use App\Models\TransactionDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionDetailSeeder extends Seeder
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
                'transaction_summary_id' => 2,
                'amount' => -1030.00,
                'sell_id' => null,
                'remark' => "Remark ",
                'is_halkhata' => 0,
                'created_by' => 1,
            ],
            [
                'transaction_summary_id' =>2,
                'amount' => 100.00,
                'sell_id' => null,
                'remark' => "Remark ",
                'is_halkhata' => 0,
                'created_by' => 1,
            ],
            [
                'transaction_summary_id' => 1,
                'amount' => -1100.00,
                'sell_id' => null,
                'remark' => "Remark ",
                'is_halkhata' => 0,
                'created_by' => 1,
            ],
            [
                'transaction_summary_id' =>2,
                'amount' => 100.00,
                'sell_id' => null,
                'remark' => "Remark ",
                'is_halkhata' => 0,
                'created_by' => 1,
            ],
            [
                'transaction_summary_id' => 1,
                'amount' => 100.00,
                'sell_id' => null,
                'remark' => "Remark ",
                'is_halkhata' => 0,
                'created_by' => 1,
            ],
        ];

        DB::table('transaction_details')->insert($sells);
    }
}
