<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $fillable = ["name"];
    
    public function totalPosts()
    {
        return $this->loadCount("posts")->posts_count;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
