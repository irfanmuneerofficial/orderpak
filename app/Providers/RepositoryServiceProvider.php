<?php

namespace App\Providers;

use App\Http\Controllers\Api\V1\BankInfo\Interfaces\BankInfoInterface;
use App\Http\Controllers\Api\V1\BankInfo\Repository\BankInfoRepository;
use App\Http\Controllers\Api\V1\Wallet\Repository\WalletRepository;
use App\Http\Controllers\Api\V1\Product\Interfaces\ProductInterface;
use App\Http\Controllers\Api\V1\Product\Repository\ProductRepository;
use App\Http\Controllers\Api\V1\Commission\Interfaces\CommissionInterface;
use App\Http\Controllers\Api\V1\Commission\Repository\CommissionRepository;
use App\Http\Controllers\Api\V1\Dashboard\Interfaces\DashboardInterface;
use App\Http\Controllers\Api\V1\Dashboard\Repository\DashboardRepository;
use App\Http\Controllers\Api\V1\Orders\Interfaces\OrderInterface;
use App\Http\Controllers\Api\V1\Orders\Repository\OrderRepository;
use App\Http\Controllers\Api\V1\Vendor\Interfaces\VendorProfileInterface;
use App\Http\Controllers\Api\V1\Vendor\Repository\VendorProfileRepository;
use App\Http\Controllers\Api\V1\Wallet\Interfaces\WalletInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ProductInterface::class, 
            ProductRepository::class,
        );
        $this->app->bind(
            VendorProfileInterface::class,
            VendorProfileRepository::class,
        );
        $this->app->bind(
            CommissionInterface::class,
            CommissionRepository::class
        );
        $this->app->bind(
            OrderInterface::class,
            OrderRepository::class
        );
        $this->app->bind(
            BankInfoInterface::class,
            BankInfoRepository::class
        );
        $this->app->bind(
            WalletInterface::class,
            WalletRepository::class
        );

        $this->app->bind(
            DashboardInterface::class,
            DashboardRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
