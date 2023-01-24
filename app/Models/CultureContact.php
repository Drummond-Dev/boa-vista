<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CultureContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'email',
        'address',
        'cep',
        'city',
        'state',
        'phone',
    ];
}
