<?php

namespace App\Trait;
use Illuminate\Support\Facades\Schema;

trait CreatedUpdatedByTrait
{
    public function hasColumn($columnName)
    {
        $table = $this->getTable();

        return Schema::hasColumn($table, $columnName);
    }
    public static function bootCreatedUpdatedByTrait(): void
    {
        // updating created_by and updated_by when model is created
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
//                $model->created_by = auth()->user()->id;
                $model->created_by = 1;
            }
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = 1;
            }
            if (!$model->isDirty('store_id') && $model->hasColumn('store_id')) {
                $model->store_id = app('permission')->permissions['store'] ?? 1; // Set the default value for column1

            }
        });

        // updating updated_by when model is updated
        static::updating(function ($model) {
            if (!$model->isDirty('updated_by')) {
                $model->updated_by = 1;
            }
        });
    }
}
