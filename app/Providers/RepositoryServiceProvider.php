<?php

namespace App\Providers;

use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\ProductRepository;
use App\Repository\Eloquent\ProductCategoryRepository;
use App\Repository\Eloquent\ProductStockRepository;
use App\Repository\Eloquent\ProductStockSummaryRepository;
use App\Repository\Eloquent\SalesRecordRepository;
use App\Repository\Eloquent\TransactionDetailsRepository;
use App\Repository\Eloquent\TransactionSummaryRepository;
use App\Repository\Eloquent\UnitConversionRepository;
use App\Repository\Eloquent\UnitRepository;

use App\Repository\EloquentRepositoryInterface;
use App\Repository\ProductCategoryRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use App\Repository\ProductStockRepositoryInterface;
use App\Repository\ProductStockSummaryRepositoryInterface;
use App\Repository\SalesRecordRepositoryInterface;
use App\Repository\TransactionDetailsRepositoryInterface;
use App\Repository\TransactionSummaryRepositoryInterface;
use App\Repository\UnitConversionRepositoryInterface;
use App\Repository\UnitRepositoryInterface;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(TransactionSummaryRepositoryInterface::class, TransactionSummaryRepository::class);
        $this->app->bind(TransactionDetailsRepositoryInterface::class, TransactionDetailsRepository::class);
    }
}
