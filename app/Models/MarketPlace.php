<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketPlace extends Model
{
    use HasFactory;

    protected $primaryKey = 'market_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'market_id',
        'name',
        'url',
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
            'market_id' => '',
        ]);
    }

    public function toArray()
    {
        return [
            'market_id' => $this->market_id,
            'name' => $this->name,
            'url' => $this->url,
            'status' => $this->status,
            'user_id' => $this->user_id,
        ];
    }
}
