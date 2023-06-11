<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    protected $childResourceName;

    public function __construct($resource, $childResourceName)
    {
        parent::__construct($resource);
        $this->childResourceName = $childResourceName;
    }
    public function toArray($request)
    {
        //$childResource = $this->getChildResource();

        return [
            'current_page' => $this->currentPage(),
            'data'=> $this->getChildResource($this->items()),
            'from' => $this->firstItem(),
            'last_page' => $this->lastPage(),
            'per_page' => $this->perPage(),
            'to' => $this->lastItem(),
            'total' => $this->total(),

        ];
    }

    protected function getChildResource($data)
    {
        switch ($this->childResourceName) {
            case 'unitResource':
                return UnitResource::collection($data);
           case 'productCategoryResource':
                return ProductCategoryResource::collection($data);
           case 'productResource':
                return ProductListResource::collection($data);
           case 'productStockResource':
                return ProductStockResource::collection($data);
        }
    }

    private function paginationLinks()
    {
        $links = [];

        $links[] = [
            'url' => $this->previousPageUrl(),
            'label' => '&laquo; Previous',
            'active' => false,
        ];

        foreach ($this->getUrlRange(1, $this->lastPage()) as $page => $url) {
            $links[] = [
                'url' => $url,
                'label' => $page,
                'active' => $this->currentPage() === $page,
            ];
        }

        $links[] = [
            'url' => $this->nextPageUrl(),
            'label' => 'Next &raquo;',
            'active' => false,
        ];

        return $links;
    }
}
