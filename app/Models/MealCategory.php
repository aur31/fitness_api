<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MealCategory extends Model
{
    use HasFactory,Uuids;

    protected $primaryKey = 'meal_cat_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    public $table = 'meal';

    protected $fillable = [
        'meal_cat_id',
        'name',
        'status',
        'description',
    ];

    protected $casts = [
        'status' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    public static function empty()
    {
        return new static([
            'meal_cat_id' => '',
        ]);
    }

    public function toArray()
    {
        return [
            'meal_cat_id' => $this->meal_cat_id,
            'name' => $this->name,
            'status' => $this->status,
            'description' => $this->description,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
