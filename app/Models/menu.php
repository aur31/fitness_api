<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class menu extends Model
{
    use HasFactory,Uuids;

    public $incrementing = false;
    public $timestamps = false;
    public $table = 'menu';
    protected $keyType = 'string';
    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'menu_id',
        'recipe',
        'meal',
        'image',
    ];

    public function components(): BelongsToMany{
        return $this->belongsToMany(Components::class,'menu_component','menu_id','component_id');
    }
}
