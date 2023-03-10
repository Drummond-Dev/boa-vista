<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'sort_order',
    ];

    public function medias(): HasMany
    {
        return $this->hasMany(
            related: CampaignMedia::class,
            foreignKey: 'campaign_id',
        );
    }
}
