<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccreditationBands extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'text',
        'file',
    ];
}
