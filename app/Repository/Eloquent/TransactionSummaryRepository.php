<?php

namespace App\Repository\Eloquent;

use App\Http\Resources\OrderableProductListResource;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\ProductListResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\TransactionSummaryResource;
use App\Models\Product;
use App\Models\TransactionSummary;
use App\Repository\ProductRepositoryInterface;
use App\Repository\TransactionSummaryRepositoryInterface;
use Illuminate\Support\Carbon;


class TransactionSummaryRepository extends BaseRepository implements TransactionSummaryRepositoryInterface
{

    protected $model;

    public function __construct(TransactionSummary $model)
    {
        $this->model = $model;
    }

    public function listData($queryParams)
    {
        // Create the base query
        $summaryData = TransactionSummary::query();

        if (isset($queryParams['start-date'])) {
            if (isset($queryParams['end-date'])) {
                $summaryData->whereDate('updated_at', '<', Carbon::createFromFormat('d-m-Y', $queryParams['end-date'])->format('Y-m-d'));
            }
            $summaryData->whereDate('updated_at', '>', Carbon::createFromFormat('d-m-Y', $queryParams['start-date'])->format('Y-m-d'));
        } elseif (isset($queryParams['end-date'])) {
            $summaryData->whereDate('updated_at', '<', Carbon::createFromFormat('d-m-Y', $queryParams['end-date'])->format('Y-m-d'));
        }

// Retrieve the result
        $result = $summaryData->selectRaw(
            'SUM(CASE WHEN balance > 0 THEN balance ELSE 0 END) AS payable_amount,
                    SUM(CASE WHEN balance < 0 THEN balance ELSE 0 END) AS receivable_amount,
                    COUNT(CASE WHEN balance > 0 THEN 1 END) AS payable_to,
                    COUNT(CASE WHEN balance < 0 THEN 1 END) AS receivable_from'
        )->storeBy()->first();

        //return $result;

        $data = $this->model;

        if (isset($queryParams['start-date'])){
            if (isset($queryParams['end-date'])){
                $data= $data->whereDate('updated_at', '<', Carbon::createFromFormat('d-m-Y', $queryParams['end-date'])->format('Y-m-d'));
            }
            $data= $data->whereDate('updated_at', '>', Carbon::createFromFormat('d-m-Y', $queryParams['start-date'])->format('Y-m-d'));
        }elseif(isset($queryParams['end-date'])){
           $data= $data->whereDate('updated_at','<', Carbon::createFromFormat('d-m-Y', $queryParams['end-date'])->format('Y-m-d'));
        }
        $resultData = $data->with('customer')->storeBy()->get();

        $result['customers'] =  TransactionSummaryResource::collection($resultData);

        return $result;
    }

    public function orderableListData($queryParams)
    {
        $data = $this->model->whereIn('type', [1,2]);

        if (isset($queryParams['search'])){
            $data = $data->where(function ($query) use ($queryParams) {
                $query->where('name_en', 'like', "%{$queryParams['search']}%")
                    ->orWhere('name_bn', 'like', "%{$queryParams['search']}%")
                    ->orWhere('code', 'like', "%{$queryParams['search']}%");
            });
        }

        if (isset($queryParams['category'])){
            $data = $data->where('category_id', $queryParams['category']);
        }

        return OrderableProductListResource::collection($data->get());
    }

    public function getById(int $modelId, array $columns = ['*'], array $relations = [], array $appends = [])
    {
        return new ProductResource($this->model->select($columns)->with('category','supplier')->findOrFail($modelId)->append($appends));
    }

}
