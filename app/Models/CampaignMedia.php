<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'name',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(
            related: Campaign::class,
            foreignKey: 'campaign_id',
        );
    }
}
