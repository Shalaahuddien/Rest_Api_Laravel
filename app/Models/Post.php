<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Elequent\SoftDeletes;

class Post extends Model
{
    // use HasFactory, SoftDeletes;

    use HasFactory;

    protected $fillable = [
        'title',
        'news_content',
        'author'
    ];

    // protected $SoftDeletes = true;

    public function writer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }

}
