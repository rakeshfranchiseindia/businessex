<?php

namespace App\Http\Controllers;

use App\Models\BxArticle;
use App\Models\IndustryCategory;
use App\Models\ArticleComment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BxInsightController extends Controller
{
      public function index(Request $request): View
    {
    // Featured article
    $featuredArticle = BxArticle::published()
        ->with('author')
        ->latest('created_at')
        ->first();

    // Build articles query
    $query = BxArticle::published()->with('author');

    // Sorting
    $sort = $request->get('sort', 'recent');
    match ($sort) {
        'read' => $query->mostRead(),
        'alpha' => $query->orderBy('article_title', 'asc'),
        default => $query->latest('created_at'),
    };

    // Filter by category
    if ($request->filled('category')) {
        $category = str_replace('-', ' ', $request->string('category')->toString());
        $query->where('article_tags', 'like', '%' . $category . '%');
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
        ->with('author')
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
    $article = BxArticle::with([
        'author',
        'comments' => fn ($query) => $query->where('comment_status', 1)->latest(),
    ])
        ->published()
        ->where('article_id', $id)
        ->firstOrFail();

    $article->increment('article_views');
    $article->refresh();

    $relatedArticles = BxArticle::published()
        ->with('author')
        ->where('article_id', '!=', $article->article_id)
        ->inRandomOrder()
        ->take(4)
        ->get();

    $latestArticles = BxArticle::published()
        ->with('author')
        ->where('article_id', '!=', $article->article_id)
        ->latest('created_at')
        ->take(5)
        ->get();

    $recommendedArticles = BxArticle::published()
        ->with('author')
        ->where('article_id', '!=', $article->article_id)
        ->latest('article_views')
        ->take(5)
        ->get();

    return view('bxinsight.show', compact(
        'article',
        'relatedArticles',
        'latestArticles',
        'recommendedArticles'
    ));
}

public function storeComment(Request $request, int $id)
{
    $article = BxArticle::published()->where('article_id', $id)->firstOrFail();

    $validated = $request->validate([
        'comment_name' => ['required', 'string', 'max:55'],
        'comment_email' => ['required', 'email', 'max:55'],
        'comment_detail' => ['required', 'string', 'max:5000'],
    ]);

    ArticleComment::create([
        'article_id' => $article->article_id,
        'comment_name' => $validated['comment_name'],
        'comment_email' => $validated['comment_email'],
        'comment_detail' => $validated['comment_detail'],
        'comment_status' => 0,
    ]);

    $article->increment('article_comments');

    return redirect()
        ->to(route('bxinsight.show', $article->article_id) . '#comments')
        ->with('success', 'Thank you. Your comment has been submitted for review.');
}

public function category(string $slug): View
{
    $category = IndustryCategory::where('category_slug', $slug)
        ->active()
        ->firstOrFail();

    $articles = BxArticle::published()
        ->where('article_tags', 'like', '%' . str_replace('-', ' ', $slug) . '%')
        ->with('author')
        ->latest('created_at')
        ->paginate(12);

    $featuredArticle = $articles->first();

    $latestArticles = BxArticle::published()
        ->whereNotIn('article_id', $articles->pluck('article_id'))
        ->with('author')
        ->latest('created_at')
        ->take(5)
        ->get();

    return view('bxinsight.index', [
        'categories' => IndustryCategory::active()->ordered()->get(),
        'category' => $category,
        'articles' => $articles,
        'featuredArticle' => $featuredArticle,
        'latestArticles' => $latestArticles,
    ]);
}

}
