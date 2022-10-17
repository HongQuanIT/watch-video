<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('ok', function ($data, $code = 0) {
            $result = [];
            $result["status"] = "success";
            $result["data"] = $data;
            $result["messages"] = [];
            $result["code"] =  $code;
            return Response::make($result);
        });

        Response::macro('error', function ($data, $code = -1) {
            $result = [];
            $result["status"] = "error";
            $result["data"] = [];
            $result["messages"] = $data;
            $result["code"] =  $code;
            return Response::make($result);
        });
    }
}
