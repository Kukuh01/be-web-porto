<?php

namespace App\Models;

use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes, Sluggable;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'status',
        'url_github',
        'url_site',
    ];

    // Projects <- Many To Many -> Tech Stacks
    public function techStacks(){
        return $this->belongsToMany(TechStack::class);
    }

    // Project <- One To Many -> Photos
    public function photos(){
        return $this->hasMany(ProjectPhoto::class);
    }

    protected static function slugSource()
    {
        return 'title';
    }
}
