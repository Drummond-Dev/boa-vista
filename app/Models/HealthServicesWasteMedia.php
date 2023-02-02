<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HealthServicesWasteMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'health_services_waste_id',
        'file',
        'file_name',
    ];

    public function health(): BelongsTo
    {
        return $this->belongsTo(
            related: HealthServicesWaste::class,
            foreignKey: 'health_services_waste_id',
        );
    }
}
