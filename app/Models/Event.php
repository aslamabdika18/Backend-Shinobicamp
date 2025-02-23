<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'poster',
        'proposal',
        'slug',
        'description',
        'location',
        'first_event_date',
        'last_event_date',
        'register_deadline',
        'is_active',
    ];
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function categoryCamp(): HasMany
    {
        return $this->hasMany(CategoryCamp::class);
    }
    public function classCamp(): HasMany
    {
        return $this->hasMany(ClassCamp::class);
    }
}
