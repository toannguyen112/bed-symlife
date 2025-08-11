<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Keyword;
use App\Models\KeywordRefDate;
use Inertia\Inertia;
use Illuminate\Routing\Controller;
use App\Models\Post\Post;
use App\Models\Product\Product;
use JamstackVietnam\Slider\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        try {
            // Get Home Slider
            $sliders = Slider::getByPosition('HOME_SLIDER');

            $services = Post::query()
                ->active()
                ->where('type_post', Post::MAYLANH)
                ->orderByDesc('id')
                ->take(3)
                ->get()
                ->map(fn($item) => $item->transform());

            // Fetch Featured Products
            $products = Product::query()
                ->where('status', Product::STATUS_ACTIVE)
                ->orderByDesc('id')
                ->get()
                ->map(fn($product) => $product->transform());

            $posts = Post::query()
                ->where('status', Post::STATUS_ACTIVE)
                ->where('type_post', Post::KINHNGHIEMSUDUNG)
                ->take(3)
                ->get()
                ->map(fn($product) => $product->transform());

            $members = Post::query()
                ->where('status', Post::STATUS_ACTIVE)
                ->where('type', Post::TYPE_MEMBER)
                ->orderByDesc('id')
                ->take(8)
                ->get()
                ->map(fn($product) => $product->transform());

            // Fetch Feedback Posts
            $feedback = Post::query()
                ->active()
                ->whereFeedback()
                ->latest('id')
                ->get()
                ->map(fn($post) => $post->transformFeedback());

            $resources = Post::query()
                ->active()
                ->whereResources()
                ->latest('id')
                ->get()
                ->map(fn($post) => $post->transformResource());

            // Prepare Response Data
            $data = [
                'sliders' => $sliders,
                'members' => $members,
                'services' => $services,
                'products' => $products,
                'posts' => $posts,
                'feedback' => $feedback,
                'resources' => $resources,
            ];

            // Return JSON or Inertia View
            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Home', $data);
        } catch (\Throwable $e) {
            dd($e);
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }

    public function search()
    {
        try {
            if (request()->wantsJson()) {
                return response()->json([]);
            }

            if (request()->has('keyword') && !request()->has('page')) {

                $searchKeyword = Keyword::firstOrCreate(['keyword' => request()->input('keyword')]);
                $searchKeyword->update(['updated_at' => now()]);

                KeywordRefDate::create(['keyword_id' => $searchKeyword->id]);
            }

            return Inertia::render('Search', []);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function searchV2()
    {

        try {
            $filter = [
                'keyword' => request()->input('keyword'),
                'limit' => request()->input('limit') ?? 8
            ];

            $filterPost = $filter;

            if (request()->has('page') && request()->has('type')) {
                switch (request()->input('type')) {
                    case 'PRODUCT':
                        $filterPost['page'] = request()->input('page');
                        $products = $this->searchPost($filterPost);

                        return response()->json([
                            'success' => true,
                            'data' => $products,
                            'message' => 'ok',
                        ], 200);
                }

                return response()->json([
                    'success' => true,
                    'data' => [],
                    'message' => 'ok',
                ], 200);
            }

            $products = $this->searchPost($filterPost);

            $data = [
                'products' => $products
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }
            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'ok',
            ], 200);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function searchPost($filter)
    {
        try {
            return Post::query()
                ->active()
                ->activeCategories()
                ->wherePosts()
                ->filter($filter)
                ->paginate($filter['limit'] ?? 8)
                ->onEachSide(0)
                ->through(function ($item) {
                    return $item->transform();
                })
                ->withQueryString();
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
