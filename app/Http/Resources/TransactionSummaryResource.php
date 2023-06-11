<?php

namespace App\Http\Resources;


class TransactionSummaryResource extends BaseResource
{
    public function toArray($request)
    {

        $customer = $this->whenLoaded('customer', function () {
            return [
                'id' => $this->customer['id'],
                'name' => $this->lan('name'),
                'mobile_no' => $this->customer['mobile_no'],
            ];
        });

        return [
            'id' => $this->id,
            'amount' => $this->balance,
            'note' => $this->note,
            'due_date' => $this->due_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'customer' => $customer,

        ];
    }
}
