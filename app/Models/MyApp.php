<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use App\Traits\HasCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyApp extends Model
{
    use BelongsToUser, HasFactory, HasCode;

    protected $table = 'my_apps';
    protected $fillable = ['name', 'primary_color', 'data'];
    public $casts = [
        'data' => 'object'
    ];
}
