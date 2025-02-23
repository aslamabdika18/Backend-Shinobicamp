<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Atlet extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function martialartstyle(): BelongsTo
    {
        return $this->belongsTo(MartialArtStyle::class);
    }
}
