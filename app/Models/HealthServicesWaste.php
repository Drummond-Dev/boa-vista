<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HealthServicesWaste extends Model
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
            related: HealthServicesWasteMedia::class,
            foreignKey: 'health_services_waste_id',
        );
    }
}
