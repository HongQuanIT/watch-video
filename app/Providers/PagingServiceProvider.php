<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class PagingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('paging', function ($perPage, $pageNumber) {
            $paged = $this->paginate($perPage, ['*'], 'page', $pageNumber);
            $data = [
                'pagination' => [
                    'total' => $paged->total(),
                    'per_page' => $paged->perPage(),
                    'current_page' => $paged->currentPage(),
                    'last_page' => $paged->lastPage(),
                    'from' => $paged->firstItem(),
                    'to' => $paged->lastItem(),
                ],
                'data' => $paged->items(),
            ];

            return $data;
        });
    }

}
