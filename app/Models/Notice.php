<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notice extends Model
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
            related: NoticeMedia::class,
            foreignKey: 'notice_id',
        );
    }
}
