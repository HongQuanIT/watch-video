<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        //tam thoi, chuyen qua layout sau
        Relation::enforceMorphMap([
            "model" => "App\Models\User",
            'data' => 'Template\App\Models\Model',
            'object' => 'Template\App\Models\DomObject'
        ]);
    }
}
