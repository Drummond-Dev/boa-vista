<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConstructionWaste extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'text',
    ];

    public function medias(): HasMany
    {
        return $this->hasMany(
            related: ConstructionWasteMedia::class,
            foreignKey: 'construction_waste_id',
        );
    }
}
