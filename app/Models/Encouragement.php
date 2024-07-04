<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encouragement extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;
    public $table = 'Encouragement';
    protected $keyType = 'string';
    protected $primaryKey = 'encouragement_id';

    protected $fillable = [
        'encouragement_id',
        'message',
    ];
}
