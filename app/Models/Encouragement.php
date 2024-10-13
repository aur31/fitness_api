<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encouragement extends Model
{
    use HasFactory,Uuids;

    protected $primaryKey = 'encouragement_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    public $table = 'encouragement';

    protected $fillable = [
        'encouragement_id',
        'encouragement',
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


}
