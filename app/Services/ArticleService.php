<?php

namespace App\Services;

use App\Models\Article;

class ArticleService
{
    public function getArticles(array $filters = [], int $perPage = 4)
    {
        return Article::with('categories')
            ->when(!empty($filters['category_id']), function ($query) use ($filters) {
                $query->whereHas('categories', function ($q) use ($filters) {
                    $q->where('categories.id', $filters['category_id']);
                });
            })
            ->when(!empty($filters['category']), function ($query) use ($filters) {
                $query->whereHas('categories', function ($q) use ($filters) {
                    $q->whereIn('slug', $filters['category']);
                });
            })
            ->when(!empty($filters['search']), function ($query) use ($filters) {
                $keyword = $filters['search'];
                $query->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', "%{$keyword}%")
                      ->orWhere('content', 'like', "%{$keyword}%");
                });
            })
            ->latest()
            ->paginate($perPage);
    }

    public function getArticleDetail(Article $article){
        return $article->load('categories');
    }
}