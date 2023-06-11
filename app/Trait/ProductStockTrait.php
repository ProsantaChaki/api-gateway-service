<?php

namespace App\Trait;

use Exception;


trait ProductStockTrait
{
    protected function updateStockQuantity($productId, $productQuantity){
        //Update current_stock by Oldest First
        $price = 0;

        $quantity = floatval($productQuantity);

        $totalStock = $this->productStockRepository->stockQuantity($productId);

        if(floatval($totalStock)<$quantity) throw new Exception('You do not have sufficient stock for the specified product.');

        while ($quantity > 0) {
            $productStock = $this->productStockRepository->getStock($productId);
            if ($productStock) {
                $unit_price = floatval($productStock->stock_in_price)/floatval($productStock->stock_in_quantity);
                $current_stock = floatval($productStock->current_stock);
                if ($current_stock >= $quantity) {
                    $price = $price+ $unit_price*$quantity;
                    $updated_quantity = $current_stock - $quantity;
                    $quantity = 0;
                    $productStock->current_stock = $updated_quantity;
                    $productStock->save();
                } else {
                    $price = $price+ $unit_price*$current_stock;

                    $quantity -= $current_stock;
                    $productStock->current_stock = 0;
                    $productStock->save();
                }
            } else {
                throw new Exception("Insufficient stock for product ID: $productId");
            }

            if ($quantity <= 0) {
                break;
            }
        }


        return $price;

    }

}
