<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use App\Currency;
use App\GeneralSetting;
use App\Product_Warehouse;
use App\Product;
use App\Warehouse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        /*if( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
            URL::forceScheme('https');
        }*/
        //setting language
        if (isset($_COOKIE['language'])) {
            App::setLocale($_COOKIE['language']);
        } else {
            App::setLocale('en');
        }

        if (!App::runningInConsole()) {
            // get general setting value
            $general_setting = GeneralSetting::latest()->first();
            $currency = Currency::where('id', $general_setting->currency)->first();

            config(['staff_access' => $general_setting->staff_access, 'date_format' => $general_setting->date_format, 'currency' => $currency->code, 'currency_position' => $general_setting->currency_position]);
            $alert_product = Product::where('is_active', true)
                ->whereHas('product_warehouse', function ($query) {
                    $query->whereColumn('products.alert_quantity', '>', 'product_warehouse.qty');
                })->count();

            View::share('general_setting', $general_setting);
            View::share('currency', $currency);
            View::share('alert_product', $alert_product);
            Schema::defaultStringLength(191);
        }
    }
}
