<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post\Post;
use App\Models\Post\PostCategory;
use Inertia\Inertia;
use Illuminate\Routing\Controller;

class ResourceController extends Controller
{
    public function index()
    {

        try {
            $categories = PostCategory::query()
                ->active()
                ->whereResources()
                ->get()
                ->map(fn($item) => $item->transform());

            $resources = Post::query()
                ->active()
                ->whereResources()
                ->orderBy('id', 'desc')
                ->get()
                ->map(fn($item) => $item->transformResource());

            $data = [
                'categories' => $categories,
                'resources' => $resources
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Resources/Index', $data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
