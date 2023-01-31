<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConstructionWasteMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'construction_waste_id',
        'file',
        'file_name',
    ];

    public function construction(): BelongsTo
    {
        return $this->belongsTo(
            related: ConstructionWaste::class,
            foreignKey: 'id'
        );
    }
}
