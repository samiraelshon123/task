<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'comment', 'post_id', 'user_id'];
    protected $guard = [];
    public function post(){
        return $this->belongsTo(Post::class);
    }
    public function status(){
        return $this->status == 1 ? 'Active' : 'Inactive';
    }
}
