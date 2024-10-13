<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meal extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'meal_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'meal_id',
        'meal_name',
        'recipes',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class, 'meal_id');
    }

    public static function empty()
    {
        return new static([
            'meal_id' => '',
        ]);
    }

    public function toArray()
    {
        return [
            'meal_id' => $this->meal_id,
            'meal_name' => $this->meal_name,
            'recipes' => $this->recipes,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
