<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'members' => 'json',
    // ];

    protected $fillable = ['name', 'area'];

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }
}
