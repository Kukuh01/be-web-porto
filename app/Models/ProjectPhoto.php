<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectPhoto extends Model
{
    protected $fillable = [
        'project_id',
        'url_image',
    ];

    // Photos <- Many to One -> Project
    public function project(){
        return $this->belongsTo(Project::class);
    }
}
