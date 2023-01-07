<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'game_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function groups()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeUuid($query, $uuid)
    {
        return $query->where('uuid', $uuid)->first();
    }

    public function scopeGetId($query, $uuid)
    {
        return $query->where('uuid', $uuid)->first()->id;
    }
}
