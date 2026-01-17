<?php

namespace App\Models;

use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes, Sluggable;

    protected $fillable = [
        'slug',
        'category_name',
    ];

    // Categories<-Many to Many->Articles
    public function articles(){
        return $this->belongsToMany(Article::class);
    }

    protected static function slugSource()
    {
        return 'title';
    }
}
