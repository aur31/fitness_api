<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Components extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;
    public $timestamps = false;
    public $table = 'components';
    protected $keyType = 'string';
    protected $primaryKey = 'component_id';

    protected $fillable = [
        'component_id',
        'name',
        'image',
    ];
    
}
