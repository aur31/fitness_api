<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory,Uuids;

    public $incrementing = false;
    public $timestamps = false;
    public $table = 'exercise';
    protected $keyType = 'string';
    protected $primaryKey = 'exercise_id';

    protected $fillable = [
        'exercise_id',
        'exercise_demo',
    ];
}
