<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use Inertia\Inertia;
use Illuminate\Routing\Controller;

class CourseController extends Controller
{
    public function index()
    {
        try {

            $categories = PostCategory::query()
                ->active()
                ->where('type', PostCategory::TYPE_COURSE)
                ->with(['posts' => function ($query) {
                    $query
                        ->where('status', Post::STATUS_ACTIVE)
                        ->where('type', Post::TYPE_COURSE);
                }])
                ->orderByPosition()
                ->orderBy('id', 'desc')
                ->take(4)
                ->get()
                ->filter(fn($item) => $item->posts->isNotEmpty()) // Chỉ lấy các danh mục có bài viết
                ->map(function ($item) { {
                        return [
                            'id' => $item->id,
                            'title' => $item->title,
                            'slug' => $item->seo_slug ?? $item->slug,
                            'image' => $item->getImageDetail(),
                            'courses' => $item->posts->map(fn($item) => $item->transform())
                        ];
                    }
                });

            $data = [
                'categories' => $categories,
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Courses/Index', $data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function show($slug)
    {
        try {
            $course = Post::query()
                ->active()
                ->with('products')
                ->where('type', Post::TYPE_COURSE)
                ->whereSlug($slug)
                ->firstOrFail();

            $course->increment('view_count');

            $data = [
                'course' => $course->transformDetails(),
                'seo' => $course->transformSeo()
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Courses/Show', $data)
                ->withViewData([
                    'seo' => $data['seo'],
                ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
