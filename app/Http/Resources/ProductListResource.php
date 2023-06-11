<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductListResource extends BaseResource
{
    public function toArray($request)
    {


        $retailerUnit = $this->whenLoaded('retailerUnit', function () {

            if ($this->retailerUnit  !== null){
                return [
                    'name' => $this->retailerUnit['name_'.app('permission')->permissions['language']]
                ];
            }
            return  null;
        });

        $brand = $this->whenLoaded('brand', function () {
            return $this->brand['name_'.app('permission')->permissions['language']];

        });
        $stock = $this->whenLoaded('productStock', function () {
            if ($this->productStock->first() !== null){
                return  $this->productStock->first()['current_stock'];
            }
            return  0;
        });

        return [
            'product_id' => $this->id,
            'name' => $this->lan('name'),
            'brand' => $brand,
            'image' => $this->image,
            'price' => $this->retailer_price,
            'details' => $this->description,
            'unit' => $retailerUnit,
            'stock' => $stock,
        ];
    }
}
