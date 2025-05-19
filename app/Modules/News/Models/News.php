<?php

namespace App\Modules\News\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'summary', 'content', 'source', 'published_at'];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
