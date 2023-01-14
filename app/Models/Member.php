<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['departament_id', 'staff_id'];

    public function staffs():HasMany
    {
        return $this->hasMany(Staff::class);
    }
}
