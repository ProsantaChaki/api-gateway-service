<?php

namespace App\Services;

use App\Repository\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TransactionService extends BaseService
{

    public function listData( $queryParams){
        try {
            $sata =$this->transactionSummaryRepository->listData($queryParams);
            return $this->successResponse($sata);

        } catch (\Exception $exception) {
            DB::rollback();
            Log::error($exception->getMessage());
        }
    }

}
