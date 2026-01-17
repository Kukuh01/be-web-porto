<?php

namespace App\Models;

use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes, Sluggable;

    protected $fillable = [
        'slug',
        'title',
        'url_thumbnail',
        'content',
        'status',
    ];

    // Articles<-Many to Many->Categories
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    protected static function slugSource()
    {
        return 'title';
    }
}
