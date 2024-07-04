<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, Uuids;

    public $incrementing = false;
    public $timestamps = false;
    public $table = 'comment';
    protected $keyType = 'string';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'comment_id',
        'user_id',
        'comment',
        'status',
    ];
}
