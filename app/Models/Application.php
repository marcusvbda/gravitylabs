<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use App\Traits\HasCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use BelongsToUser, HasFactory, HasCode;

    protected $table = 'applications';
    protected $fillable = ['name', 'data'];
    public $casts = [
        'data' => 'object'
    ];
}
