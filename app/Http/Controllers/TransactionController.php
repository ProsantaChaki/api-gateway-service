<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function list(Request $request){
        return $this->transactionService->listData($request->all());
    }
}
