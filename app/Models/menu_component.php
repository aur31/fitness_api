<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu_component extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;
    public $table = 'menu_component';
    protected $keyType = 'string';
    protected $primaryKey = 'component_id';

    protected $fillable = [
        'component_id',
        'menu_id',
    ];
}
