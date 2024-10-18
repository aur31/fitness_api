<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportExercise extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    public $table = 'sport_execise';

    protected $fillable = [
        'exercise_id',
        'sport_cat_id',
        'name',
        'description',
        'status',
        'image',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function sportCategory()
    {
        return $this->belongsTo(SportCategory::class, 'sport_cat_id');
    }

}
