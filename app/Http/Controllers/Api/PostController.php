<?php

namespace App\Http\Controllers\Api;

use App\Models\Post\Post;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use JamstackVietnam\Core\Traits\ApiResponse;
use Illuminate\Support\Str;

class PostController extends Controller
{
    use ApiResponse;

    public function index(): JsonResponse
    {
        if (request()->has('products')) {
            $products = request()->input('products');
            $items = Post::query()
                ->active()
                ->filter(['products' => $products])
                ->get()
                ->map(fn($item) => $item->transform());

            return $this->success($items);
        }

        return $this->empty();
    }

    public function instantSearch($keyword): JsonResponse
    {
        $products = Post::query()
            ->active()
            ->searchSlug(Str::slug($keyword))
            ->take(10)
            ->get()
            ->map(fn($item) => $item->transform());

        $data = [
            'products' => $products,
            'keyword' => $keyword
        ];

        return $this->success($data);
    }
}
