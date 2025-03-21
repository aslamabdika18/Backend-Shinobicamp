<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Martialartstyle extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function Atlet(): HasMany
    {
        return $this->hasMany(Atlet::class);
    }
}
