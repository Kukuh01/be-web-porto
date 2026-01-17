<?php

namespace App\Models;

use App\Models\Traits\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TechStack extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tech_name',
        'url_image_tech',
    ];

    // Tech Stacks <- Many To Many -> Projects
    public function projects(){
        return $this->belongsToMany(Project::class);
    }
}
