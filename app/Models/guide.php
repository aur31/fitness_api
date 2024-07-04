<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory,Uuids;
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'guide';
    protected $keyType = 'string';
    protected $primaryKey = 'guide_id';

    protected $fillable = [
        'guide_id',
        'label',
        'guide',
        'diet_id',
    ];
}
