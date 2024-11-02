<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use BelongsToUser, HasFactory;

    protected $table = 'applications';
    protected $fillable = ['name', 'data'];
    public $casts = [
        'data' => 'object'
    ];
}
