<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccreditationBands extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'text',
        'file',
    ];

    public function medias(): HasMany
    {
        return $this->hasMany(
            related: AccreditationMedia::class,
            foreignKey: 'accreditation_media_id',
        );
    }
}
