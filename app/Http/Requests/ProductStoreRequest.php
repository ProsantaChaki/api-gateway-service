<?php

namespace App\Http\Requests;


class ProductStoreRequest extends BaseRequest
{
    public function messages(): array
    {
        return [
            'name.required' => 'A name is required',
            'details.required' => 'details is required',
        ];
    }
    protected function isUpdate(){
        return ($this->method() !== 'PUT') ? [
            'code' => 'nullable|unique:products|max:50',
            'stock' => 'nullable|numeric',
        ]
            :[
                'id' => 'required|exists:products',
                'code' => 'nullable|unique:products,code,' . $this->input('id') . '|max:50',
            ];
    }
    public function rules()
    {
        return array(
            'name_en' => 'required|max:100',
            'name_bn' => 'nullable|max:200',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'category_id' => 'required|exists:product_categories,id',
            'consumer_unit_id' => 'required|exists:units,id',
            'retailer_unit_id' => 'required|exists:units,id',
            'unit_conversion_rate' => 'nullable|numeric',
            'consumer_price' => 'nullable|numeric',
            'retailer_price' => 'nullable|numeric',
            'shape_id' =>  'nullable|exists:color_shapes,id,type,2',
            'color_id' => 'nullable|exists:color_shapes,id,type,1',
            'description' => 'nullable|max:500',
            'country_of_origin' => 'nullable|max:60',
            'is_approved' => 'nullable|boolean',
            'status' => 'nullable|boolean',
            'type' => 'integer|max:3',
            'icon_url' => 'nullable|max:500',
            'poster_url' => 'nullable|max:500',
            'sku' => 'nullable|max:50',
            'image' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ...$this->isUpdate()
        );
    }
}
