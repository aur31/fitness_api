<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    use HasFactory;

    protected $primaryKey = 'testimony_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'testimony_id',
        'testimony',
        'status',
        'user_id',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function empty()
    {
        return new static([
            'testimony_id' => '',
        ]);
    }

    public function toArray()
    {
        return [
            'testimony_id' => $this->testimony_id,
            'testimony' => $this->testimony,
            'status' => $this->status,
            'user_id' => $this->user_id,
        ];
    }
}
