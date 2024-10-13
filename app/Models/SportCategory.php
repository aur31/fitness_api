<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportCategory extends Model
{
    use HasFactory,Uuids;

    protected $primaryKey = 'sport_cat_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    public $table = 'sport_category';

    protected $fillable = [
        'sport_cat_id',
        'name',
        'status',
        'description',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public static function empty()
    {
        return new static([
            'sport_cat_id' => '',
        ]);
    }

    public function toArray()
    {
        return [
            'sport_cat_id' => $this->sport_cat_id,
            'name' => $this->name,
            'status' => $this->status,
            'description' => $this->description,
        ];
    }
}
