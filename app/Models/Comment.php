<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory,Uuids;

    protected $primaryKey = 'comment_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'comment_id',
        'user_id',
        'comment',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public static function emptyComment()
    {
        return new static();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function toArray()
    {
        return [
            'comment_id' => $this->comment_id,
            'user_id' => $this->user_id,
            'comment' => $this->comment,
            'status' => $this->status,
        ];
    }

}
