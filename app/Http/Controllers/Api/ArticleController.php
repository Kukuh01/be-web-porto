<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ArticleApiResource;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);

        $articles = Article::with('categories')
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->where('categories.id', $request->category_id);
                });
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->where('slug', $request->category);
                });
            })
            ->orderByDesc('created_at')
            ->paginate($perPage);

        return ArticleApiResource::collection($articles);
    }

    public function show(Article $article)
    {
        $article->load('categories');

        return new ArticleApiResource($article);
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        $perPage = $request->input('per_page', 5);

        $articles = Article::with('categories')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($subQuery) use ($q) {
                    $subQuery->where('title', 'like', "%{$q}%")
                              ->orWhere('content', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('created_at')
            ->paginate($perPage);

        return ArticleApiResource::collection($articles);
    }
}
