<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiItem extends Model
{
    use HasFactory;

    protected $table = 'api_items';

    protected $fillable = [
        'title',
        'description',
        'is_active',
    ];
}
