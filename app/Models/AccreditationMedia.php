<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccreditationMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'accreditation_id',
        'name',
    ];

    public function accreditation(): BelongsTo
    {
        return $this->belongsTo(
            related: Accreditation::class,
            foreignKey: 'accreditation_id'
        );
    }
}
