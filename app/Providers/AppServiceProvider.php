<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\RepositoryInterface::class
        );
        $this->app->singleton(
            \App\Repositories\Food\IFoodRepository::class,
            \App\Repositories\Food\FoodRepository::class,
        );
        $this->app->singleton(
            \App\Repositories\Cart\ICartRepository::class,
            \App\Repositories\Cart\CartRepository::class
        );
        $this->app->singleton(
            \App\Repositories\CartShop\ICartShopRepository::class,
            \App\Repositories\CartShop\CartShopRepository::class
        );
        $this->app->singleton(
            \App\Repositories\CartFood\ICartFoodRepository::class,
            \App\Repositories\CartFood\CartFoodRepository::class
        );
        
        $this->app->singleton(
            \App\Repositories\Combo\IComboRepository::class,
            \App\Repositories\Combo\ComboRepository::class
        );
        $this->app->singleton(
            \App\Repositories\ComboFood\IComboFoodRepository::class,
            \App\Repositories\ComboFood\ComboFoodRepository::class
        );
        $this->app->singleton(
            \App\Repositories\ComboFood\IComboFoodRepository::class,
            \App\Repositories\ComboFood\ComboFoodRepository::class
        );
        $this->app->singleton(
            \App\Repositories\InforShop\IInforShopRepository::class,
            \App\Repositories\InforShop\InforShopRepository::class
        );
        $this->app->singleton(
            \App\Repositories\InforUser\IInforUserRepository::class,
            \App\Repositories\InforUser\InforUserRepository::class
        );
        $this->app->singleton(
            \App\Repositories\ReviewFood\IReviewFoodRepository::class,
            \App\Repositories\ReviewFood\ReviewFoodRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Role\IRoleRepository::class,
            \App\Repositories\Role\RoleRepository::class
        );
        $this->app->singleton(
            \App\Repositories\ShipperDonHangShop\IShipperDonHangShopRepository::class,
            \App\Repositories\ShipperDonHangShop\ShipperDonHangShopRepository::class
        );
        $this->app->singleton(
            \App\Repositories\TrangThaiDonHang\ITrangThaiDonHangRepository::class,
            \App\Repositories\TrangThaiDonHang\TrangThaiDonHangRepository::class
        );
        $this->app->singleton(
            \App\Repositories\Vouncher\IVouncherRepository::class,
            \App\Repositories\Vouncher\VouncherRepository::class
        );
        $this->app->singleton(
            \App\Repositories\InforShipper\IInforShipperRepository::class,
            \App\Repositories\InforShipper\InforShipperRepository::class
        );
        $this->app->singleton(
          \App\Repositories\Bill\BillRepository::class,
          \App\Repositories\Bill\IBillRepository::class 
        );

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
