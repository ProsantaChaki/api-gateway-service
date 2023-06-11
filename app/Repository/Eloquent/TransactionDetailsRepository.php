<?php

namespace App\Repository\Eloquent;

use App\Http\Resources\OrderableProductListResource;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\ProductListResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\TransactionSummary;
use App\Repository\ProductRepositoryInterface;
use App\Repository\TransactionDetailsRepositoryInterface;
use App\Repository\TransactionSummaryRepositoryInterface;


class TransactionDetailsRepository extends BaseRepository implements TransactionDetailsRepositoryInterface
{

    protected $model;

    public function __construct(TransactionSummary $model)
    {
        $this->model = $model;
    }

    public function listData($queryParams)
    {
        $data = $this->model;

        if (isset($queryParams['search'])){
            $data = $data->where(function ($query) use ($queryParams) {
                $query->where('name_en', 'like', "%{$queryParams['search']}%")
                    ->orWhere('name_bn', 'like', "%{$queryParams['search']}%")
                    ->orWhere('code', 'like', "%{$queryParams['search']}%");
            });
        }

        if (isset($queryParams['store'])){
            $data = $data->whereHas('stocks', function ($query) use ($queryParams)  {
                $query->where('store_id', $queryParams['store']);
            });
        }

        if (isset($queryParams['category'])){
            $data = $data->where('category_id', $queryParams['category']);
        }

        if (isset($queryParams['data_type']) && $queryParams['data_type']=='inventory'){
            return new PaginationResource($data->with('retailerUnit','brand','productStock')
                ->whereHas('productStock')
                ->storeBy()
                ->paginate( config('app.page_size')),'productResource');
        }else{
            return new PaginationResource($data->with('retailerUnit','brand','productStock')->storeBy()->paginate( config('app.page_size')),'productResource');

        }


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
