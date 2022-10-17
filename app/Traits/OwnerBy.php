<?php

namespace App\Traits;


trait OwnerBy {
    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->owner_id = auth()->id();
        });
    }
}