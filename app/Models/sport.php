<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class sport extends Model
{
    use HasFactory,Uuids;
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'sport';
    protected $keyType = 'string';
    protected $primaryKey = 'sport_id';

    protected $fillable = [
        'sport_id',
        'type',
    ];

    public function exercise(): BelongsToMany{
        return $this->belongsToMany(Exercise::class,'sport_exercise','sport_id','exercise_id');
    }
}
