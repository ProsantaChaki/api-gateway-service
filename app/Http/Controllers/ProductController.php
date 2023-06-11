<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Services\ProductService;
use App\Trait\FileProcessorTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use FileProcessorTrait;
    private ProductService $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function store(ProductStoreRequest $request)
    {
        if($request->method() !== 'PUT'){
            return $this->productService->store($request);
        }else{
            return $this->productService->update($request);

        }
    }
    public function list(Request $request){
        return $this->productService->listData($request->all());
    }
    public function orderableList(Request $request){
        return $this->productService->orderableList($request->all());
    }

    public function getProduct($id){
        return $this->productService->getProduct($id);
    }
    public function delete($id)
    {
        return $this->productService->delete($id);
    }

    public function fileUpload(Request $request){

        try {
           $imageName =  $this->imageUploader($request->file('image') );
           return $imageName;
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }


}
