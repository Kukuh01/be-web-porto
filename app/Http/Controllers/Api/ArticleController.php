<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ArticleApiResource;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleService $articleService
    ){}

    public function index(Request $request)
    {
        $perPage = $request->integer('per_page', 4);

        $filters = [
            'search' => $request->input('search'),
        ];

        if ($request->filled('category_id')) {
            $filters['category_id'] = $request->input('category_id');
        }

        if ($request->filled('category')) {
            $filters['category'] = explode(',', $request->input('category'));
        }

        $articles = $this->articleService->getArticles($filters, $perPage);

        return ArticleApiResource::collection($articles);
    }

    public function show(Article $article)
    {
        $article = $this->articleService->getArticleDetail($article);

        return new ArticleApiResource($article);
    }

    // public function search(Request $request)
    // {
    //     $q = $request->input('q');
    //     $perPage = $request->input('per_page', 5);

    //     $articles = Article::with('categories')
    //         ->when($q, function ($query) use ($q) {
    //             $query->where(function ($subQuery) use ($q) {
    //                 $subQuery->where('title', 'like', "%{$q}%")
    //                           ->orWhere('content', 'like', "%{$q}%");
    //             });
    //         })
    //         ->orderByDesc('created_at')
    //         ->paginate($perPage);

    //     return ArticleApiResource::collection($articles);
    // }
}
