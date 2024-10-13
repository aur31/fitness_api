<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exercise extends Model
{
    use HasFactory,Uuids;

    protected $primaryKey = 'exercise_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    public $table = 'exercise';

    protected $fillable = [
        'exercise_id',
        'name',
        'url',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    public static function empty()
    {
        return new static([
            'exercise_id' => '',
            'name' => null,
            'url' => null,
            'status' => null,
        ]);
    }

    public function toArray()
    {
        return [
            'exercise_id' => $this->exercise_id,
            'name' => $this->name,
            'url' => $this->url,
            'status' => $this->status,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
