<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'responsibility_id', 'image', 'bio'];

    public function responsibility(): BelongsTo
    {
        return $this->belongsTo(Responsibility::class);
    }

    public function contacts(): HasOne
    {
        return $this->hasOne(Contact::class);
    }
}
