<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Auth;

trait BelongsToUser
{
    protected static function bootBelongsToUser()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->user_id = Auth::id();
            }
        });

        static::addGlobalScope('user', function (Builder $builder) {
            if (Auth::check()) {
                $builder->where('user_id', Auth::id());
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
