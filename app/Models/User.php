<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,Uuids;

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    public $table = 'user';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'email',
        'name',
        'sex',
        'password',
        'status',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'status' => 'boolean',
        'role' => 'integer',
        'deleted_at' => 'datetime',
    ];

}
