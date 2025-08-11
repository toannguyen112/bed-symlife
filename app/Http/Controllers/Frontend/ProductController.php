<?php

namespace App\Http\Controllers\Frontend;


use App\Models\Post\Post;
use App\Models\Product\Product;

use Inertia\Inertia;
use Illuminate\Routing\Controller;
use JamstackVietnam\Slider\Models\Slider;

class ProductController extends Controller
{
    public function index() {}

    public function show($slug)
    {
        try {
            $product = Product::query()
                ->active()
                ->whereSlug($slug)
                ->firstOrFail();


            $data = [
                'post' => $product->transformDetails(),
                'seo' => $product->transformSeo()
            ];

            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Posts/Show', $data)
                ->withViewData(['seo' => $product->transformSeo()]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function galleries()
    {
        try {

            $banner = Slider::getByPosition('HOME_SLIDER')->first();

            $courses = Post::query()
                ->active()
                ->whereCourses()
                ->with('products')
                ->get()
                ->map(function ($item) { {
                        return [
                            'id' => $item->id,
                            'title' => $item->title,
                            'description' => $item->description,
                            'category' => $item->category,
                            'image' => $item->getImageDetail($item->image),
                            'icon' => $item->getImageDetail($item->icon),
                            'products' => $item->products->map(fn($item) => $item->transform())
                        ];
                    }
                });

            $products = Product::query()
                ->with('courses')
                ->orderBy('id', 'desc')
                ->get()
                ->map(fn($item) => $item->transform());

            $data = [
                'banner' => $banner,
                'courses' => $courses,
                'products' => $products
            ];
            if (request()->wantsJson()) {
                return response()->json($data);
            }

            return Inertia::render('Gallery', $data);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
