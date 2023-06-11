<?php

namespace App\Services;

use App\Repository\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ProductService extends BaseService
{

    public function store($request){


        DB::beginTransaction();
        try {

            $data =$request->validated();

            if (isset($data['image']) && $request->hasFile('image')) {
                $imageName =  $this->imageUploader($request->file('image') );
                $data['image'] = $imageName;
            }
            $stock = 0;
            if(isset($data['stock'])){
                $stock = (int)$data['stock'];
                unset($data['stock']);
            }
            //dd($stock);
            $product =$this->productRepository->create($data);

            if($stock !=0) {
                $productStockSummary = [];
                $productStockSummary['product_id'] = $product->id;
                $productStockSummary['unit_id'] = 1;
                $productStockSummary['current_stock'] = $stock;
                $productStockSummaryData = $this->productStockSummaryRepository->createStock($productStockSummary);


                $productStockDetails = [];
                $productStockDetails['product_stock_summary_id'] = $productStockSummaryData->id;
                $productStockDetails['stock_in_price'] = $data['consumer_price'];
                $productStockDetails['stock_in_quantity'] = $stock;
                $productStockDetails['current_stock'] = $stock;
                $productStockDetails['store_price'] = $data['retailer_price'];

                $productStockDetailsData = $this->productStockRepository->createStock($productStockDetails);
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'The request was successful',
                'data' => [$product,$productStockDetailsData, $productStockSummaryData]// the actual data returned by the API
            ]);

        } catch (\Exception $exception) {
            DB::rollback();
            Log::error($exception->getMessage());

            return response()->json([
                'status' => 'error',
                'message2' => $exception->getMessage(),
                'message' => 'Something wrong! Try again.',
                'errors' => property_exists($exception, 'errors') ? $exception->errors() : [],
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function update( $request){
        DB::beginTransaction();
        try {

            $data =$request->validated();

            if ($data['image'] && $request->hasFile('image')) {
                $imageName =  $this->imageUploader($request->file('image') );
                $data['image'] = $imageName;
                //remove old data
            }
            $id = $data['id'];
            unset($data['id']);

            $product =$this->productRepository->update($id, $data);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'The request was successful',
                'data' => $product// the actual data returned by the API
            ]);

        } catch (\Exception $exception) {
            DB::rollback();
            Log::error($exception->getMessage());

            return response()->json([
                'status' => 'error',
                'message2' => $exception->getMessage(),
                'message' => 'Something wrong! Try again.',
                'errors' => property_exists($exception, 'errors') ? $exception->errors() : [],
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function listData( $queryParams){
        try {
            $product =$this->productRepository->listData($queryParams);
            return response()->json([
                'status' => 'success',
                'message' => 'The request was successful',
                'data' => $product// the actual data returned by the API
            ]);

        } catch (\Exception $exception) {
            DB::rollback();
            Log::error($exception->getMessage());

            return response()->json([
                'status' => 'error',
                'message2' => $exception->getMessage(),
                'message' => 'Something wrong! Try again.',
                'errors' => property_exists($exception, 'errors') ? $exception->errors() : [],
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function orderableList( $queryParams){
        try {
            $product =$this->productRepository->orderableListData($queryParams);
            return $this->successResponse($product);

        } catch (\Exception $exception) {
            DB::rollback();
            Log::error($exception->getMessage());
            return $this->failedResponseWithError($exception);
        }
    }
    public function getProduct( $id){
        try {
            $product =$this->productRepository->getById($id);
            return $this->successResponse($product);

        } catch (\Exception $exception) {
            DB::rollback();
            Log::error($exception->getMessage());
            return $this->failedResponseWithError($exception);
        }
    }

    public function delete( $id){
        try {
            $product =$this->productRepository->deleteById($id);
            return $this->successResponse($product);

        } catch (\Exception $exception) {
            DB::rollback();
            Log::error($exception->getMessage());
            return $this->failedResponseWithError($exception);
        }
    }
}
