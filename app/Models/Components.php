<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $primaryKey = 'component_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'component_id',
        'image',
        'name',
    ];

    public static function emptyComponent()
    {
        return new static();
    }

    public function toArray()
    {
        return [
            'component_id' => $this->component_id,
            'image' => $this->image,
            'name' => $this->name,
        ];
    }
}
