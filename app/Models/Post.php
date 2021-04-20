<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['community_id', 'user_id', 'title', 'post_text', 'post_image', 'post_url', 'votes'];

    public function community()
    {
        return $this->belongsTo(Community::class);
    }
}
