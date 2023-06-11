<?php

namespace App\Services;

use App\Repository\TransactionSummaryRepositoryInterface;
use App\Trait\FileProcessorTrait;

class BaseService
{
    use FileProcessorTrait;

    protected TransactionSummaryRepositoryInterface $transactionSummaryRepository;

    public function __construct()
    {
        $this->transactionSummaryRepository = app(TransactionSummaryRepositoryInterface::class);

    }
    protected function successResponse($data){
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => $data
        ]);
    }

    protected function failedResponseWithError($exception, $message = null){
        return response()->json([
            'code' => 422,
            'message' => 'error',
            'data'=>null,
            'errors' => property_exists($exception, 'errors') ? $exception->errors() : [],
        ]);
    }

}
