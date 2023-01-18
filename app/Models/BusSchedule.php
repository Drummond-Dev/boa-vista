<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BusSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'pdf_file',
        'sort_order',
    ];

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($pdf_file) {
            Storage::disk('public')->delete($pdf_file);
        });
    }
}
