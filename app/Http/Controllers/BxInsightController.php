<?php

namespace App\Http\Controllers;

use App\Models\BxArticle;
use App\Models\IndustryCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BxInsightController extends Controller
{
      public function index(Request $request): View
    {
    // Featured article
    $featuredArticle = BxArticle::published()
        ->latest('created_at')
        ->first();

    // Build articles query
    $query = BxArticle::published()->with(['category', 'author']);

    // Sorting
    $sort = $request->get('sort', 'recent');
    match ($sort) {
        'read' => $query->mostRead(),
        'alpha' => $query->orderBy('article_title', 'asc'),
        default => $query->latest('created_at'),
    };

    // Filter by category
    if ($request->has('category')) {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('category_slug', $request->category);
        });
    }

    // Search
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function ($q) use ($searchTerm) {
            $q->where('article_title', 'like', "%{$searchTerm}%")
              ->orWhere('short_desc', 'like', "%{$searchTerm}%")
              ->orWhere('article_content', 'like', "%{$searchTerm}%");
        });
    }

    // Paginate
    $articles = $query->paginate(9)->appends($request->except('page'));

    // Sidebar latest
    $latestArticles = BxArticle::published()
        ->latest('created_at')
        ->take(5)
        ->get();

    // Categories
    $categories = IndustryCategory::active()->ordered()->get();

    return view('bxinsight.index', compact(
        'featuredArticle',
        'articles',
        'latestArticles',
        'categories'
    ));
}

public function show(int $id): View
{
    $article = BxArticle::with(['category', 'author'])
        ->published()
        ->where('article_id', $id)
        ->firstOrFail();

    $article->increment('article_views');

    $relatedArticles = BxArticle::published()
        ->where('article_id', '!=', $article->article_id)
        ->when($article->category_id, function ($q) use ($article) {
            $q->where('category_id', $article->category_id);
        })
        ->inRandomOrder()
        ->take(4)
        ->get();

    $latestArticles = BxArticle::published()
        ->where('article_id', '!=', $article->article_id)
        ->latest('created_at')
        ->take(5)
        ->get();

    return view('bxinsight.show', compact(
        'article',
        'relatedArticles',
        'latestArticles'
    ));
}

public function category(string $slug): View
{
    $category = IndustryCategory::where('category_slug', $slug)
        ->active()
        ->firstOrFail();

    $articles = BxArticle::published()
        ->where('category_id', $category->cat_id)
        ->with(['category', 'author'])
        ->latest('created_at')
        ->paginate(12);

    $featuredArticle = $articles->first();

    $latestArticles = BxArticle::published()
        ->whereNotIn('article_id', $articles->pluck('article_id'))
        ->latest('created_at')
        ->take(5)
        ->get();

    return view('articles.category', compact(
        'category',
        'articles',
        'featuredArticle',
        'latestArticles'
    ));
}

}
