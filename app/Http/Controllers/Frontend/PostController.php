<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post\Post;
use Inertia\Inertia;
use Illuminate\Routing\Controller;
use App\Models\Post\PostCategory;


class PostController extends Controller
{
    public $model = Post::class;

    public function index()
    {
        try {
            $posts = Post::query()
                ->active()
                ->activeCategories()
                ->where('type_post', Post::KINHNGHIEMSUDUNG)
                ->orderByPosition()
                ->orderBy('id', 'desc')
                ->get()
                ->map(fn($item) => $item->transform());

            $most_view = Post::query()
                ->where('type_post', Post::KINHNGHIEMSUDUNG)
                ->active()
                ->activeCategories()
                ->activeCategories()->orderBy('view_count', 'desc')
                ->take(3)
                ->get()
                ->map(fn($item) => $item->transform());

            $data = [
                'posts' => $posts,
                'most_view' => $most_view,
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Posts/Index', $data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function memories()
    {
        try {
            $posts = Post::query()
                ->where('status', Post::STATUS_ACTIVE)
                ->where('type', Post::TYPE_MEMBER)
                ->orderBy('id', 'desc')
                ->get()
                ->map(fn($item) => $item->transform());

            $images = $posts->flatMap(fn($post) => $post['images'])->values()->all();

            $data = [
                'images' => $images,
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Posts/Memories', $data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function show($slug)
    {
        try {
            $post = $this->model::query()
                ->active()
                ->whereSlug($slug)
                ->firstOrFail();

            $post->increment('view_count');

            $relatedPosts = $post->related();

            $data = [
                'post' => $post->transformDetails(),
                'related_posts' => $relatedPosts,
                'seo' => $post->transformSeo()
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Posts/Show', $data)
                ->withViewData([
                    'seo' => $data['seo'],
                ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function showMember($slugMember)
    {
        try {
            $post = $this->model::query()
                ->active()
                ->whereSlug($slugMember)
                ->firstOrFail();

            $data = [
                'post' => $post->transformDetails(),
                'seo' => $post->transformSeo()
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Posts/Construction', $data)
                ->withViewData([
                    'seo' => $data['seo'],
                ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function relatedPosts($postId)
    {
        $post = Post::query()
            ->setEagerLoads([])
            ->with('relatedPosts', 'categories')
            ->find($postId);

        $items = $post->relatedPosts()
            ->activeLocale()
            ->get()
            ->map(fn($item) => $item->transform());

        if ($items->count() == 0) {
            $category = $post->categories
                ->where('status', PostCategory::STATUS_ACTIVE)
                ->values()
                ->first();

            $items = Post::query()
                ->activeLocale()
                ->whereHas('categories', function ($query) use ($category) {
                    $query->where('post_categories.id', $category?->id);
                })
                ->orderByPosition()
                ->orderBy('id', 'desc')
                ->take(8)
                ->get()
                ->map(fn($item) => $item->transform());
        }

        return response()->json([
            'success' => true,
            'data' => $items,
            'message' => 'OK',
        ], 200);
    }
}
