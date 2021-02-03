<?php

namespace App\Providers;

use App\Counterup;
use App\Language;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('frontend.partials.footer', function($view) {
            $default_lang = Language::where('default', 1)->first();

            $lang = !empty(session()->get('lang')) ? session()->get('lang') : $default_lang->slug;

            $all_counterup = Counterup::where('lang', $lang)->get();
            $view->with('all_counterup' , $all_counterup);
        });

        Schema::defaultStringLength(191);
    }
}
