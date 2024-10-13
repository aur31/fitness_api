<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $primaryKey = 'ingredient_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'ingredient_id',
        'meal_id',
        'ingredient',
        'description',
    ];

    public function meal()
    {
        return $this->belongsTo(Meal::class, 'meal_id');
    }

    public static function empty()
    {
        return new static([
            'ingredient_id' => '',
            'meal_id' => '',
        ]);
    }

    public function toArray()
    {
        return [
            'ingredient_id' => $this->ingredient_id,
            'meal_id' => $this->meal_id,
            'ingredient' => $this->ingredient,
            'description' => $this->description,
        ];
    }
}
