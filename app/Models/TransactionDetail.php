<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends BaseModel
{
    public function transactionSummary()
    {
        return $this->belongsTo(TransactionSummary::class);
    }


}
