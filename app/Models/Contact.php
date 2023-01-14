<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['phone1', 'phone2', 'email', 'address', 'staff_id'];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
