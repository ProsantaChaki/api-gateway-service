<?php

namespace App\Models;

use App\Trait\CreatedUpdatedByTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{

    use HasFactory , SoftDeletes, CreatedUpdatedByTrait;
    protected $guarded = ['id'];
    public $pag_size = 20;
    public function store_id(){

        return app('permission')->permissions['store'] ?? null;
    }

    public function scopeStoreBy( Builder $query)
    {
        $storeId = app('permission')->permissions['store'] ?? null;
        $query->where(function ($query) use ($storeId) {
            $query->where('store_id', $storeId)
                ->orWhereNull('store_id');
        });
    }
}
