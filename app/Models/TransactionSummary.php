<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionSummary extends BaseModel
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the store associated with the transaction summary.
     */
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

}
