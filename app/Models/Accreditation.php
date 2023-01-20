<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accreditation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'text'
    ];

    public function medias(): HasMany
    {
        return $this->hasMany(
            related: AccreditationMedia::class,
            foreignKey: 'accreditation_id',
        );
    }
}
