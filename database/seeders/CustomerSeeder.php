<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            Customer::create([
                'name_en' => "Customer {$i}", // Example name in English
                'name_bn' => "গ্রাহক {$i}", // Example name in Bengali
                'mobile_no' => "012345678{$i}", // Example mobile number
                'store_id' => 1, // Example store ID
                'created_by' => 1, // Example created by user ID
            ]);
        }
        for ($i = 1; $i <= 5; $i++) {
            Customer::create([
                'name_en' => "Customer {$i}", // Example name in English
                'name_bn' => "গ্রাহক {$i}", // Example name in Bengali
                'mobile_no' => "012345638{$i}", // Example mobile number
                'store_id' => 2, // Example store ID
                'created_by' => 1, // Example created by user ID
            ]);
        }
    }
}
