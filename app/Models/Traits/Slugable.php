<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    public static function bootSluggable()
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = self::generateUniqueSlug($model);
            }
        });
    }

    protected static function generateUniqueSlug($model)
    {
        $slug = Str::slug($model->{static::slugSource()});
        $originalSlug = $slug;
        $counter = 1;

        while ($model->newQuery()->where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }

    protected static function slugSource()
    {
        return 'name'; // default
    }
}