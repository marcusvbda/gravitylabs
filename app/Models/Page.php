<?php

namespace App\Models;

use App\Traits\BelongsToApp;
use App\Traits\HasCode;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use BelongsToApp, HasCode;

    protected $table = 'pages';
    protected $fillable = ['name', 'data'];
    public $casts = [
        'data' => 'object'
    ];
}
