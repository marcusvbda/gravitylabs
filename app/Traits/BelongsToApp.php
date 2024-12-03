<?php

namespace App\Traits;

use App\Models\MyApp;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToApp
{
    protected static function bootBelongsToApp()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $settings = Auth::user()->settings;
                $model->app_id =  @$settings->selected_app;
            }
        });

        static::addGlobalScope('app', function (Builder $builder) {
            if (Auth::check()) {
                $settings = Auth::user()->settings;
                $builder->where('app_id', @$settings->selected_app);
            }
        });
    }

    public function app(): BelongsTo
    {
        return $this->belongsTo(MyApp::class, 'app_id');
    }
}
