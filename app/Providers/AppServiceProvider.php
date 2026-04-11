<?php

namespace App\Providers;
use App\Models\Partners\Partner;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */


public function boot()
{
    View::composer('partner.*', function ($view) {
        if (session()->has('partner_id')) {
            $partner = Partner::find(session('partner_id'));
            $view->with('partner', $partner);
        }
    });
}

}
