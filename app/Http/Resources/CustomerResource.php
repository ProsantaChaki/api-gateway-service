<?php

namespace App\Http\Resources;


class CustomerResource extends BaseResource
{
    public function toArray($request)
    {

        $category = $this->whenLoaded('category', function () {
            return [
                'id' => $this->category->id,
                'code' => $this->category->code,
                'parent_id' => $this->category->parent_id,
                'source' => $this->category->source,
                'name_en' => $this->category->name_en,
                'name_bn' => $this->category->name_bn,
                'image' => $this->category->image,
                'status' => $this->category->status,
            ];
        });

        $supplier = $this->whenLoaded('supplier', function () {
            return [
                'id' => $this->supplier['id'],
                'name_en' => $this->supplier['name_en'],
                'name_bn' => $this->supplier['name_bn'],
                'mobile_no' => $this->supplier['mobile_no'],
                'email' => $this->supplier['email'],
                'user_id' => $this->supplier['user_id'],
                'status' => $this->supplier['status'],
            ];
        });

        return [
            'id' => $this->id,
            'name_en' => $this->name_en,
            'name_bn' => $this->name_bn,
            'supplier_id' => $this->supplier_id,
            'code' => $this->code,
            'category_id' => $this->category_id,
            'consumer_unit_id' => $this->consumer_unit_id,
            'retailer_unit_id' => $this->retailer_unit_id,
            'unit_conversion_rate' => $this->unit_conversion_rate,
            'consumer_price' => $this->consumer_price,
            'retailer_price' => $this->retailer_price,
            'shape_id' => $this->shape_id,
            'color_id' => $this->color_id,
            'description' => $this->description,
            'country_of_origin' => $this->country_of_origin,
            'is_approved' => $this->is_approved,
            'status' => $this->status,
            'icon_url' => $this->icon_url,
            'poster_url' => $this->poster_url,
            'sku' => $this->sku,
            'category' => $category,
            'supplier' => $supplier,
        ];
    }
}
