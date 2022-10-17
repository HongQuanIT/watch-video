<?php

namespace App\Traits;


trait RandomId {
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->id = uniqid();
        });
    }
}