<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coachprofile extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
