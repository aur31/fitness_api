<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vital extends Model
{
    use HasFactory;

    protected $primaryKey = 'vital_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'vital_id',
        'user_id',
        'weight',
        'height',
        'bmi',
        'blood_pressure',
        'blood_sugar',
        'heart_rate',
        'temperature',
        'oxygen_saturation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function empty()
    {
        return new static([
            'vital_id' => '',
        ]);
    }

    public function toArray()
    {
        return [
            'vital_id' => $this->vital_id,
            'user_id' => $this->user_id,
            'weight' => $this->weight,
            'height' => $this->height,
            'bmi' => $this->bmi,
            'blood_pressure' => $this->blood_pressure,
            'blood_sugar' => $this->blood_sugar,
            'heart_rate' => $this->heart_rate,
            'temperature' => $this->temperature,
            'oxygen_saturation' => $this->oxygen_saturation,
        ];
    }
}
