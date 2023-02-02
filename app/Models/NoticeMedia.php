<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NoticeMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'notice_id',
        'file',
        'file_name',
    ];

    public function notice(): BelongsTo
    {
        return $this->belongsTo(
            related: Notice::class,
            foreignKey: 'notice_id'
        );
    }
}
