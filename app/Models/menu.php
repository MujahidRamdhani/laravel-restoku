<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class menu extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = ["namaMenu", "slug", "category_id", "user_id", "image", "harga"];
    protected $with = ['category'];

   


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function menu()
    {
        return $this->hasMany(menu::class);
    }

    // for route binding with slug instead id
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'namaMenu'
            ]
        ];
    }
}
