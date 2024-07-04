<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Diet extends Model
{
    use HasFactory,Uuids;
    public $incrementing = false;
    public $timestamps = false;
    public $table = 'diet';
    protected $keyType = 'string';
    protected $primaryKey = 'diet_id';

    protected $fillable = [
        'diet_id',
        'label',
    ];

    public function client(): HasMany
    {
        return $this->hasMany(Guide::class,"diet_id","diet_id");
    }


    public function menu(): BelongsToMany{
        return $this->belongsToMany(menu::class,'diet_menu','diet_id','menu_id');
    }
}
