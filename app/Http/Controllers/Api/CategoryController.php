<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CategoryApiResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('articles');

        if ($request->filled('limit')) {
            $limit = min((int) $request->limit, 50);
            $categories->limit($limit);
        }

        return CategoryApiResource::collection($categories->get());
    }

    public function show(Category $category)
    {
        $category->loadCount('articles');

        $category->load([
            'articles' => function ($query) {
                $query->orderByDesc('created_at');
            }
        ]);

        return new CategoryApiResource($category);
    }
}
